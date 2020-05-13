<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;


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

    public function Leerbase()
        { 
           $database=$this->index();
            
           $reference = $database->getReference('marcas');
           $value = $reference->getValue();
          return $value;
        }

    public function Guardar(Request $request) 
    {   
        $atm=$this->GeneraModeloPersona($request);
        
        $database=$this->index();
        $newPost = $database->getReference('Persona')
        ->push($atm);
    }

    public function Actualizar() 
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

    public function GeneraModeloPersona($request)
    {
        $atm = array($request->persona, 'Cliente' => $request->cliente,
                                        'Proveedor'=>$request->proveedor,  
                                        'Empleado'=>$request->empleado, 
                                        'Accionista'=>$request->accionista);
        return $atm;
    }
}