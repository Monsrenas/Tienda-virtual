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

    public function Vista(Request $request){    
            $view = View::make($request->url);
            
            if($request->ajax()){
                return $view->with('info',$request); 
            }else return $view->with('info',$request);
    }

    public function CarritoAgregarItem(Request $request)
    {
        if ($request->session()->has('MyCarrito')) {
            echo $request->session()->get('mensaje'); // si existe imprime el valor de la variable mensaje
        } else { session(['MyCarrito' => []]); }
    }
        
}