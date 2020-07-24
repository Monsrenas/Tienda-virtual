  <table style="width: 100%;">

    <tr>
      <td><strong>Código</strong></td>
      <td><strong>Descripción</strong></td>
      <td><strong>Cantidad</strong></td>
      <td><strong>Código Adicional</strong></td>
      <td><strong>Código Catálogo</strong></td>
      <td><strong>Código Fabricante</strong></td>    
      <td><strong></strong></td>
    </tr>

  <?php 
    if (!(isset($producto))) {return;}


    $i=0; 
    $color='0';
    $i=0;
  ?>
   @foreach($producto as $indice =>$patmt)

                            <?php 
                              $borrable=true;
                              $editable=true; 
                              $descripcion=array_values($patmt['descripcion'])[0];
                              if ($color=='ffff') {$color='f1f3f4';} else {$color='ffff';}  
                              $i=$i+1; 
                            ?>                                

                            <tr style="background: #{{$color}};">
                              <td style="font-size: 0.7em;">
                                {{$i}}--{{$indice}}
                              </td>
                              <td>{{$descripcion}}</td>
                              <td style="text-align: right; padding-right: 50px;">{{$patmt['cantidad'] ?? '' }}</td>
                                <td>{{$patmt['codigo_adicional'] ?? '' }}</td>                              
                                <td>{{$patmt['codigo_catalogo'] ?? '' }}</td>                            
                                <td>{{$patmt['codigo_fabricante'] ?? '' }}</td>
                            </tr>
                           
              @endforeach
 </table>