<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Pedido;
use App\Factura;
use App\Cancelacion;
use App\Usuario;
use Auth;
use App\Inventario;
use Illuminate\Support\Facades\Mail;

class VentasController extends InventarioController
{
    //
    

    public function formaDePago($ind){
    		$formaDePago=[];
			$formaDePago=[
	      						'EF'=>'Efectivo',
	      						'CH'=>'Cheque',
	                          	'TR'=>'Transferencia',
	                          	'CR'=>'Crédito',
	                          	'TD'=>'Tarjeta de Débito',
	                          	'TC'=>'Tarjeta de Crédito' 
	      	      			];
			return $formaDePago[$ind];
	}

    

	public function ComoPago()
	{
		$cliente='';
		if(!isset($_SESSION)){ session_start();}		
		if (isset($_SESSION['cliente'])){
											$cliente=Persona::where('email',$_SESSION['cliente'])->first();
										}
		return View('inventario.formaPago')->with('cliente',$cliente);
	}

	public function preFactura()
	{

		return View('inventario.pre_factura');
	}
    
	public function registraPedido($formaPago=null)
	{
		if(!isset($_SESSION)){ session_start();}
		if (isset($_SESSION['MyCarrito'])) {$Carrito=$_SESSION['MyCarrito'];} else {   return []; }
		if (isset($_SESSION['cliente'])){   $cliente=Persona::where('email',$_SESSION['cliente'])->first();  } 
								   else {   return; }						   
			
		$detalles=[];
		$pedido=new Pedido;

		$pedido->codigo='PDD'.strftime("%G%m%d%H%M%S");
		$pedido->id_cliente=$cliente->_id ?? '';
		$pedido->estado='pendiente';
		$pedido->forma_pago=$formaPago;
		$Importe=0;
		$productos=[];

		foreach ($Carrito as $key => $value)  { 
			$Prod=$this->Precios($Carrito[$key]['indice']);

			$precio=sprintf('%.2f',isset($Prod->precio) ? floatval(str_replace(',','.',$Prod->precio) ):1);
			$cantid=(isset($Carrito[$key]['cantidad']) ? (double) $Carrito[$key]['cantidad'] : 0);
			$itemImporte= sprintf('%.2f',(float)$precio*(float)$cantid);
			$Importe+=sprintf('%.2f',(float)$precio*(float)$cantid);
		
		    $productos[$Prod->_id]=[  	'codigo'  => $Carrito[$key]['indice']??0, 	
										'cantidad'=>$Carrito[$key]['cantidad']??0,
										'precio' =>$Prod->precio ??0,
										'descuento' =>$Prod->descuento ??"",
										'entregado' =>0
									];					  						                              
        }

        $IVA=(sprintf('%.2f',((float) $Importe*floatval( $_SESSION['empresa']['IVA']??0))/100 ));
		$pedido->valor=sprintf('%.2f',(float)$IVA+(float)$Importe);

        $pedido->productos=$productos;

        $pedido=collect($pedido);
        $pedido=Pedido::create($pedido->all());

        $this->CorreoExamen("Nuevo Pedido", "Cliente");

        $lista=$this->muestraPedido($pedido->codigo);
        return View('inventario.pedido_enviado')->with('cliente',$cliente)->with('lista',$lista);								  
	}

	public function resumenPedidoImporte()
	{	
		if(!isset($_SESSION)){ session_start();}
		if (!isset($_SESSION['cliente'])) {return [];}
		$Clase="App\\Persona";
		$todo=$Clase::select(['_id','valor'])->where('email', $_SESSION['cliente'])->first();
		
		$lista=Pedido::where('id_cliente',$todo->_id)
				->where('forma_pago','<>','TC')
				->where('forma_pago','<>','TD')
				->orderBy('created_at', 'DESC')
				->get();
		return View('pagos.registrar')->with('lista',$lista);

	}

	public function gestionaPedido($pedido=null)
	{
		$lista=Pedido::where('codigo', $pedido)->first();
		$detalles=[];
		if (isset($lista->productos)){
				foreach ($lista->productos as $key => $value) {
					$Prod=Inventario::where('codigo', $value["codigo"])->first();
					$detalles[$key]["INVprecio"]=$Prod->precio;
					$detalles[$key]["INVstock"]=$Prod->cantidad;
					$detalles[$key]["nombre"]=$Prod->detalles->nombre??"";
					$detalles[$key]["almacen"]=$Prod->almacenes->nombre??"";
				}
		}
		  $lista->forma_pago=$this->formaDePago($lista->forma_pago);

		return View('ventas.Venta')->with('lista',$lista)->with('detalles',$detalles);			
	}

	public function muestraPedido($pedido)
	{
		$lista=Pedido::where('codigo', $pedido)->first();
		$detalles=[];
		foreach ($lista->productos as $key => $value) {

			$Prod=$this->Precios($value['codigo']);
			$detalles[$key]=[ 
		       						   'nombre'=>$Prod->detalles->nombre??"",
		       						   'codigo'=>$Prod->detalles->codigo??"",
		       						   'precio'=>$Prod->precio,
		       						   'foto'=>$Prod->detalles->fotos['nombre'][0]??"",
		       						   'disponible'=>$Prod->cantidad
		       						 ]; 
		}
		$lista->detalles=$detalles;
		$lista->fecha=$this->FechaDescriptiva($lista->created_at);
        $lista->forma_pago=$this->formaDePago($lista->forma_pago);
        return $lista;
	}

	public function listaPedidos()
	{
		$lista=Pedido::orderBy('created_at', 'DESC')->get();	
		return View('ventas.Lista_pedidos')->with('lista',$lista);	
	}

	public function Facturar(Request $request)
	{
		$pedido=Pedido::where('_id',$request->id_pedido)->first();
		 
		$factura=new Factura;
		$factura->codigo='FAC'.strftime("%G%m%d%H%M%S");
		$factura->id_pedido=$request->id_pedido;       
        $factura->id_cliente=$pedido->id_cliente;
        $factura->forma_pago=$pedido->forma_pago;      
        $factura->IVA=$_SESSION['empresa']['IVA']??0;

        $factura->id_vendedor=Auth::user()->_id;
        
        //'documento_pago',
              
        $productos=[];
        $NuevaListaPedido=[];

        foreach ($request->productos as $key => $value) {
         //dd($pedido->productos[$key]);	
          $cantidad=number_format($value['cantidad']);	
          if ($cantidad<1) {
	          					$NuevaListaPedido[$key]=$pedido->productos[$key];
	          					continue;
          					}

          $cantPedida=number_format($pedido->productos[$key]['cantidad']);
		  $Prod=Inventario::where('codigo', $pedido->productos[$key]['codigo'])->first();
		  $precio_Origen=number_format(str_replace(",", ".", $Prod->precio), 2, '.', '');
		  $precio=number_format(str_replace(",", ".", $pedido->productos[$key]['precio']), 2, '.', '');
		  $descuento=number_format(floatval($precio_Origen-$precio), 2, '.', '');	 
		  
		  $productos[$key]=[   	
		  					   'codigo'=>$Prod['codigo'],
		  					   'cantidad'=>$value['cantidad'],
		  					   'precio_Origen'=>$Prod->precio,
		  					   'precio'=>$pedido->productos[$key]['precio'],
		  					   'descuento'=>number_format($descuento, 2, '.', ''),		
		  					];     

		 if ($cantidad>0) $this->VariaStock($Prod['codigo'], "-C", $value['cantidad']);
		 if ($cantidad<$cantPedida){
		 		 					  $NuevaListaPedido[$key]=$pedido->productos[$key];
		 		 					  $NuevaListaPedido[$key]['cantidad']=$cantPedida-$cantidad;
		 		 					   
		 		 					} 
		  	 											 
		}

		$factura->productos=$productos;	
		$factura=collect($factura);
		$factura=Factura::create($factura->all());

		if (count($NuevaListaPedido)>0)
		{
			$pedido->productos=$NuevaListaPedido;	
			$pedido->estado=1;
			$pedido->update();
		}	else 	{
						$pedido->delete();
					}
		 
		 

		$factura=$this->Factura($factura->codigo);

		return  $factura;	
	}

	public function Despachar(Request $request)
	{
		$factura=Factura::where('codigo',$request->factura)->first();
		 
        $id_despacho=Auth::user()->_id;
        $estado=2; // Totalmente entregado
 
        $NuevaListaPedido=[];

        foreach ($request->productos as $key => $value) {
        	
        $entregado=number_format($value['entregado']);
        $cantidad=number_format($factura->productos[$key]['cantidad']);
        	
         $NuevaListaPedido[$key]=$factura->productos[$key];	
		 if ($entregado>0) 
			{
				$this->VariaStock($factura->productos[$key]['codigo'], "-F", $value['entregado']); 	
			 	$NuevaListaPedido[$key]['entregado']=$entregado;
			 	$NuevaListaPedido[$key]['user']=$id_despacho;					   
			}
		 if ($entregado<$cantidad) $estado=1; //Parcialmente entregado	
		}	

		$factura->productos=$NuevaListaPedido;	
		$factura->estado=$estado;
		$factura->update();
		
		$factura=$this->Factura($factura->codigo);

		return  $factura;	
	}

	public function Factura($numero=null, $vista='ventas.Factura')
	{
         
        $detalles=[];
        $clase="App\\Factura";
        if (substr($numero, 0,3)=="CAN") $clase="App\\Cancelacion";


        $factura=$clase::where('codigo',$numero)->first();
        foreach ($factura->productos as $key => $value) {
         
			$Prod=Inventario::where('codigo', $value['codigo'])->first();
			$detalles[$key]=[ 
		       						   'nombre'=>$Prod->detalles->nombre,
		       						   'codigo'=>$Prod->detalles->codigo, 
		       						   'foto'=>$Prod->detalles->fotos['nombre'][0],
		       						   'stock'=>$Prod->cantidad,
		       						   'fisico'=>$Prod->fisico ?? $Prod->cantidad,
		       						 ];    						 
		}
		 
		$factura->detalles=$detalles;  
		$factura->Describe_pago=$this->formaDePago($factura->forma_pago);
		$factura->Fecha=$this->FechaDescriptiva($factura->created_at);



		return View($vista)->with('lista',$factura);	
	}

	public function Cancelar_factura(Request $request)
	{	 	  
        $factura=Factura::where('codigo',$request->factura)->first();
        $cancela=new Cancelacion;
		$cancela->codigo=substr("CAN".$factura->codigo, 3);
        $cancela->id_cancelador=Auth::user()->_id;
        $cancela->motivo=$request->motivo;
        

        $cancela->codigo="CAN".substr($factura->codigo, 3);
       
        $cancela->id_pedido=$factura->id_pedido;
        $cancela->id_cliente=$factura->id_cliente;
        $cancela->id_vendedor=$factura->id_vendedor;
        $cancela->forma_pago=$factura->forma_pago ?? null;
        $cancela->documento_pago=$factura->documento_pago ?? null;
        $cancela->descuento=$factura->descuento ?? null;
        $cancela->IVA=$factura->IVA ?? null;
        $cancela->productos=$factura->productos;

         foreach ($factura->productos as $key => $value) {

        	$entregado=0;
        	if (isset($value['entregado'])) $entregado=number_format($value['entregado']) ;
	        $cantidad=number_format($value['cantidad']);
	        		
			 if ($entregado>0) 
				{
					$this->VariaStock($factura->productos[$key]['codigo'], "+F", $entregado); 						   
				}
			if ($cantidad>0) 
				{
					$this->VariaStock($factura->productos[$key]['codigo'], "+C", $cantidad); 						   
				}	
		}	

		$cancela=collect($cancela);
		Cancelacion::create($cancela->all());
		$factura->delete();
		 
		$cancelacion=$this->Factura($cancela["codigo"]);

		return  $cancelacion;     
	}

	public function Precios($Cod)
	{
		if(!isset($_SESSION)){ session_start();}
		if (isset($_SESSION['cliente'])){   $cliente=Persona::where('email',$_SESSION['cliente'])->first();  }

		$Prod=Inventario::where('codigo', $Cod)->first();

        if ($cliente){  	$Prod=$this->Descuento($Prod);		}

        if ((isset($Prod->descuento))and($Prod->descuento>0))
        {
          $precio=str_replace(",", ".",$Prod->precio); 	
          $descuento=str_replace(",", ".",$Prod->descuento);
          $Prod->precio=number_format(floatval($precio)-((floatval($precio)*floatval($descuento)/100)), 2, '.', ''); 
        }  
        return $Prod;    
	}

public function FechaDescriptiva($date)
{
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                   $fecha = \Carbon\Carbon::parse($date);
                   $mes = $meses[($fecha->format('n')) - 1];
    return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y') ?? "";                
}

public function EnviaMensaje($id, $msg, $token)
{
	$token = $token;

	$data = [
	       'text' => $msg,
	       'chat_id' => $id
	];

	file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
}

public function CorreoExamen($Contenido, $user)
     {
         if(!isset($_SESSION)){
                         session_start();
                       } 
         $nombre=$_SESSION['cliente']??"";
        
        Mail::send("Correo_Pedido" , [], function ($mail) use ($Contenido, $nombre, $user) {
            $mail->subject('Examen '.$user);
            $mail->from('firebase.f1motriz@gmail.com', 'Tienda Virtual');
            $mail->to($nombre);
            $mail->to('firebase.f1motriz@gmail.com');
            //$mail->attachData($Contenido->output(), $nombre.'_Exam.pdf');
        });
    }


}//Cierre de la Clase
