
<style type="text/css">
		.carHeader 
				  {
				  	  color: white;
				      display: block;      
				      width: 100%;
				      height: 36px;
				      padding: 4px;
				      background: blue;
				  }

		.carFoto {
					width: 20%;
					height: 60px;
					text-align: center;
					padding: 6px;
					margin-left: 2px;
					border: 2px solid gray;
					overflow: hidden;
					float: left;
					background: white;
			   }

	@supports(object-fit: cover){
    .carFoto img{
			      	height: 100%;
			      	object-fit: cover;
			      	object-position: center center;
			      	padding: 2px;
    			}}

    .contenInfo{
    				font-size: 0.8em;
					width: 72%;
					height: 60px;
					text-align: left;
					padding: 0px;
					margin-left: 2px;
					margin-top: 0px;
					 
					overflow: hidden;
					float: left;
			   }

    .carPrecio{ 
    			font-size: 1.4em;
    			text-align: right;
    			margin-right: 4px;
    			margin-top: -2px;
    			width: 78%;
    			height: 24px;
    			float: left;
    			
    		  }

    .carQuitar{	text-align: right;
    			margin-top: 1px;
    			width: 20%;
    			height: 18px;
    			float: right;
    			
    		  }
    .carInfLin{
    			margin-top: -2px;
    			width: 100%;
    			height: 20px;
    			float: left;
    			
    		  }
    .carItem {  height: 88px;
    			margin-top: 4px;
    			background: #dce7ff;
    			border: 2px solid #dce7ff;
    			  
    		 }

</style>

<div class="form-control carHeader">
  <div class="fa fa-shopping-cart" id="Carrito" style="float: left;"> 10 </div>
  <div class="fa fa-usd"  style="float: right;"> 100</div>
</div>

<div id="listaCarrito">

<div>	
	@for ($i = 1; $i < 11; $i++)
    <div class="carItem">
    	<a><div class='carFoto'><img src='Pieza {{$i}}.jpg' /></div></a>	
		<div class='contenInfo'>
			 <div class='carPrecio'>256.54</div>
			 <div class='carQuitar'><button class="btn btn-default fa fa-trash-o fa-lg"></button></div>
			 <div class='carInfLin'>Codigo del Producto</div>
			 <div class='carInfLin'>Nombre del Fabricante</div>
		</div>
		<div class='carInfLin'>Descripciom extenza del producto</div>
	</div>
	@endfor
</div>
	
</div>

