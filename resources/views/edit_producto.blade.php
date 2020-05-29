@extends('menu')


@section('operaciones')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="Centro">
	
	<form  method="POST" class="form-horizontal" style="font-size: .85em;">
  @csrf
    <div class="col-lg-10 card-header">

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_producto">Código Producto:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="codigo_producto" name="codigo_producto" placeholder="">
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion del producto" style="width: 500px;" required=''>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_catalogo">Código Catálogo:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="codigo_catalogo" name="codigo_catalogo" required=''>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_adicional">Código Adicional:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="codigo_adicional" name="codigo_adicional" required="">
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_fabricante">Código Fabricante:</label>
                  <div class="col-sm-3 input-group" >
                    <input type="text" class="form-control" id="codigo_fabricante" name="codigo_fabricante" placeholder="">
                    <div class="input-group-btn input-group-append">
                          <button class="btn btn-secondary"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.fabricante','codigo_fabricante','descr_fabricante')"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <label class="col-lg-2 col-form-label text-left" id="descr_fabricante">Descripcion</label>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_categoria">Categoría:</label>
                  <div class="col-sm-3 input-group">
                    <input type="text" class="form-control" id="codigo_categoria" name="codigo_categoria" placeholder="">
                    <div class="input-group-btn input-group-append">
                          <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <label class="col-lg-2 col-form-label text-left">Descripcion</label>
              </div>

              <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="estado">Unidad de Medida:</label>
                  <div class="col-lg-2">
                    <select class="form-control" id="codigo_unidad" name="codigo_unidad" style="font-size: 1em;">

                      <option>-</option>

                    </select>
                  </div>
              </div>

             <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="pvp">Precio de venta:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="pvp" name="pvp[]" placeholder="" required>
                  </div>
              </div>

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="foto">Fotos:</label>
                  <div class="col-sm-3">
                    <input type="file" class="form-control" id="foto" name="foto[]" style="width: 170%;">
                  </div>
              </div>
             <div class="form-group row" style="margin-bottom: 20px; ">
                  <label class="col-lg-2 col-form-label text-right" for="foto"></label>
                  <div class="col-sm-3" id="listfoto">
                   listado de fotos  
                  </div>
              </div>

             <div class="form-group row NatJur" style="margin-bottom: 5px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_modelo">Modelos:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="codigo_modelo" name="codigo_modelo[codigo_modelo]" placeholder="">
                  </div>
              </div>

               <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_modelo"></label>
                  <div class="col-sm-3">
                    Listado de molelos complatibles
                  </div>#
              </div>
      		  
      		  <div class="col-lg-10 text-right">
    				<button class="btn btn-success ">Guardar <i class="fa fa-save"></i></button>
 	  		  </div> 
       </div>

  	 </form>

</div>

@INCLUDE('modal')


@endsection