<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Marca;
use App\Modelo;
use App\Categoria;
use App\Fabricante;
use App\Generacion;
use App\Medida;
use App\Producto;
use App\Pre_recepcion;
use MongoDB\BSON\Regex;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
 
class MongoController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
        if(!isset($_SESSION)){
                         session_start();
                       }

        if (!isset($_SESSION['empresa'])) {
        									$Clase=$this->Clase('Empresa');
        									$todo=$Clase::first();
        									$_SESSION['empresa']=$todo;
        								  }     		 
    }

    public function Clase($ind)
    {
    	$ind='App\\'.$ind;
    	return $tmodelo=new $ind;
    }

 	public function BorraItem(Request $request)
	 	{
	 		$Clase=$this->Clase($request->clase);
	 		$condicion=explode ( ',' ,$request->condicion , 6 );   		 
	 		$todo=$Clase::orderBy($condicion[0])->where($condicion[0],$condicion[1])->first();
	 		$todo->delete();
	 		return $todo;
	 	}



	public function GuardaCodigo(Request $request)
		{	 

			$campo='_id'; if (isset($request->codigo)) {$campo='codigo'; }
			$request->$campo=strval($request->$campo);
			$Clase=$this->Clase($request->clase);

			if ($request->clase=="Producto") $request=$this->ValidaProducto($request);	

			$todo=$Clase::where($campo,$request->$campo)->first();

			if (!$todo) {
				$Clase::create($request->all());
			} else { $todo->update($request->all()); }
			return redirect()->back();
		}

	public function ValidaProducto($request)
		{
			  $todo=Producto::where("codigo",$request->codigo)->first();

			  if (!$todo) {
			  	$todo=new Producto;
			  	$todo->codigo=$request->codigo;
			  }
			 
              $todo->codigosAd=$request->codigosAd??[];
              $todo->descripciones=$request->descripciones??[];
              $todo->medidas=$request->medidas??[];
              $todo->modelos=$request->modelos??[];
              $todo->fotos=$request->fotos??[];
              $todo->save();
              return $request;
		}

	public function GuardaEmpresa(Request $request)
		{	 
			$Clase=$this->Clase('Empresa');
			$todo=$Clase::first();

			if (!$todo) {
				$Clase::create($request->all());
			} else { $todo->update($request->all()); }
			return View('panel.editaEmpresa')->with('lista',$todo);
		}

	public function GuardaConfiguracion(Request $request)
		{	 
			$Clase=$this->Clase('Configuracion');
			$todo=$Clase::first();

			if (!$todo) {
				$Clase::create($request->all());
			} else { $todo->update($request->all()); }
			return View('panel.configuracion')->with('lista',$todo);
		}		

   public function EditaProducto(Request $request, $id=null)
	    {  
	    	if (isset($id)) {
	    		$todo=Producto::where('codigo',$id)->first();
	    		if (!$todo) {$todo= new Producto;	$todo->codigo=$id;}
		    } else 	{
		    			$todo= new Producto;
		    		}
		    		
			return View('panel.editaProducto')->with('lista',$todo);	
	    }

	public function Resgistro(Request $request)
	    {	
	       $Clase=$this->Clase($request->coleccion);	
	       $todo=$Clase:: 
	       when((isset($request->indice)), function($q){
            											 return $q->where(request('indice'),request('ocurrencia'));
        											  })->
	       when((isset($request->signo)), function($q){
            											 return $q->where(request('indice'),request('signo'),request('ocurrencia'));
        											  })->
	       when((isset($request->columnas)), function($q){
	       												 $columnas=explode ( ',' ,request('columnas') , 10 );
            											 return $q->select($columnas);
        											  })->get();
	       if (isset($request->vista)) {   
										$view = View::make($request->vista);
										return $view->with('lista',$todo);
										}							
	       return $todo;
	    }    



public function Listas($clase, $vista, $condicion=null)
	    {	
	      if (!isset(Auth::user()->rol)) { return redirect('/panel');}	 	
	      $rol=Auth::user()->rol;
	      $cond='';
	      $rol='';
	      switch ($clase) {
          					case 'Usuario': $condicion='rol,>,'.$rol ; break;
        				  }

          $cond=$condicion ?? '';	  
	      $Clase=$this->Clase($clase);

	      $todo=$Clase:: when((isset($condicion)), function($q) use ($cond){
	      												$cndcn=explode ( ',' ,$cond , 3 );
	      												
	      												if (count($cndcn)==3)
	      												{
	      													return $q->where($cndcn[0],$cndcn[1],$cndcn[2]);	
	      												 }	else{
	      												            return $q->where($cndcn[0],$cndcn[1]);}
        											  })->
	      					get();

	      if ($clase=='Usuario') {$rol=['Super Administrador','Administrador de sistema','Administrador de Sucursal','Empleado'];}
	      if ($clase=='Persona') {$rol=['Cliente','Proveedor'];} 					


	      return View($vista)->with('lista',$todo)->with('rol',$rol);  
	    }

//Marcas y Modelos 
    public function ListaMarcas()
	    {
	        $todo=Marca::get();   
	      return View('panel.editaMarcaModelo')->with('lista',$todo);  
	    }

	public function ListaMarcasModelos(Request $request)
	{
		$todo=Marca::get();

		return $todo;
	}    
	public function CadenaMarcaModelo(Request $request)
	{
		
		if (strlen($request->codigo)==6)
		{
			$modelo=Modelo::where('id_modelo',$request->codigo)->first();
			return [$modelo->marca->nombre, $modelo->nombre];	
		}

		if (strlen($request->codigo)==3)
		{
			$modelo=Marca::where('id_marca',$request->codigo)->first();
			return [$modelo->nombre];	
		}
	}   

    public function nuevaMarca(Request $request)
	    {
	    	if (isset($request->id)) {
	    		$todo=Marca::where('id_marca', $request->id)->first();
		    } else {
		    			$todo=Marca::orderBy('id_marca', 'desc')->first();	
		    			if ($todo){
		    					    $nuevoID=str_pad($todo->id_marca+1, 3, "0", STR_PAD_LEFT);
		    					  } else {$nuevoID='001'; }
		    			$todo=new Marca;
		    			$todo->id_marca=$nuevoID;
		    			$todo->nombre='';
		    		}

			return View('panel.NuevaMarca')->with('lista',$todo);	
	    }

 	public function nuevoModelo(Request $request)
	    {
	    	 
	    	$id=$request->id;
	    	if (strlen($id)>3) {
	    		$todo=Modelo::orderBy('id_modelo')->where('id_modelo', $id)->first();
		    } else {		
		    			$todo=Modelo::orderBy('id_modelo', 'desc')->where('id_marca',$id)->first();
		    			if ($todo) {$nuevoID=str_pad($todo->id_modelo+1, 6, "0", STR_PAD_LEFT);}
		    			else ($nuevoID=$id."001");	
		    			$todo=new Modelo;
		    			$todo->id_modelo=$nuevoID;
		    			$todo->id_marca=$id;
		    			$todo->nombre='';
		    		}

		    $Marca=Marca::where('id_marca',$todo->id_marca)->select(['nombre'])->first();	
		    
			return View('panel.NuevoModelo')->with('lista',$todo)->with('marca',$Marca->nombre);	
	    }
	 

	public function ActualizaMarca(Request $request)
	{	
	 	$todo=Marca::where('id_marca', $request->id_marca)->first();

	 	if (!$todo) { Marca::create($request->all());
		     } else { $todo->update($request->all());}

		return redirect('EdicionMarcaModelo');
	}

	public function ActualizaModelo(Request $request)
	{	
		if (isset($request->_id)) {	
									$todo=Modelo::where('id_modelo',$request->id_modelo)->first();
									$todo->nombre=$request->nombre; 
									$todo->save();  
								  } else { 
								  			Modelo::create($request->all());
									     }

		return redirect('EdicionMarcaModelo');
	}

	public function nuevaFabricante(Request $request)
	    {

	    	$Clase=$this->Clase('Fabricante');	

	    	if (isset($request->codigo)) {
	    		$todo=$Clase::where('codigo', $request->codigo)->first();
		    } else {
		    			$todo=$Clase::orderBy('codigo', 'desc')->first();	
		    			if ($todo){
		    					     $nuevoID=str_pad($todo->codigo+1, 4, "0", STR_PAD_LEFT);
		    					   } else {
		    					   			  $nuevoID='0001';
				    					   }
		    			$todo=new $Clase;
		    			$todo->codigo=$nuevoID;
		    			$todo->nombre='';
		    		}

			return View('panel.NuevoFabricante')->with('lista',$todo);	
	    }

	public function ActualizaFabricante(Request $request)
	{	
		$Clase=$this->Clase('Fabricante');
	 	$todo=$Clase::where('codigo', $request->codigo)->first();

	 	if (!$todo) { $Clase::create($request->all());
		     } else { $todo->update($request->all());}

		return redirect('/Listas/Fabricante/panel.lista_fabricante');
	}


	public function nuevaCategoria(Request $request)
	{
		$Clase=$this->Clase('Categoria');
		$l=strlen($request->codigo)+3;
		$numero=1;
		$todo=$Clase::where('codigo','like',$request->codigo.'%')->where('codigo', 'regex', new Regex('^\w{'.$l.'}$', 'i'))->orderBy('codigo', 'desc')->first();

		if ($todo){
					$numero=substr($todo->codigo, -3, 3)+1;
				  } 

		$nuevoID=$request->codigo.str_pad($numero, 3, "0", STR_PAD_LEFT);
		$todo=new $Clase;
		$todo->codigo=$nuevoID;
		$todo->nombre='';
		//$todo=Categoria::whereRaw(['$where' => 'this.codigo.length == 3'])->get();

		$rama='/';
		for ($i=1; $i <($l)/3 ; $i++) { 
			$cmn=$Clase::where('codigo',substr($request->codigo, 0, $i*3))->first();
			$rama=$rama.$cmn->nombre.'/';
		}

		$view = View::make('panel.NuevaCategoria');
		return $view->with('lista',$todo)->with('rama',$rama);	
	}

	//Ficheros

	public function getImageRelativePathsWfilenames(Request $request)
    {

        $lista=array_merge(glob($request->codigo."*.jp*"),glob($request->codigo."*.png"));
     
        return $lista;
    }


	public function saveFiles(Request $request)
		{      
			$id=strftime("%G%m%d%H%M%S").$request->codigo;
	         //obtenemos el campo file definido en el formulario
	         $file = $request->file('ImgsTL');
	        
	         //obtenemos el nombre del archivo
	         //$nombre = $file->getClientOriginalName();
	         $nombre=$request->codigo.strftime("%G%m%d%H%M%S").".".$file->extension();

	         //indicamos que queremos guardar un nuevo archivo en el disco local
	         \Storage::disk('public')->put($nombre,  \File::get($file)); 
	       return $nombre;
		}

	public function guardaFichero(Request $request)
		{      
			
	         //obtenemos el campo file definido en el formulario
	         $file = $request->file('ImgsTL');
	        
	         //obtenemos el nombre del archivo
	         $nombre ="/images/banner/".$file->getClientOriginalName();

	         //indicamos que queremos guardar un nuevo archivo en el disco local
	         \Storage::disk('public')->put($nombre,  \File::get($file)); 
	       return $nombre;
		}	

	public function delFiles(Request $request)
	{	
		\Storage::delete($request->fichero);
	}	
}
