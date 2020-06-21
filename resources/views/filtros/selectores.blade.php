        <div style="text-align: center;">

          <div class="input-group col-md-12" style="padding-bottom: 6px; margin-top: 2px;">
              <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="">
              <div class="input-group-btn input-group-append">
                    <button class="btn btn-secondary" id="btnbusqueda"><i class="fa fa-search"></i></button>
              </div>
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
                <option>CATEGORÍA</option>
              </select>

          </form>   -->
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
            $resul['marca']=[];
            $resul['modelo']=[];  
        $listMarca=$('.caret');
        //console.log($listMarca['0'].innerText );
        //console.log($listMarca);
        for (var i = 0; i < $listMarca.length; i++) {
                  $nMarca=($listMarca[i].innerText);
                  $nCodig=($listMarca[i].id);
                  for (var y = 0; y < ocurr.length; y++) {
                    $ind=($nMarca).toUpperCase().indexOf(ocurr[y].toUpperCase());
                    if ($ind>-1) {     
                                       //console.log($nMarca+" "+$nCodig); 
                                       $resul['marca'].push($nCodig);     
                                 }

                    }
                  
                  $listModelo=$('.dmrc'+$nCodig);
                  for (var z = 0; z < $listModelo.length; z++) {
                      $nModelo=$listModelo[z].innerText;
                      $nModCod=$listModelo[z].id;
                      for (var y = 0; y < ocurr.length; y++) {
                                            $ind=($nModelo).toUpperCase().indexOf(ocurr[y].toUpperCase());
                                              if ($ind>-1) { //console.log(" - "+$nModelo+" "+$nCodig+$nModCod); 
                                                                 $resul['modelo'].push($nCodig+$nModCod);      
                                                           }

                                          }
                    }  
                }      
          return $resul;
      }
      

    function BuscaCodigoCategoria(ocurr)
    {
        var $resul=[];
        $resul['categoria']=[];

        $listCategoria=$('.caretX,.xcaretX');
        //console.log($listMarca['0'].innerText );
        //console.log($listMarca);

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

         return $resul;  
    }

    function Filtrar(frase)
    {
      var ocurr=(frase).split(' '); 
      $resul=BuscaCodigoModelo(ocurr);
      $categ=BuscaCodigoCategoria(ocurr);
      if ($categ.length>0) {$resul['categoria']=$categ;}
      $resul['palabra']=ocurr;
      cargarListaProductos($resul);
    }

    $('#busqueda').keypress(function(event){
                  var keycode = (event.keyCode ? event.keyCode : event.which);
                  if(keycode == '13'){
                     if (($('#busqueda').val()).trim().length>0) {Filtrar($('#busqueda').val());}
                  }
    });


    $("#busqueda").focusin( function(){      $("#busqueda").select();    });


    $('body').on('click', '#btnbusqueda', function(){
             var texto="";
             

             if ($("#sMarca")[0].selectedIndex>0) {
                                  texto=$("#sMarca option:selected").text();
                                  if ($("#sModelo")[0].selectedIndex>0) {texto+=" "+$("#sModelo option:selected").text();}
                                } 

             if ($("#sSistema")[0].selectedIndex>0) { texto+=" "+$("#sSistema option:selected").text();   }

             if (texto.trim().length>0) { 
                                          $('#busqueda').val(texto); // escribe en el input de busqueda los valores seleccionados
                                          $("#sMarca")[0].selectedIndex = 0;
                                          a=vaciaSelecct("sModelo");
                                          $("#sSistema")[0].selectedIndex = 0;
                                          Filtrar(texto); 
                                        } else { Filtrar($('#busqueda').val()); }

             
           // Modal('Detalle_Producto',$(this).data("remoto"),$(this).data("extra"));     
     });
   

</script>
