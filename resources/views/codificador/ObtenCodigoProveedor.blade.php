<style type="text/css">
   
table td { text-align: left;
}
  
</style>

<div class="container" style="background: white; width: 100%; text-align: center;">
                 <div style="height:40px; background: white;"></div>
                                        
    <div>
        <div class="table-responsive">        
            <table id="tablamarcas" class="table table-striped table-bordered">
            <thead id="cuerpo">
                <tr> 
                    <th>Nombre</th> 
                    <th>Identificacion</th> 
                    
                </tr>
            </thead>
            <tbody>
                @foreach($lista as $indice =>$patmt)
                   
                    <tr> 

                        <td style="font-size: 0.8em;" >
                          <a href="javascript:SetDatos('{{$patmt['_id']}}', '{{$patmt['nombre'] ?? '' }}')">
                            {{$patmt['nombre'] ?? ''}}
                          </a>    
                        </td>
                        
                        <td width="10" >{{$patmt['idpersonal'] ?? '' }}</td>

                    </tr>

                @endforeach                                      
            </tbody>        
           </table>                  
        </div>
    </div>
                                
</div>
<script type="text/javascript" src="{{Request::root()}}/jquery/main.js"></script>

<script type="text/javascript">

  function SetDatos($id, $text)
  { 
    $("[data-dismiss=modal]").trigger({ type: "click" }); /*Cierra ventana modal*/
    $('#proveedor').val($id);
    $('#proveeDesc').val($text);
  }

</script>