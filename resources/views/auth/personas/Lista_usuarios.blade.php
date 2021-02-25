
@extends('panel.menu')
@section('operaciones')


<?php 
    $rl=intval(Auth::user()->rol ?? 4);
?>
<div id="Centro"  style="font-size: 0.8em;">
	<form  method="POST"  action="" class="form-horizontal md-form" id="datosproducto" style="font-size: .85em;">

  <div class="card card-sm">
        
    <div class="card-header">
        <h6>Listado de usuarios</h6>
    </div>
    <div class="card-body">
      <div class="card-deck" >  

        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
             
              <div class="row">  
               <strong class="col-lg-10" style="font-size: 1.6em;" ><i class="fa fa-list"></i> Usuarios </strong>
              <div class="col-lg-1"><a href="javascript:Registros('auth.personas.registraUsuario', 'Usuario', '_id', '')" class="btn fa fa-plus btn-success"></a></div>
              </div>
           


            </div>

            <div class="col-lg-12 card-body" style="background: white; padding: 0px; ">
            
                 <div style="height:50px"></div>
                             
                            <!--Ejemplo tabla con DataTables-->
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">        
                                                <table id="tablamarcas" class="table table-striped table-bordered">
                                                <thead id="cuerpo">
                                                    <tr>
                                                        <th></th>
                                                        <th>Identificacion</th>
                                                        <th>Rol</th>
                                                        <th>Nombre</th>
                                                        <th>Correo</th>
                                                        <th>Direccion</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lista as $indice =>$patmt)
                                                    <tr>
                                                      <td width="5">
                                                        @if (($rl<intval($patmt['rol']))or($rl==1)) 
                                                        <a href="javascript:Registros('auth.personas.registraUsuario', 'Usuario', '_id,{{$patmt['_id']}}', '')" class="btn btn-sm" style="font-size: 0.8em;"><i class="fa fa-pencil" style="font-size: 1.3em;"></i></a>
                                                        @endif  
                                                      </td>
                                          
                                                      <td style="font-size: 0.8em;">{{$patmt['idpersonal'] ?? ''}}</td>
                                                      <td>{{$rol[$patmt['rol']-1] ?? '' }}</td>
                                                      <td>{{$patmt['nombre'] ?? '' }}</td>                             
                                                      <td>{{$patmt['email'] ?? '' }}</td>
                                                      <td>{{$patmt['direccion'] ?? '' }}</td>
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


<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>
@endsection