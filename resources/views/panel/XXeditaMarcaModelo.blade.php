
@extends('menu')
@section('operaciones')

<div id="Centro"  style="font-size: 0.8em;">
	<form  method="POST"  action="javascript:GuardarDatos()" class="form-horizontal md-form" id="datosproducto" style="font-size: .85em;">

  <div class="card card-sm">
        
    <div class="card-header">
        <h6>Listado de marcas y modelos</h6>
    </div>
    <div class="card-body">
      <div class="card-deck" >  

        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
              <strong class="col-lg-8" style="font-size: 1.6em;" ><i class="fa fa-list"></i> Marcas </strong>
              <div style="float: right;">
                <input type="text" name="FiltroMarca" placeholder=""> <i class="fa fa-search"></i>
              </div>
            </div>

            <div class="col-lg-12 card-body" style="background: white; padding: 20px; ">
            
                 <div style="height:50px"></div>
                             
                            <!--Ejemplo tabla con DataTables-->
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">        
                                                <table id="tablamarcas" class="table table-striped table-bordered" style="width:100%">
                                                <thead id="cuerpo">
                                                    <tr>
                                                        <th><i class="fa fa-list"></i></th>
                                                        <th>Puesto</th>
                                                        <th>Ciudad</th>
                                                         
                                                        <th><i class="fa fa-list"></i> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>Arquitecto</td>
                                                        <td>Edinburgh</td>
                                                         
                                                        <td>$320,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Contador</td>
                                                        <td>Tokyo</td>
                                                      
                                                        <td>$170,750</td>
                                                    </tr>                
                                              
                                                </tbody>        
                                               </table>                  
                                            </div>
                                        </div>
                                </div>  
                            </div>    

            </div>
        </div>


        <div class="card">
            <div class="card-header bg-primary" style="color: white; " >
              <strong class="col-lg-8" style="font-size: 1.6em;" ><i class="fa fa-list"></i> Modelos </strong>
              
            </div>

            <div class="col-lg-12 card-body" style="background: white; padding: 20px; ">

                          <div style="height:50px"></div>
                             
                            <!--Ejemplo tabla con DataTables-->
                            <div class="container">
                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">        
                                                <table id="tablamodelos" class="table table-striped table-bordered" style="width:100%">
                                                <thead >
                                                    <tr>
                                                        <th><i class="fa fa-list"></i></th>
                                                        <th>Puesto</th>
                                                        <th>Ciudad</th>
                                                         
                                                        <th><i class="fa fa-list"></i> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tiger Nixon</td>
                                                        <td>Arquitecto</td>
                                                        <td>Edinburgh</td>
                                                         
                                                        <td>$320,800</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Garrett Winters</td>
                                                        <td>Contador</td>
                                                        <td>Tokyo</td>
                                                      
                                                        <td>$170,750</td>
                                                    </tr>                
                                              
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

    <script type="text/javascript">
                 let Marcas=[<?php include 'maz-partes-marcas-export.json'?>];
           
           for (var [key, value] of Object.entries(Marcas[0])) {
                  console.log(key); 
                  e=document.getElementById("cuerpo");
                  e.innerHTML+="<tr><td>-</td><td>"+key+"</td><td>"+value['nombre']+"</td></tr>"
           } 

    </script>  

@endsection