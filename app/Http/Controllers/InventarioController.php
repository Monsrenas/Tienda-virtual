<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Builder;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use View;
use App\Inventario;
use App\Pre_recepcion;
use App\Recepcion;
use App\Producto;
use App\Descuento;
use Illuminate\Support\Collection;
use Auth;
use MongoDB\BSON\Regex;

class InventarioController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function addItemPre_recepcion(Request $request)
        {
            $todo=Pre_recepcion::where('codigo',$request->codigo)->first();
            if ($todo) {$todo->update($request->all());}    
            else {$todo=Pre_recepcion::create($request->all());}
            return View('inventario.Pre_recepcion')->with('lista',$todo);;
        }

    public function Recepcionar(Request $request)
    {
        $PreRecepcion=Pre_recepcion::where('usuario',Auth::user()->_id)->get();
        foreach ($PreRecepcion as $key => $value) 
        { 
            $recepcion=Inventario::where('codigo',$value->codigo.$value->precio.$value->almacen)->first();
         
            if ($recepcion) {
                             $recepcion->cantidad+=$value->cantidad;
                             if (isset($recepcion->fisico)) {
                                                                $recepcion->fisico+=$value->cantidad;

                                                             } else {
                                                                        $recepcion->fisico=$value->cantidad;
                                                                    }
                             $recepcion->update();
                           } else {
                                    $recepcion=new Inventario;
                                    $recepcion=[
                                            'codigo'=>$value->codigo.$value->precio.$value->almacen,
                                            'codigo_id'=>Producto::where('codigo',$value->codigo)->first()->_id,
                                            'producto'=>strval($value->codigo),
                                            'almacen'=>$value->almacen,
                                            'precio'=>number_format($value['precio'], 2, ',', ' '),
                                            'cantidad'=>$value->cantidad,
                                            'fisico'=>$value->cantidad
                                             ];
                                            Inventario::create($recepcion);
                                  }                          
        }
        $this->CreaInformeRecepcion($PreRecepcion);
        return redirect('Pre_recepcion');
    }

    public function VariaStock($codigo, $accion, $cantidad)
    {
        $prod=Inventario::where('codigo',$codigo)->first();
        if (!$prod) { return; }

        switch ($accion) {
                        case '-C':
                            $prod->cantidad-=$cantidad;
                            break;
                        case '+C':
                            $prod->cantidad+=$cantidad;
                            break;
                        case '-F':
                            if (isset($prod->fisico)) { $prod->fisico-=$cantidad; } 
                            else { $prod->fisico=$prod->cantidad-$cantidad; }
                            break;
                        case '+F':
                            if (isset($prod->fisico)) { $prod->fisico+=$cantidad; } 
                            else { $prod->fisico=$prod->cantidad; }
                            break;    
                    }
         
        if ($prod->fisico<$prod->cantidad)  $prod->fisico=$prod->cantidad; 
        $prod->update();
        return; 
    }
 
    public function CreaInformeRecepcion($pre_recepcion)
    {
       $id=strftime("%G%m%d%H%M%S").Auth::user()->_id;
       $usuario=Auth::user()->_id;
       foreach ($pre_recepcion as $key => $value) {
                                    $recepcion=new Recepcion;
                                    $recepcion=[
                                            'id'=>$id,    
                                            'usuario'=>$usuario,
                                            'proveedor'=>$value['proveedor'],
                                            'documento'=>$value['documento'],
                                            'codigo'=>strval($value['codigo']),
                                            'almacen'=>$value['almacen'],
                                            'precio'=>number_format($value['precio'], 2, ',', ' '),
                                            'cantidad'=>$value['cantidad'] ];
                                    Recepcion::create($recepcion);

                                    $borrar=Pre_recepcion::orderBy('_id')->find(($value['_id']));
                                    
                                    $borrar->delete();   
                                  }
         

       return;
    }


    public function ListadoRecepciones()
    {
        $lista=Recepcion::groupBy('id')->select('id','proveedor','documento','usuario','almacen','created_at')->orderBy('created_at', 'desc')->get();
        return View('inventario.lista_recepcion')->with('lista',$lista);
    }


    public function ListadoInventario()
    {
        $lista=Inventario::get();
        return View('inventario.existencia')->with('lista',$lista);
    }

    public function InfoPrevioARecepcon(Request $request)
    {

       $inventario=Inventario::where('producto',$request->codigo)->
                               select(['codigo_id','producto','almacen', 'precio', 'cantidad'])->
                               with(['detalles:_id,codigo,producto,nombre'])->
                               when((isset($request->almacen)), function($q){
                                                         return $q->where('almacen',request('almacen'));
                                                      })->get();
       if (count($inventario)>0) { return $inventario; }

        $inventario=Inventario::where('producto',$request->codigo)->
                               select(['codigo_id','producto','almacen', 'precio', 'cantidad'])->
                               with(['detalles:_id, codigo,producto,nombre'])->orderBy('producto')->get();

       if (count($inventario)>0) { return $inventario; }

       $producto=Producto::orderBy('codigo')->where('codigo', $request->codigo)->get();
       
       
       return $producto;

       
    }

//Filtro
    public function pagina(Request $request)
    {    

       
            $request=$this->CompletarFiltro($request);
       


        $ListProducto=Inventario::whereHas('detalles', function(Builder $q)
        {    
            if ( request('palabra') ) 
            {   
                $plbr = explode(",",request('palabra'));
                
                foreach ($plbr as $palabra) 
                {
                    if (isset($_SESSION['config']['ng'])){
                        $q->where('nombre','like', '%'.$palabra.'%');
                    }
                        
                    if (isset($_SESSION['config']['cg'])){                    
                        $q->orWhere('codigo','like', '%'.$palabra.'%');
                    }
                       
                    if (isset($_SESSION['config']['ag'])){                    
                        $q->orWhere( function($q) use ($palabra){ return $q->whereRaw(["codigosAd"=>['$regex'=>$palabra, '$options'=>'//i']]);  
                        });
                    }   

                    if (isset($_SESSION['config']['dg'])){
    
                        $q->orWhere( function($q) use ($palabra){   
                            return $q->whereRaw(["descripciones"=> ['$regex'=>$palabra, '$options'=>'/i/']]);

                        }); 
                    }
                }  
            }

            if ( request('marca') || request('modelo') ) 
            {   
               $q->where( function($q){
                             $mdls = explode(",",request('modelo'));
                                 
                            foreach ($mdls as $modelo) 
                            {
                                $q->orWhere(function($q) use ($modelo){  
                                return $q->whereRaw(["modelos.modelo"=> $modelo]);
                                
                              });  
                            }

                            if ( request('marca') )
                            {
                                $mrc = explode(",",request('marca'));
                                 
                                foreach ($mrc as $marca) 
                                {
                                    return $q->orWhere(function($q) use ($marca)
                                    {  
                                        return $q->whereRaw(["modelos.marca"=> $marca]);
                                
                                    });
                                }

                            } 
                });            
                
            }


            if (( request('fabricante') )and(isset($_SESSION['config']['fg']))) 
            {   
                $q->where(function($q){  
                                        
                    $plbr = explode(",",request('fabricante'));
                    
                    foreach ($plbr as $fabricante) 
                    {
                        $q->orWhere('fabricante', $fabricante);
                    }  
                }); 
            }

            if ( request('categoria') ) 
            {   
                $q->where(function($q){  
                                        
                    $ctgr = explode(",",request('categoria'));
                    //orWhere( function($q) use ($palabra){ return $q->whereRaw(["categorias"=> ['$regex'=>$categoria, '$options'=>'^']]);
                    foreach ($ctgr as $categoria) 
                    {
                        //$q->orWhere('categorias', $categoria);
                        $q->orWhere( function($q) use ($categoria)
                        { 
                         return $q->orWhere("categorias", "regex", new Regex("^".$categoria));
                        });
                    }  
                }); 
            }  

        })->paginate(9);
        
        if(!isset($_SESSION)){ session_start(); }
        if (isset( $_SESSION['cliente'])){
                 $ListProducto->map(function($q){
                          $q=$this->Descuento($q);
                          return $q;
                    });
                }
    
       // $ListProducto=$this->Descuento($ListProducto);

                                                 
                $vista=View::make('Producto_simple');
        return $vista->with('lista',$ListProducto) ;                           
    }

    public function Descuento($q)
    {
        
                $hoy=date("Y-m-d");;
               
                $ofer=Descuento::where("inicio","<=",$hoy)
                                 ->where("final",">=",$hoy)
                                 ->get();
                
                foreach ($ofer as $value) {

                        if (isset($value->condiciones))
                        {
                            $cumplidas=[];
                            $cdcn=$value->condiciones['campo'];
                            $vlr=$value->condiciones['valor'];

                            for ($i=0; $i < count($cdcn); $i++) 
                            {

                              if ($cdcn[$i]=='modelos')
                              {

                                $enmodelo=false; $enmarca=false;

                                if (isset($q->detalles->modelos['marca']))
                                { 
                                   $enmodelo=in_array($vlr[$i], $q->detalles->modelos['marca']); 
                                }

                                if (isset($q->detalles->modelos['modelo']))
                                   {
                                     $enmarca=in_array($vlr[$i], $q->detalles->modelos['modelo']);
                                   }
                                   $cumplidas[$i]=($enmarca or $enmodelo);   
                              }  else
                              {   

                                  $cumplidas[$i]=($q->detalles[$cdcn[$i]]==$vlr[$i]);

                                  //echo ($i.'-'.$q->detalles['nombre'].'.'.$cdcn[$i].': '.$q->detalles[$cdcn[$i]].'<********>'.$vlr[$i].'<br>');
                                 
                              } 
                            }
                            if (!in_array(false  ,$cumplidas) ) {$q->descuento+=$value->valor;}
                        }

                    }    
                
                      
            
        return $q;
    }

   public function Vista(Request $request){    
            $view = View::make($request->url);

            //$pos = strpos($request->campo, "<*>");
            //if ($pos>0) { $req=$this->EstructuraDatosCar($request); return $view->with('info',$req); }

            if($request->ajax()){
                return $view->with('info',$request); 
            }else return $view->with('info',$request);
    }

    public function EstructuraDatosCar(Request $request)
        {
            $paq = $request->campo;
            $ext = $request->descripcion;

            $Estruc=[];

            $ProdData=explode ( '<*>' ,$paq , 10 );
            $ProdExtr=explode ( '<*>' ,$ext , 10 );
             
            $Estructura['codigo']=$ProdData[0];                                             
            $Estructura['fabricante']=$ProdData[1];
            $Estructura['precio']=$ProdData[2];
            $Estructura['cantidad']=0;
            $Estructura['descripcion']=$ProdData[3];
            $Estructura['fotos']=array_slice($ProdData, 4);
            $Estructura['modelo']=$ext;  
           return $Estructura;
        }

    /* Panel de Administracion */

     public function listadoProductos(Request $request)
    {
        $request->referencia='productos';
        $ListProducto=$this->DevuelveBase($request);
        return view('panel.producto')->with('producto',$ListProducto);
    }

    /* Operaciones Carrito */ 

    public function CarritoAgregarItem(Request $request)
    {   $Vista=$this->DatosCar($request);
        if(!isset($_SESSION)){
                         session_start();
                       }
        if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}               

        $TmpCon = $_SESSION['MyCarrito'];
       
        if (isset($TmpCon[$Vista->info['indice']])){
                        $TmpCon[$Vista->info['indice']]['cantidad']+=$request->cantidad;
                 }
            else { 
                   $TmpCon[$Vista->info['indice']]=$Vista->info;
                   $TmpCon[$Vista->info['indice']]['cantidad']=$request->cantidad;
                 }

        if ($TmpCon[$Vista->info['indice']]['cantidad']>$Vista->info['stock'])
        {
         $TmpCon[$Vista->info['indice']]['cantidad']=$Vista->info['stock']; 
        }         
        //$tmn=count($TmpCon);
        //Session::put('MyCarrito', $TmpCon);
        $_SESSION['MyCarrito'] = $TmpCon;
        //session(['MyCarrito' => [$Vista->info['codigo']=>$Vista->info]]); 
        return $Vista;
    }

    public function CarritoEliminaItem(Request $request)
    {   $Vista=$this->Vista($request);
        if(!isset($_SESSION)){     session_start();     }
        $TmpCon = $_SESSION['MyCarrito'];
        unset($TmpCon[$request->codigo]);    
        $_SESSION['MyCarrito'] = $TmpCon;
        return $Vista;
    }

    public function CarritoCambiaCanti(Request $request)
    {   
        $Vista=$this->DatosCar($request);
        if(!isset($_SESSION)){     session_start();      }    
        $TmpCon = $_SESSION['MyCarrito'];
        $TmpCon[$request->campo]['cantidad']=$request->valor;
 
        if ($TmpCon[$request->campo]['cantidad']>$Vista->info['stock'])
        {
         $TmpCon[$request->campo]['cantidad']=$Vista->info['stock']; 
        }   

        $_SESSION['MyCarrito'] = $TmpCon;
        return $Vista;
    } 


    public function CarritoVaciar()
    {    
        
        if(!isset($_SESSION)){     session_start();     }
        $TmpCon = $_SESSION['MyCarrito'];
        foreach ($TmpCon as $key => $value) {
               unset($TmpCon[$key]);
        }
            
        $_SESSION['MyCarrito'] = $TmpCon;
        return View('/Carrito');
    }


    public   function getImageRelativePathsWfilenames()
    {
        $lista=array_merge(glob("*.jp*"),glob("*.png"));
     
        //foreach ($lista as $filename) {
        //echo "$filename -------- size " . filesize($filename) . "<br>";}
     
        return $lista;
    }

    public function DatosCar(Request $request)
        {
            $Prod=Inventario::where('codigo', $request->campo)->first();
           
            if(!isset($_SESSION)){ session_start(); }
            if (isset( $_SESSION['cliente'])){
                                                $Prod=$this->Descuento($Prod);
                                              }
            $precio=$Prod->precio;

            if ((isset($Prod->descuento))and($Prod->descuento>0))
            {
              $precio=number_format(floatval($Prod->precio)-((floatval($Prod->precio)*floatval($Prod->descuento)/100)), 2, '.', ''); 
            }
           
            $Estructura['indice']=$request->campo;
            $Estructura['codigo']=$Prod->producto;                                             
            $Estructura['fabricante']=$Prod->detalles->fabricantes->nombre ?? "";
            $Estructura['precio']=$precio;
            $Estructura['descuento']=$Prod->descuento??0;
            $Estructura['cantidad']=0;
            $Estructura['stock']=$Prod->cantidad;
            $Estructura['descripcion']=$Prod->detalles->nombre;
            $Estructura['fotos']=$Prod->detalles->fotos['nombre'][0] ?? "";
            $Estructura['modelo']=$Prod->detalles->modelos;  
            $Estructura['invcodigo']=$Prod->codigo;

            $vista=View::make($request->url);
           return $vista->with('info', $Estructura);
        }

    public function FiltroPermanente($tipo=null, $id=null)
    {
        //session(['idCarroCompra' => '15320']);
        //session()->forget('filtro');
        $filtro=session("filtro");

        if ($id) { $filtro[$tipo]=$id; } else { unset($filtro[$tipo]); }

        session(['filtro' => $filtro]);
        return session("filtro");
    }    

    public function CompletarFiltro($filtro)
    {
        if (!session()->has('filtro')) return $filtro;
        $tmp=session("filtro");
        foreach ($tmp as $tipo => $value) {
            # code...
            $valores=$tmp[$tipo];
            if (isset($filtro[$tipo]))
            {
                   $filtro[$tipo]=$filtro[$tipo].",".$valores;                 
            } else $filtro[$tipo]=$valores;
        }

        return $filtro;
    }

}