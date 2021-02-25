<div id="Centro"  style="font-size: 0.9em;">
  <div class="card card-sm">
    <form action="{{ url('ActualizaModelo') }}" method="post">
    @csrf        
    <div class="card-header">
        <div class="row">  
              <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-edit"></i> Edición de Modelo: {{$marca ?? ''}}</strong>
              <div class="col-lg-1"> <button class="btn fa fa-save btn-success" type="submit"></button> </div>
        </div>
    </div>

    <div class="card-body">
     
            <div class="row">
            <div class="col-lg-4 card-body text-right" style=" padding: 20px; ">
                    <input type="text" name="_id" value="{{$lista->_id ?? ''}}" hidden>
                   <input type="text" name="id_marca" value="{{$lista->id_marca ?? ''}}" hidden> 
                   <label>Código:</label>
                   <input type="text" name="id_modelo" value="{{$lista->id_modelo ?? ''}}" readonly>
                   <br> <br>
                   <label>Nombre:</label>
                   <input type="text" name="nombre" value="{{$lista->nombre ?? ''}}" autofocus="autofocus" required>
                   
              
            </div>
            </div>
         

  
    </div>
    </form> 
  </div>    
   
</div>

  {{--   <script type="text/javascript" src="{{Request::root()}}//jquery/main.js"></script>--}}
