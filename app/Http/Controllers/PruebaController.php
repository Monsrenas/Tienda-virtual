<?php
namespace App\Http\Controllers;  
use Illuminate\Http\Request;
use View;
   use App\User; //modelo User del ORM eloquent  
   class PruebaController extends Controller 
   {     

   public function index() {      
   	                         return 'william'; 
   	                       }   

   public function prueba() {  
   							  //dd('Prueba de funcionamiento'); 
   							  $abc=view('otracosa');
   							     
   	                          return view('otracosa'); 
   	                       }   

   }