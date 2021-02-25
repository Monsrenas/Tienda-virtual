
@extends('panel.menu')
@section('operaciones')
 
<style type="text/css">
  .NatJur {  }
  .inputfield{ height:30px}


</style>


<div id="Centro"  style="font-size: 0.8em;">
  

  <div class="card card-sm">
        
    <div class="card-header">
        <h6>Información de la Empresa</h6>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
             
              <div class="row">  
               <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-list"></i> Datos Generales </strong>
              
              </div>
           
            </div>

            <div class="col-lg-12 card-body" style="background: white; padding: 0px; ">




<div class="containe col-lg-12">

<form action="{{url('/Empresa')}}" method="POST" class="form-horizontal" style="font-size: .85em;">
  @csrf
    <div class="col-lg-10 card-header">
               
              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="ruc">RUC:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="ruc" name="RUC" value="{{$lista->RUC ?? ''}}" required>
                  </div>
              </div>

             <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="nombre">Nombre:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{$lista->nombre ?? ''}}" required>
                  </div>
              </div>

             <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="nombrecomercial">Nombre comercial:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="nombre_comercial" name="nombre_comercial" value="{{$lista->nombre_comercial ?? ''}}" required>
                  </div>
              </div>

             <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="telefono">Teléfono:</label>
                  <div class="col-sm-3">
                    <input type="tel" class="form-control form-control-sm" id="telefono" name="telefono" value="{{$lista->telefono ?? ''}}" required>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="direccion">Dirección:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" value="{{$lista->direccion ?? ''}}" required>
                  </div>
              </div>

               <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
                  <label class="col-lg-2 col-form-label text-right" for="provincia">Provincia:</label>
                  <div class="col-sm-3">
                    <select class="form-control form-control-sm" id="provincia" name="provincia" style="font-size: 1.11em;" onchange="Cantones(0)"S>
                        <option> </option>
                    </select>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; "> 
                  <label class="col-lg-2 col-form-label text-right" for="canton">Cantón:</label>
                  <div class="col-sm-3">
                    <select class="form-control form-control-sm" id="canton" name="canton" style="font-size: 1.11em;">
                    </select>
                  </div>
              </div>

               <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="correo">Correo electrónico :</label>
                  <div class="col-sm-3">
                    <input type="email" class="form-control form-control-sm" id="correo" name="correo" value="{{$lista->correo ?? ''}}" required>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="whatsapp">Whatsapp:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="whatsapp" name="whatsapp" value="{{$lista->whatsapp ?? ''}}" required>
                  </div>
              </div>

              <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="IVA">IVA Facturacion :</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control form-control-sm" id="IVA" name="IVA" value="{{$lista->IVA ?? ''}}" required>
                  </div>
              </div>

               <div class="form-group row NatJur" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="firebase">Autenticación Firebase :</label>
                  <div class="col-sm-3">
                    <textarea class="form-control form-control-sm" id="firebase" name="firebase">
                      {{$lista->firebase ?? ''}}
                    </textarea>
                  </div>
              </div>
      </div>

 

 
</div>

  <div class="col-lg-10 text-right">
    <button class="btn btn-success ">Guardar <i class="fa fa-save"></i></button>
  </div>  
</form>
</div> 


</div>
</div>
</div>
</div>
</div>

@include('provincias')

<script type="text/javascript">

 myJson=<?php echo prueba(); ?>
  
/*alert(myJson['1']['cantones']['101']['canton']);*/
  Provincias({{$lista->provincia ?? ''}});

  function Cantones(canton){

    xProv=document.getElementById("provincia");
    if (xProv.selectedIndex==0) { return;}
    xCant=document.getElementById("canton");   

    for (let i = xCant.options.length; i >= 0; i--) {
          xCant.remove(i);
      }
        
    for (const prop in myJson[xProv.selectedIndex]['cantones']){
                
        var option = document.createElement("option"); 
        option.text = myJson[xProv.selectedIndex]['cantones'][prop]['canton'] ;
        option.value= prop;
        if (canton==prop) {
                            option.selected=true; 
                            
                          }        
        xCant.add(option);
      }
  }

  function Provincias(selecion){

      var x = document.getElementById("provincia");
      
      for (var i = 1; i < (Object.keys(myJson).length); i++) {
        var option = document.createElement("option");    
        option.text = myJson[i]['provincia'] ;
        option.value= i;
        if (selecion==i) {
                            option.selected=true; 
                            
                          }
        x.add(option);
      }

      Cantones({{$lista->canton ?? ''}});
  }



  

  function interaccion(obj, nvl){
      
      for (const prop in obj){
              if (typeof(obj[prop])=='object') 
                { interaccion(obj[prop],nvl+1); } else { console.log(`${nvl}- obj.${prop} = ${obj[prop]}`); }
      }  

  }

</script>
@endsection