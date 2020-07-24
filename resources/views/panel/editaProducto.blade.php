
@extends('panel.menu')
@section('operaciones')
<div id="Centro" style="font-size: 0.8em;">
	<div class="header">
    
  </div>
	<form  method="POST"  action="javascript:GuardarDatos()" class="form-horizontal md-form" id="datosproducto" style="font-size: .85em;">
    <div class="card-header card">
        <h6>Registro de productos</h6>
      </div>
    <div class="col-lg-12 card" style="background: white; padding: 20px; ">
      
        <div class="form-group row"  style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="codigo_producto">Código Producto:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="codigo_producto" name="codigo_producto" placeholder="Código">
              <div class="col-sm-12" id="grupocodigo">  </div>
            </div>

            <div class="col-sm-7" id="grupodescripcion">
                  <input type="text" class="form-control form-control-sm" id="Xdescripcion" name="descripcion[]" placeholder="Descripcion del producto" required=''> 
            </div>
        </div>

        <div class="form-group row NatJur" style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_producto">Códigos Adicionales:</label>
            <div class="col-sm-3 input-group" >
                  <input type="text" class="form-control form-control-sm" id="codigo_adicionales" placeholder="(2)" disabled>
                      <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" >
                              <i class="fa fa-th"></i>
                          </button>
                      </div>
              </div>

              <div class="col-sm-7 input-group" >
                  <input type="text" class="form-control form-control-sm" id="otras_descripciones" placeholder="Otras descripciones" disabled="">
                      <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" >
                              <i class="fa fa-th"></i>
                          </button>
                      </div>
              </div>
        </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_fabricante">Fabricante:</label>
                  <div class="col-sm-3 input-group" >
                    <input type="text" class="form-control form-control-sm" id="codigo_fabricante" name="codigo_fabricante" placeholder="">
                    <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoFabricante','codigo_fabricante','descr_fabricante')"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <label class="col-lg-2 col-form-label text-left" id="descr_fabricante"></label>
              </div>

            <div id="medidas" class="grupoDT">
             <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="precio_Venta">Medidas:</label>
                  <div class="col-sm-3 input-group">
                    <select name="cars" id="cars">
                      <option value="volvo">Alto interno</option>
                      <option value="saab">Alto externo</option>
                      <option value="mercedes">Profundidad interna</option>
                      <option value="audi">Profundidad externa</option>

                    </select>
                    <input type="text" class="form-control form-control-sm" id="xMedidas" placeholder="">
                    <div class="input-group-btn input-group-append">
                      <button type="button" class="btn btn-success btn-sm" onclick="NuevaMedida()"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>

              </div>
            </div>

            <div id="categoria" class="grupoDT">    
              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_categoria">Categoría:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_categoria" name="codigo_categoria" placeholder="">
                    <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoCategoria','codigo_categoria','descr_categoria')"><i class="fa fa-search"></i></button>
                    </div>
                                  
                 </div>
                  <label class="col-lg-2 col-form-label text-left" id="descr_categoria"></label>
              </div>

            </div>  

<!--
            <div id="precios" class="grupoDT">
             <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="precio_Venta">Precio de venta:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="precio_Venta" placeholder="">
                    <div class="input-group-btn input-group-append">
                      <button type="button" class="btn btn-success btn-sm" onclick="NuevoPrecio()"><i class="fa fa-plus"></i></button>
                    </div>
                  </div>

              </div>
            </div>
-->
            <div id="foto" class="grupoDT">
             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="foto">Fotos:</label>
                  <div class="col-sm-3 input-group">
                    
                      <input id="fotoNombre" class="form-control form-control-sm" type="text" placeholder="(0)" disabled>
                    <div class="input-group-btn input-group-append">
                      <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenNombreImagen','foto','foto')"><i class="fa fa-th"></i></button>
                    </div>
                  </div>
              </div>
             </div>

             <div class="grupoDT" id="modelo">
             <div class="form-group row NatJur " style="margin-bottom: 5px; ">
                  <label class="col-lg-2 col-form-label text-md-left text-lg-right " for="codigo_modelo">Valido para los Modelos:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control form-control-sm" id="codigo_modelo" name="codigo_modelo" placeholder="(8)">
                       <div class="input-group-btn input-group-append">
                          <button type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal"><i class="fa fa-th"></i></button>
                    </div>
   
                  </div>
                   <label class="col-lg-2 col-form-label text-left" id="descr_modelo"></label><br>
              </div>
              </div>
      		  
      		  <div class="col-lg-10 text-md-left text-lg-right " id="espacioGuardar" hidden="">
    				<button class="btn btn-success" id="GuardarForm" type="submit">Guardar <i class="fa fa-save"></i></button>
 	  		  </div> 
       </div>

  	 </form>
</div>
@endsection