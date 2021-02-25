
@extends('panel.menu')
@section('operaciones')
 
<div id="Centro"  style="font-size: 1.2em; width: 50%; margin-left: 100px;">
  <div class="card card-sm">
    <div class="card-header">
        <h6>Estructura de categorías</h6>
    </div>
    <div class="card-body">

        <div class="card">
          <div class="card-header bg-primary" style="color: white; " >
            <div class="row">  
             <strong class="col-lg-10" style="font-size: 1em;" ><i class="fa fa-list"></i> Categorías </strong>
             <div class="col-lg-1"><a href="#" class="btn fa fa-plus btn-success" data-toggle="modal" data-target="#ModalAuxiliar"></a></div>
              </div>
            </div>

          </div>
          <div class="col-lg-12 card-body" style="background: white; padding: 0px; ">           
            @include('panel.modal.arbolCategorias')
          </div>
        </div>

    </div>
  </div>    
</div>
@include('panel.modal.Auxiliar')
<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>
@endsection
 