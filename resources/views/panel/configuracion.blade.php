@extends('panel.menu')
@section('operaciones')
@include('modal')
<style type="text/css">
    table td { text-align: center; }
    .marco_banner {
                      width: 100%;
                      max-width: 90%;
                      max-height: 100px;
    }

  @supports(object-fit: cover){
    .marco_banner img{
      height: 100%;
      object-fit: cover;
      object-position: center center;
      padding: 2px;
    }
</style>

 

<form  method="POST"  action="{{url('/configura')}}" class="form-horizontal md-form" id="configuracion">
  @csrf  

    <div class="card-header">
        <h5>Configuración Tienda Virtual</h5>
      </div>
<div id="Centro" class="card-deck" style="font-size: 0.8em;">

    <div class=" card" style="background: white; padding: 20px; text-align: center;">
      <h6>Búsqueda y visualización</h6>
        <div class="row" style="margin-bottom: 3px;">
            <div class="table-responsive">
                        
                    <table  class="table table-striped table-bordered" style="width:100%">
                    <thead id="cuerpo">
                      <tr>
                            <th>CAMPOS</th>
                            <th>BÚSQUEDA</th> 
                            <th colspan="3">VISUALIZAR</th> 
                      </tr>
                      <tr>
                            <th colspan="2"></th>
                            
                            <th>Stand</th>
                            <th>Detalles</th>
                            <th>Carrito</th> 
                      </tr>
                    </thead>
                    <tbody>         
                      <tr>
                        <th>Código</th> 
                          <td><input type="checkbox" name="config[cg]"></td>
                          <td><input type="checkbox" name="config[cv]"></td>
                          <td><input type="checkbox" name="config[dcv]"></td>
                          <td><input type="checkbox" name="config[ccv]"></td>
                      </tr>
                      <tr>   
                        <th>Nombre</th>
                          <td><input type="checkbox" name="config[ng]"></td>
                          <td><input type="checkbox" name="config[nv]"></td>
                          <td><input type="checkbox" name="config[dnv]"></td>
                          <td><input type="checkbox" name="config[cnv]"></td>                      
                      </tr>
                      <tr>
                        <th>Fabricante</th>
                          <td><input type="checkbox" name="config[fg]"></td>
                          <td><input type="checkbox" name="config[fv]"></td>
                          <td><input type="checkbox" name="config[dfv]"></td>
                          <td><input type="checkbox" name="config[cfv]"></td>                      
                      </tr>
                      <tr>  
                        <th>Códigos Adicionales</th>
                          <td><input type="checkbox" name="config[ag]"></td>
                          <td><input type="checkbox" name="config[av]"></td>
                          <td><input type="checkbox" name="config[dav]"></td>
                          <td rowspan="2"></td>                       
                      </tr>
                      <tr>  
                        <th>Nombres Adicionales</th>      
                          <td><input type="checkbox" name="config[dg]"></td>
                          <td>{{--<input type="checkbox" name="config[dv]">--}}</td>
                          <td><input type="checkbox" name="config[ddv]"></td>
                                    
                      </tr>  
                      <tr>  
                        <th>Cantidad en stock</th>      
                          <td> </td>
                          <td><input type="checkbox" name="config[sv]"></td>
                          <td colspan="2"></td>
                                           
                      </tr>   
                    </tbody>
              </table>                  
            </div>
         </div>  
         <h6>Nombre del negocio en la barra</h6> 
         <div>
          <label>Linea 1</label>
           <input type="text" name="config[nom1]" value="{{$lista->config['nom1'] ?? ""}}">
           <label style="margin-left: 20px">Linea 2</label>
           <input type="text" name="config[nom2]" value="{{$lista->config['nom2'] ?? ""}}">
         </div>
    </div>


    <div class=" card" style="background: white; padding: 20px;  text-align: center;">
      <h6>Banners</h6>
            <div class="row" style="padding: 20px;">
               
               
                <table  class="table table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Visualizar</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="text-align: right;">Banner</td>
                      <td><input type="checkbox" name="config[verbanner]"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td style="text-align: right;">Color de fondo</td>
                      <td><input type="checkbox" name="config[verfondo]"></td>
                      <td> <input type="color" name="config[color]" value="{{$lista->config['color'] ?? "" }}"></td>
                    </tr>
                  </tbody>
                </table>
             </div>  
              
            <div class="card"> 
              <input id="fotoUpl" type="file" style="display:none" name="ImgsTL" accept="image/*">
              <div class="card-header"> Galeria de Banners 
                <span style="float: right;">
                <button type="button" id="fotofile" class="btn btn-success btn-sm fa fa-folder" ></button>
                </span>  
              </div><div class="card-body" id="BannerGaleria" style="max-height: 500px; overflow: scroll;"></div>  
            </div> 
 
    </div>

</div>
    <div class="col-lg-12 text-md-left text-lg-center " style="padding-top: 10px;">
            <button class="btn btn-success btn-sm" id="GuardarForm" type="submit" disabled>Guardar <i class="fa fa-save"></i></button>
        </div>
  </form>
@if (isset($lista->config))
  @foreach ($lista->config as $key=>$opciones)  

       <script type="text/javascript">
         ($('input[type="checkbox"][name="config[{{$key}}]"]'))[0]['checked']='true';
         
       </script> 
  @endforeach
@endif

<script type="text/javascript">
  $('body').on('change', 'input', function()
{
     
      $("#GuardarForm").attr('disabled',false);
});

$('#fotofile').on('click', function(){
    $('#fotoUpl').click();
  });
  
  // Cuando el autentico cambia hace cambiar al falso
  $('input[type=file]').on('change', function(e){
    $(this).next().find('input').val($(this).val());
  });




function CargaBanner()
{
  $data='{{ csrf_token()}}';
         $.get('/Lista_banners', $data, function(subpage){ 
                                $('#BannerGaleria').empty().append(subpage);
                                  
                                    }).fail(function() {
                                           console.log('Error en carga de Datos');
                                       });
}

CargaBanner();

$('#fotoUpl').on('change', function(e){ 
    nombre=$(this).val();

    var miForm=document.getElementById('configuracion');   

            var dataFile = new FormData(miForm);
            
            $.ajax({ 
                             url: "/guardaFichero",
                            type: "post", 
                        dataType: "html",
                            data: dataFile,
                           cache: false,
                     contentType: false, 
                     processData: false 
                                                           
                  }).done(function(subpage){  
                           CargaBanner();
                                            });
});  

function EliminaBanner($file)

{     
    $data="fichero="+$file;  
    $.get('/delFiles', $data, function(subpage){ 

                                                  CargaBanner();
                                              }).fail(function() {
                                                                    console.log('Error en carga de Datos');
                                                                  });



}


</script>
@endsection