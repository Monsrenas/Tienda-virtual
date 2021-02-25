  
 <?php if (isset($lista[0])) { $lista=$lista[0];}?>  
 <div id="Centro"  style="font-size: 0.9em;">
  <div class="card card-sm">
    <form action="{{ url('/GuardaCodigo') }}" method="post">
    @csrf        
    <input type="text" name="clase" value="Categoria" hidden>
    <div class="card-header">
        <div class="row">  
              <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-edit"></i> Edición de Categorías </strong>
              <div class="col-lg-1"> <button class="btn fa fa-save btn-success" type="submit"></button> </div>
        </div>
    </div>
    

    <div class="card-body">

            @if (isset($rama))
                  <div style="text-align: center; padding: 4px; color: blue;">  
                  @if ($rama=='/')
                      Nueva Categoría
                  @else
                      Nueva Sub-categoría de: <br><strong> {{$rama}} </strong> 
                  @endif
                  </div>
            @endif

            <div class="row">

            <div class="col-lg-10 card-body text-right">
                
                   {{--<label>Código:</label>--}}
                   <input type="text" name="codigo" value="{{$lista->codigo ?? ''}}" readonly hidden>
                   
                   <label>Nombre:</label>
                   <input type="text" name="nombre" value="{{$lista->nombre ?? ''}}" autofocus='true' required>
                   
            </div>
            </div>
           
    </div>
    </form> 
  </div>    
   
</div>

 </script>
