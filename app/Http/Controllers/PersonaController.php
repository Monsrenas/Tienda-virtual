<?php
namespace App\Http\Controllers;  
use Illuminate\Http\Request;
use View;
use App\User; //modelo User del ORM eloquent  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonaController extends Controller 
{     

   public function Clase($ind)
    {
      $ind='App\\'.$ind;
      return $tmodelo=new $ind;
    }
 
   public function RegistrarUsuario(Request $request)
   {     
      $Clase=$this->Clase($request->clase);
      $vista='personas';

      $todo=$Clase::orderBy('email')->where('email', $request->email)->first();
      if ($request->clase=='Usuario')
      {
            if (isset($request->password))
            {
               $request['password']=Hash::make($request->password);
            } 
            else {
                  $request['password']=$todo->password;
                }
         $vista='usuarios';       
      }
    
      if (!$todo) {
                  $Clase::create($request->all());
               } 
               else { 

                     $todo->update($request->all()); 
                   }
      
      if ($request->clase=='Usuarios') { return redirect('/Listas/Usuario/auth.personas.Lista_usuarios'); }
      if (!isset($request->externo)){
                                        return redirect('/Listas/'.$request->clase.'/auth.personas.Lista_'.$vista);
                                     }  
   }


   public function seccionCliente($email=null)
   {
       if(!isset($_SESSION)){
                         session_start();
                       }
       if ($email) { $_SESSION['cliente']=$email; } 
       else {unset($_SESSION['cliente']);}
       return redirect('/');
   }

  public function EditaCliente($email=null)
   {
       $Clase=$this->Clase('Persona');
       if(!isset($_SESSION)){
                         session_start();
                       }

       if (isset($_SESSION['cliente'])) { 
                                $todo=$Clase::orderBy('email')->where('email', $_SESSION['cliente'])->get();
                                return View('autenticacion.EditaCliente')->with('lista',$todo);   
                             } 
       return View('autenticacion.login');
   }

}