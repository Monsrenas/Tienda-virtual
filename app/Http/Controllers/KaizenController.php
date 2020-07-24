<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use View;

class KaizenController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $variable;


    public function index()
    {	

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/maz-partes-firebase-adminsdk-r7v4n-e80de68492.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)   
        ->withDatabaseUri('https://maz-partes.firebaseio.com/')
        ->create();
        return $firebase->getDatabase();
    }

    public function imagenes()
    {   
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/maz-partes-firebase-adminsdk-r7v4n-e80de68492.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)   
        ->withDefaultStorageBucket('https://maz-partes.appspot.com')
        ->createStorage();
        dd($firebase);
        return $firebase->getDatabase();
    }


    public function Leerbase()
        { 
           $database=$this->index();

           $reference = $database->getReference('marcas');
           $Snapshot=$reference->getSnapshot();
           //$Snapshot=$reference->orderByChild('nombre')->equalTo('Toyota')->orderByChild('nombre')->equalTo('Toyota')->getSnapshot();
           $value = $Snapshot->getValue();
          return $value;
        }

    public function Guardar(Request $request) 
    {   
        $atm=$this->GeneraModeloPersona($request);
        
        $database=$this->index();
        $newPost = $database->getReference('Persona')
        ->push($atm);
    }

     public function GuardaRegistro(Request $request) 
    {   
        $registro=$this->ValidarProducto($request);
        $database=$this->index();
        $newPost = $database->getReference('productos/'.$request->codigo_producto)
        ->update($registro);

         //$newPost = $database->getReference('productos/'.$request->codigo_producto)
        //->update($registro);
        //$atm=$this->GeneraModeloPersona($request);
        
        //$database=$this->index();
        //$newPost = $database->getReference('Persona')->push($atm);
        return $newPost;
    }

    public function ValidarProducto(Request $request)
    {
        $registro=[
          "categoria"=> $request->categoria,
          "codigos_adicionales"=> isset($request->codigo) ?$request->codigo:null,
          "codigo_catalogo"=> $request->codigo_catalogo,
          "codigo_fabricante"=> $request->codigo_fabricante,
          "descripcion"=> $request->descripcion,
          "medidas"=> $request->medidas,
          "fotos"=> $request->fotos,
          "modelo"=> $request->modelo,
          "precios"=> $request->precios                  
        ];

         return $registro;         
    }

    public function Actualizar() //DESUSO
    {
        $newPost = $database
        ->getReference('blog/posts')
        ->update([
        'title' => 'La casita de bernalda alba' ,
        'category' => 'Libro'
        ]);
        echo '<pre>';
        print_r($newPost->getvalue());


    }

    public function DevuelveBase(Request $request)
        {  
           $database=$this->index();
           $reference = $database->getReference($request->referencia);
           $Snapshot=$reference->orderByKey()->limitToFirst(200)->getSnapshot();
           $value = $Snapshot->getValue();
           //$value = $reference->getValue();

          return $value;
        }


    public function Info_Producto(Request $request)
     {  
        $ListProducto=$this->DevuelveBase($request);
        $request->referencia='descuentos';
        $ListDescuento=$this->DevuelveBase($request);
        return [$ListProducto ,$ListDescuento];
     }

//Filtro
    public function pagina(Request $request)
    {
        $request->referencia='descuentos';
        $ListDescuento=$this->DevuelveBase($request);

        $request->referencia='productos';
        $ListProducto=$this->DevuelveBase($request);
        $filtrado=[];

        foreach ($ListProducto as $key => $value) { 
            $value['codigo']=$key;
        
             
            if ($this->enFiltro($request, $value)) { 
                                                    $value['descuento']=$this->descuento($value, $ListDescuento);
                                                    $filtrado[]=$value;
        }                                          }
        return  $filtrado;                             
    }

    public function enFiltro(Request $request, $producto)
    {
        $datos=$request->all(); 
        $condicion=[];
        $bndr=0;
        $modelo= $producto['modelo'] ?? [];
        $categoria= $producto['categoria'] ?? [];
        $Codigos=$producto['codigos_adicionales'] ?? '';
        $fabricante=$producto['codigo_fabricante'] ?? '';
        $bandera=[];
        foreach ($datos as $key => $value) {
            $condicion[$key]=explode(',', $value);
        }

        $cmpld=count($condicion);

        if (isset($condicion['palabra']))
        {      
            //$palabras=(count($condicion['palabra'])>1) ? count($condicion['palabra'])-1:0;
            //$cmpld=$cmpld+$palabras;
            foreach ($producto['descripcion'] as $key => $descripcion) {
                 foreach ($condicion['palabra'] as $ind => $valor) {

                    if (strpos( strtoupper($descripcion), strtoupper($valor) )>-1)  { 
                        //echo strtoupper($descripcion)."-".strtoupper($valor)."//" ;

                        $bndr=$bndr+1; $bandera['palabra']='1'; }

                    if ($producto['codigo']==$valor) { $bndr=$bndr+1; $bandera['palabra']='1';}

                   /*  foreach ($Codigos as $inco => $xCodigo) {
                        if ($xCodigo==$valor) { $bndr=$bndr+1; }
                    }*/
                 }     
            }      
        }

        if (isset($condicion['marca']))
        {  
            foreach ($modelo as $key => $descripcion) {
                 foreach ($condicion['marca'] as $ind => $valor) { 
                    if (substr( $descripcion,0,3)==$valor)  { 
                        //echo $producto['codigo'].": ".substr($descripcion,0,3)."  ".$valor."//";
                         $bndr=$bndr+1; $bandera['marca']='1';}
                 }     
            }      
        }        



        if (isset($condicion['modelo']))
        { 
            foreach ($modelo as $key => $descripcion) {
                 foreach ($condicion['modelo'] as $ind => $valor) {
                    if (strpos( $descripcion, $valor )!==FALSE)  { $bndr=$bndr+1; $bandera['modelo']='1';}
                 }     
            }      
        }        
        
        if (isset($condicion['categoria']))
        { 
            foreach ($categoria as $key => $descripcion) {
               for ($i=1; $i <((strlen($descripcion)+1)/3) ; $i++) {
                    $Subcategoria=substr($descripcion, 0, $i*3);
                    
                    foreach ($condicion['categoria'] as $ind => $valor) {     
                         
                         if ($valor==$Subcategoria)  { $bndr=$bndr+1; $bandera['categoria']='1';}
                    }       
                }      
            }      
        }            

        if ((isset($condicion['fabricante']))and(strpos( $fabricante, $condicion['fabricante'][0] )!==FALSE))
        { 
            $bndr=$bndr+1;      $bandera['fabricante']='1';
        }    

        if ((count($bandera)==$cmpld)or($cmpld==0)) { return true; }

        $palacond=((isset($bandera['palabra']))and(isset($condicion['palabra'])));

        //echo $palacond;

        //if (($bndr>=$cmpld)and $palacond ) { return true; } 

        return false;
    }                                                           //Final de la Funcion enFiltro



    public function descuento()
    {
        return 10;
    }

    public function yxVista(Request $request){    
            $view = View::make($request->url);
            
            if($request->ajax()){
                return $view->with('info',$request); 
            }else return $view->with('info',$request);
    }

   public function Vista(Request $request){    
            $view = View::make($request->url);

            $pos = strpos($request->campo, "<*>");
            if ($pos>0) { $req=$this->EstructuraDatosCar($request); return $view->with('info',$req); }

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

    public function OLDlistadoProductos(Request $request)
    {
        $request->referencia='productos';
        $ListProducto=$this->DevuelveBase($request);
        return view('administracion.productos')->with('producto',$ListProducto);
    }

     public function listadoProductos(Request $request)
    {
        $request->referencia='productos';
        $ListProducto=$this->DevuelveBase($request);
        return view('panel.producto')->with('producto',$ListProducto);
    }

    /* Operaciones Carrito */ 

    public function CarritoAgregarItem(Request $request)
    {   $Vista=$this->Vista($request);
        if(!isset($_SESSION)){
                         session_start();
                         if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}
                       }

        $TmpCon = $_SESSION['MyCarrito'];

        if (isset($TmpCon[$Vista->info['codigo']])){
                        $TmpCon[$Vista->info['codigo']]['cantidad']+=$request->cantidad;
                 }
            else { 
                   $TmpCon[$Vista->info['codigo']]=$Vista->info;
                   $TmpCon[$Vista->info['codigo']]['cantidad']=$request->cantidad;
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
    {   $Vista=$this->Vista($request);
        if(!isset($_SESSION)){     session_start();      }    
        $TmpCon = $_SESSION['MyCarrito'];
        $TmpCon[$request->codigo]['cantidad']=$request->valor;    
        $_SESSION['MyCarrito'] = $TmpCon;
        return $Vista;
    } 

    public   function getImageRelativePathsWfilenames()
    {
        $lista=array_merge(glob("*.jp*"),glob("*.png"));
     
        //foreach ($lista as $filename) {
        //echo "$filename -------- size " . filesize($filename) . "<br>";}
     
        return $lista;
    }

}