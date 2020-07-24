
@extends('panel.menu')
@section('operaciones')

<div id="Centro"  style="font-size: 0.8em;">
	<form  method="POST"  action="javascript:GuardarDatos()" class="form-horizontal md-form" id="datosproducto" style="font-size: .85em;">

  <div class="card card-sm">
        
    <div class="card-header">
        <h6>Listado de productos</h6>
    </div>
    <div class="card-body">
      <div class="card-deck" >  

        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
              <strong class="col-lg-8" style="font-size: 1.6em;" ><i class="fa fa-list"></i> Productos </strong>
              <div style="float: right;">
                <input type="text" name="FiltroMarca" placeholder=""> <i class="fa fa-search"></i>
              </div>
            </div>

            <div class="col-lg-12 card-body" style="background: white; padding: 0px; ">
            
                 <div style="height:50px"></div>
                             
                            <!--Ejemplo tabla con DataTables-->
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">        
                                                <table id="tablamarcas" class="table table-striped table-bordered" style="width:100%">
                                                <thead id="cuerpo">
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Nombre</th>
                                                        <th>Sub-Codigo</th>
                                                        <th>Código catálogo</th>
                                                        <th>Fabricante</th>
                                                         
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($producto as $indice =>$patmt)
                                                        <?php  
                                                          $descripcion=array_values($patmt['descripcion'])[0];
                                                        ?>                                

                                                        <tr>
                                                          <td style="font-size: 0.7em;">
                                                            {{$indice}}
                                                          </td>
                                                          <td>{{$descripcion}}</td>
                                                            <td>{{$patmt['codigo_adicional'] ?? '' }}</td>                              
                                                            <td>{{$patmt['codigo_catalogo'] ?? '' }}</td>                            
                                                            <td>{{$patmt['codigo_fabricante'] ?? '' }}</td>
                                                        </tr>
                                                    @endforeach                                      
                                                </tbody>        
                                               </table>                  
                                            </div>
                                        </div>
                                </div>  
                            </div>    

            </div>
        </div>
      </div>    <!-- card-columns -->

    </div>
  </div>    
  </form>
</div>

     
     
    <script type="text/javascript" src="/jquery/main.js"></script>


@endsection