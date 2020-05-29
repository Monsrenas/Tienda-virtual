        <div style="text-align: center;">

          <div class="input-group col-md-12" style="padding-bottom: 6px; margin-top: 2px;">
              <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="">
              <div class="input-group-btn input-group-append">
                    <button class="btn btn-secondary" id="busqueda" onclick="Filtrar()" ><i class="fa fa-search"></i></button>
              </div>
          </div>

          <form class="form-inline" style="float: left; padding: 2px;">

             

             
             <select id="sMarca" class="filtro" onchange="AgregaSubOpciones('sModelo','dmrc'+this.value)">
                <option>MARCA</option>
              </select>

             <select id="sModelo" class="filtro">
                <option>MODELO</option>
              </select>

             <select id="sSistema" class="filtro">
                <option>SISTEMA</option>
                <option value="Iluminación">Volvo</option>
                <option value="Frenado">Saab</option>
                <option value="Arranque">Mercedes</option>
                <option value="Suspensión">Audi</option>
              </select>

          </form>
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
        var x = document.getElementById($id);
        for (let i = x.options.length; i >= 1; i--) {
                                                          x.remove(i);
                                                    }

        var Elts = document.getElementsByClassName($cod);
        for (var i = 0; i < Elts.length; i++) {
                                                  var option = document.createElement("option");    
                                                  option.text = Elts[i].text;
                                                  option.value= Elts[i].id;
                                                  x.add(option);
                                              }
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

    function Filtrar()
    {
      var ocurr=($('#busqueda').val()).split(' ');
      $resul=BuscaCodigoModelo(ocurr);
      $resul['palabra']=ocurr;
      cargarListaProductos($resul);
    }


    $('body').on('click', '#dbusqueda', function(){
             
           // Modal('Detalle_Producto',$(this).data("remoto"),$(this).data("extra"));     
    });

</script>
