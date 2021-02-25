  
 <div id="Centro"  style="font-size: 0.9em;">
  <div class="card card-sm">
    <form action="{{ url('/GuardaCodigo') }}" method="post">
    @csrf        
    <input type="text" name="clase" value="Almacen" hidden>
    <div class="card-header">
        <div class="row">  
              <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-edit"></i> Edición de Almacén </strong>
              <div class="col-lg-1"> <button class="btn fa fa-save btn-success" type="submit"></button> </div>
        </div>
    </div>

    <div class="card-body">
     
            <div class="row">
            <div class="col-lg-10 card-body text-right">
                
                   <label>Código:</label>
                   <input type="text" name="codigo" value="{{$lista[0]->codigo ?? ''}}"  >
                   <br> <br>
                   <label>Nombre:</label>
                   <input type="text" name="nombre" value="{{$lista[0]->nombre ?? ''}}" autofocus="autofocus" required>
          
            </div>
            </div>
        
    </div>
    </form> 
  </div>    
   
</div>

{{--<script type="text/javascript" src="{{Request::root()}}//jquery/main.js"></script>
 --}} 

