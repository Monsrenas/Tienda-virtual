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
           $Snapshot=$reference->getSnapshot();
           $value = $Snapshot->getValue();
           //$value = $reference->getValue();

          return $value;
        }

    public function Info_Producto(Request $request)
     {
        $view = View::make($request->url);
        dd($request->info);
     }

    public function xVista(Request $request){    
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
            $Estructura['codigo_fabricante']=$ProdData[1];
            $Estructura['precio']=$ProdData[2];
            $Estructura['cantidad']=0;
            $Estructura['descripcion']=$ProdData[3];
            $Estructura['fotos']=array_slice($ProdData, 4);
            $Estructura['modelo']=$ext;  
        
           return $Estructura;
        }

    public function CarritoAgregarItem(Request $request)
    {   $Vista=$this->Vista($request);

        if(!isset($_SESSION)){
                         session_start();
                         if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}
                       }

        $TmpCon = $_SESSION['MyCarrito'];

        if (isset($TmpCon[$Vista->info['codigo']])) {$TmpCon[$Vista->info['codigo']]['cantidad']+=1;}
            else { 
                   $TmpCon[$Vista->info['codigo']]=$Vista->info;
                   $TmpCon[$Vista->info['codigo']]['cantidad']=1;
                 }
      

        //$tmn=count($TmpCon);
        
        //Session::put('MyCarrito', $TmpCon);

        $_SESSION['MyCarrito'] = $TmpCon;
        

        //session(['MyCarrito' => [$Vista->info['codigo']=>$Vista->info]]); 
        


        return $Vista;
    }

    public function CarritoEliminaItem(Request $request)
    {
        if(!isset($_SESSION)){     session_start();     }

        $TmpCon = $_SESSION['MyCarrito'];
        unset($TmpCon[$request->codigo]);    
        $_SESSION['MyCarrito'] = $TmpCon;
        return $request->codigo ;
    }

    public function CarritoCambiaCanti(Request $request)
    {
        if(!isset($_SESSION)){     session_start();      }    
        $TmpCon = $_SESSION['MyCarrito'];
        $TmpCon[$request->codigo]['cantidad']=$request->valor;    
        $_SESSION['MyCarrito'] = $TmpCon;
        return $request->codigo ;
    }        
}