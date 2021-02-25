<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use View;

use Illuminate\Support\Collection;
use App\Marca;
use App\Modelo;
use App\Categoria;
use App\Fabricante;
use App\Medida;

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

    public function MongoStore(Request $request)
    {
         
     /*   $a=false;
        $todo=Marca:: when($a, function($q){
            return $q->whereHas('modelos', function($query){$query->where('nombre', 'Golf Plus'); });
        })->get();
        
      return View('panel.editaMarcaModelo')->with('lista',$todo);    */
      

/*
     $database=$this->index();

      $reference = $database->getReference('Medidas');
      $Snapshot=$reference->getSnapshot();
      $categoria = $Snapshot->getValue();

      
       foreach ($categoria as $cod => $xItem) {   
                             $Rcategoria= new Medida;
                             
                             $p = strpos($xItem['nombre'], ':');
                             $Rcategoria->codigo=substr($xItem['nombre'],0,$p);
                             $Rcategoria->nombre=substr($xItem['nombre'],$p+1);
                             echo $Rcategoria->codigo." - ".$Rcategoria->nombre."<br>";
                             $Rcategoria=collect($Rcategoria);
                             Medida::create($Rcategoria->all());
            }  


/*
      $database=$this->index();

      $reference = $database->getReference('FABR');
      $Snapshot=$reference->getSnapshot();
      $categoria = $Snapshot->getValue();

      
       foreach ($categoria as $cod => $xItem) {
                             $Rcategoria= new Fabricante;
                             
                             $Rcategoria->codigo=str_pad($cod, 4, "0", STR_PAD_LEFT);
                             $Rcategoria->nombre=$xItem['nombre'];

                             $Rcategoria=collect($Rcategoria);
                             Fabricante::create($Rcategoria->all());
            }  
*/

/*

      $database=$this->index();

      $reference = $database->getReference('categorias');
      $Snapshot=$reference->getSnapshot();
      $categoria = $Snapshot->getValue();

      
       foreach ($categoria as $cod => $xItem) {
                             $Rcategoria= new Categoria;
                             echo $cod."- ".$xItem."<br>";
                             $Rcategoria->codigo=$cod;
                             $Rcategoria->nombre=$xItem;
                             $Rcategoria=collect($Rcategoria);
                             Categoria::create($Rcategoria->all());
            }  


*/

    /*    $registro=new Marca;
        $Rmodelos=new Modelo;
        $deFirebade=$this->Leerbase();
        foreach ($deFirebade as $cod => $marca)
       {
            $nombre=$marca['nombre'];
            $id_marca=strval($cod);
            $modelos=[];
            if (isset($marca['modelos'])){
                    echo $cod;
                    foreach ($marca['modelos'] as $mod => $modelo) {
                             echo ".";
                             $Rmodelos->id_modelo=($cod.$mod); 
                             $Rmodelos->id_marca=$id_marca;
                             $Rmodelos->nombre=$modelo['nombre'];
                             $RegModelos=collect($Rmodelos);
                             Modelo::create($RegModelos->all());
                           }   echo "<br>";    
               }
            $registro->id_marca=$id_marca;
            $registro->nombre=$nombre;
            
            $RegMarcas = collect($registro);

            Marca::create($RegMarcas->all());
        
        }
        


      */  
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

    public function getImageRelativePathsWfilenames()
    {
        $lista=array_merge(glob("*.jp*"),glob("*.png"));
     
        //foreach ($lista as $filename) {
        //echo "$filename -------- size " . filesize($filename) . "<br>";}
     
        return $lista;
    }

    public function PasaFabricantes()
    {
        $fabr=$this->ListaDeLosFabricantes();
        
        for ($i=1; $i<count($fabr)  ; $i++) {
            # code...
            $nuevoID=str_pad($i, 4, "0", STR_PAD_LEFT);
            $todo=new Fabricante;
            $todo->codigo=$nuevoID;
            $todo->nombre=$fabr[$i];
            $todo=collect($todo);
            $busca=Fabricante::where('codigo', $nuevoID)->first();
            
            if (!$busca) { echo $i." -".$fabr[$i]."-  Nuevo <br>"; Fabricante::create($todo);
                         } else {    echo $i." -".$fabr[$i]."-  Actualzado <br>";
                                    $busca->nombre=$fabr[$i];
                                    $busca->save();}
        }

    }

    public function ListaDeLosFabricantes()
    {
        $fabr=["FABRICANTE",
"555J",
"A-N PARTS",
"ABP",
"ABRO",
"ACC",
"ACDELCO",
"ADVANCE",
"AGP",
"AISAN",
"AISIN",
"ALLPARTS",
"AMALIE",
"AMC",
"AMERICAN RUBBER",
"ART",
"ATE",
"AYG",
"BANDO",
"BARDAHL",
"BESSER",
"BGF",
"BOSCH",
"BRAKE PAK",
"CALORSTAT",
"CAMVUCOL",
"CAR-DEX",
"CENTURY",
"CHAMP",
"CHIN DEN",
"CMB",
"COFAP",
"CTR",
"CYCLO",
"DAIDO METAL",
"DANA SPICER",
"DANA TRANSEJES",
"DAYCO",
"DDT",
"DELPHI",
"DENSO",
"DEPO",
"DGC",
"DLAA",
"DLZ",
"DONGIL",
"DROCARAS",
"DS",
"DTC",
"EVERSPARK",
"EXEDY",
"FANAUTO",
"FIC",
"FILTER MASTER",
"FITORI",
"FPI",
"FRACO",
"FRAM",
"FREEZETONE",
"FRENEC",
"FRIPARTS",
"FUJI",
"FV",
"G-CONTROL",
"GDN",
"GEN",
"GLOBAL BRAKE PARTS",
"GM",
"GMB",
"GOLDEN BEAR",
"GP",
"GSP",
"GUAYAS B&G",
"GULF",
"HECLES",
"HERKO",
"HIGH POWER",
"HKT",
"HORNG LING",
"HUSHAN",
"HVP",
"HYDRAULAN",
"HYUNDAI",
"HYUNJIN",
"I&R",
"IBUKI",
"ICHIBAN",
"INCOLCA",
"INR",
"JCAP",
"JCC",
"JFP",
"KASHIMA",
"KCM",
"KENDALL",
"KGK",
"KIA",
"KINZO",
"KOWA",
"KOYO",
"KP",
"KTY",
"KYB",
"KYOSAN",
"LASTING",
"LECAM",
"LIAN TUOH",
"LUCID",
"LUK",
"MAC",
"MACHAGE",
"MAHIRO",
"MAHLE",
"MANDO",
"MARALPA",
"MAXFIT",
"MAZDA",
"MDS",
"MECARM",
"MILLARD",
"MITSUBA",
"MITSUBISHI",
"MOBIS",
"MONROE",
"MOOG",
"MORESA",
"MOTOR SEVEN",
"MOTOREX",
"MRK",
"MUSASHI",
"NACHI",
"NAKAJIMA",
"NAP",
"NAPA",
"NAPCO",
"NDC",
"NEW-ERA",
"NGK",
"NITRO OBD2",
"NJ",
"NKK",
"NP",
"NPR",
"NPW",
"NSK",
"NTN",
"OKAMI",
"OP",
"OPTIBELT",
"OSK",
"PARTS-MALL",
"PEAK",
"PERMATEX",
"PEVISA",
"PHILIPS",
"PHILLIPS 66",
"POLAR",
"PORTER",
"POS",
"PRESTONE",
"PROMAX",
"PTY",
"RALLY",
"RC",
"RECORD",
"REPSOL",
"ROCKY",
"SABO",
"SAKURA",
"SAMGONG GEAR",
"SAMURY",
"SANWA",
"SEIKEN",
"SEIWA",
"SEN-JEC",
"SH",
"SHOGUN",
"SIMYI",
"SKF",
"SKYFIL",
"STARK",
"SUN",
"TAIHO",
"TAMA",
"TBK",
"TCIC",
"TECFIL",
"TEIKIN",
"TEZUKA",
"TFP",
"THG",
"THO",
"TMM",
"TOKICO",
"TONG YANG",
"TOP MASTER",
"TOYOTA",
"TP",
"TRG",
"TRW",
"TSK",
"TYC",
"UNICK",
"V-WIN",
"VALEO",
"VARIOS",
"VISTONY",
"WAGNER",
"WTB",
"XTRAGUARD",
"YAU YOUNG",
"YEC",
"YSK",
"YSM"];

return $fabr;
    }

}