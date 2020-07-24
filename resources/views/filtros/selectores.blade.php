<style type="text/css">
   .CndcnEtq {
                 font-size: 0.6em;
                 border: 1px solid #8c8c8c;
                 color: white; 
                 background: #b4b4b4;
                 display: block;
                 padding: 4px;
                 margin-left:2px;
                 margin-bottom:2px;
                 margin-ttop:2px;
              }

  .CndcnEtq:hover {

                font-size: 0.8em;
                color: yellow;
              } 

</style>

        <div style="text-align: center;">
          <div class="input-group col-md-12" style="padding-bottom: 6px; margin-top: 2px;">
              <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="">
              <div class="input-group-btn input-group-append">
                    <button class="btn btn-secondary" id="btnbusqueda"><i class="fa fa-search"></i></button>
              </div>
          </div>

          <div id="EtqtCondicion" class="input-group col-md-12" style="padding-bottom: 6px; margin-top: 2px;">
              
          </div>          
<!--
          <form class="form-inline" style="float: left; padding: 2px;">
             
             <select id="sMarca" class="filtro" onchange="AgregaSubOpciones('sModelo','dmrc'+this.value)">
                <option>MARCA</option>
              </select>

             <select id="sModelo" class="filtro">
                <option>MODELO</option>
              </select>

             <select id="sSistema" class="filtro">
                <option>FABRICANTE</option>
              </select>

          </form>  
                                                                      -->
        </div>

<script type="text/javascript">

   function AgregaOpcion($id, $opcion, $valor)
   {
      var x = document.getElementById($id);
      var option = document.createElement("option");    
      option.text = $opcion ;
      option.value= $valor;
      x.add(option);
    }

    function AgregaSubOpciones($id, $cod) 
    {
        var y=vaciaSelecct($id);
        var Elts = document.getElementsByClassName($cod);
        for (var i = 0; i < Elts.length; i++) {
                                                  var option = document.createElement("option");    
                                                  option.text = Elts[i].text;
                                                  option.value= Elts[i].id;
                                                  y.add(option);
                                              }
    }

    function vaciaSelecct($id)
    {
      
       var x = document.getElementById($id);

        for (let i = x.options.length; i >= 1; i--) {
                                                          x.remove(i);
                                                    }
        return x;
    }

    function BuscaCodigoModelo(ocurr)
      {
        var $resul=[];
        var $retorno=[];
            $resul['marca']=[];
            $resul['modelo']=[];  
        $listMarca=$('.caret');
        $coincidencias=[];
      
        for (var i = 0; i < $listMarca.length; i++) {
                  $nMarca=($listMarca[i].innerText);
                  $nCodig=($listMarca[i].id);
                  for (var y = 0; y < ocurr.length; y++) {
                    $ind=($nMarca).toUpperCase().indexOf(ocurr[y].toUpperCase());
                    if ($ind>-1) {     
                                       insertaCondicion('Marca: '+$nMarca);
                                       $coincidencias[y]=ocurr[y];
                                       $resul['marca'].push($nCodig);     
                                 }

                    }
                  
                  $listModelo=$('.dmrc'+$nCodig);
                  for (var z = 0; z < $listModelo.length; z++) {
                      $nModelo=$listModelo[z].innerText;
                      $nModCod=$listModelo[z].id;
                      for (var y = 0; y < ocurr.length; y++) {
                                            $ind=($nModelo).toUpperCase().indexOf(ocurr[y].toUpperCase());
                                              if ($ind>-1) {  
                                                                 insertaCondicion($nMarca+': '+$nModelo);
                                                                 $coincidencias[y]=ocurr[y]; 
                                                                 $resul['modelo'].push($nCodig+$nModCod);      
                                                           }
                                          }
                    }  
                }      
    
         for (var [key, value] of Object.entries(ocurr)) { 
                                                            if ($coincidencias.includes(value)) { ocurr[key]='';  } 
                                                            }
         console.log(ocurr); 
         $retorno.push($resul);
         $retorno.push(ocurr);

         return   $retorno;
      }
      

    function BuscaCodigoCategoria(ocurr)
    {
        var $resul=[];
        var $retorno=[];
        $resul['categoria']=[];

        $listCategoria=$('.caretX,.xcaretX');

        for (var i = 0; i < $listCategoria.length; i++) {
            $nCateg=($listCategoria[i].innerText);
            $nCodig=($listCategoria[i].id);
            for (var y = 0; y < ocurr.length; y++) {

                    $ind=($nCateg).toUpperCase().indexOf(ocurr[y].toUpperCase());

                    if ($ind>-1) {      
                                      $resul=$nCodig.substring(3);     
                                 }
             }
        } 

         $retorno.push($resul);
         $retorno.push(depura(ocurr));

         return   $retorno;
    }

    function Filtrar(frase)
    {
       $('#EtqtCondicion').empty();   
      ocurr=depura(frase);
      $tmp=BuscaCodigoModelo(ocurr);
      $resul=$tmp[0];
      ocurr=depura($tmp[1]);
/*    $tmp=BuscaCodigoCategoria(ocurr);
      $categ=$tmp[0];
      ocurr=depura($tmp[1]);
      if ($categ.length>0) {$resul['categoria']=$categ;}*/
      $resul['palabra']=ocurr;
      $tmp=[];

      for (const key in $resul) 
                              {
                                  if ($resul[key].length!=0) {
                                                                $tmp[key]=$resul[key];
                                                             }
                              }

      cargarListaProductos($tmp);
    }

    function depura(ocurr)
    {
      if (typeof ocurr=== 'string') {ocurr=(ocurr).split(' ');}
      var $tmp=[];

      for (const key in ocurr) 
      {   
          if ((ocurr[key].trim()!='')&&(ocurr[key].trim().toUpperCase()!='DE')) {
                                          $tmp.push((ocurr[key].trim()).toString()); 
                                        }
      }

      return $tmp;
    }

    function insertaCondicion(condicion)
    {
      var elemento="<div class='CndcnEtq'>"+condicion+"<div>"; 
      $('#EtqtCondicion').append(elemento);  
    }

    $('#busqueda').keypress(function(event){
                  var keycode = (event.keyCode ? event.keyCode : event.which);
                  if(keycode == '13'){
                     if (($('#busqueda').val()).trim().length>0) {Filtrar($('#busqueda').val());}
                  }
    });

    $("#busqueda").focusin( function(){      $("#busqueda").select();    });

    $('body').on('click', '#btnbusqueda', function(){
             var texto=$('#busqueda').val();
             /*if ($("#sMarca")[0].selectedIndex>0) {
                                  texto=$("#sMarca option:selected").text();
                                  if ($("#sModelo")[0].selectedIndex>0) {texto+=" "+$("#sModelo option:selected").text();}
                                } */

             //if ($("#sSistema")[0].selectedIndex>0) { texto+=" "+$("#sSistema option:selected").text();   }
             if (texto.trim().length>0) { 
                                          $('#busqueda').val(texto); // escribe en el input de busqueda los valores seleccionados
                                          //$("#sMarca")[0].selectedIndex = 0;
                                          //a=vaciaSelecct("sModelo");
                                          //$("#sSistema")[0].selectedIndex = 0;
                                          Filtrar(texto); 
                                        } else { Filtrar($('#busqueda').val()); }
           // Modal('Detalle_Producto',$(this).data("remoto"),$(this).data("extra"));     
     });
   

</script>
