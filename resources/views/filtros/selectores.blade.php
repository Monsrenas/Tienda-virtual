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

  #btnDELbusqueda {display: none;}            

</style>
  
          <input type="text" name="portador" id="portador" hidden>  
          <div class="input-group" class="form-group col-md-12 col-sm-2">
              <input type="text" class="form-control help-block" id="busqueda" name="busqueda" maxlength="128" placeholder="Buscar" size="125" type="text" >
              <div class="input-group-btn input-group-append">
                    <button class="btn btn-light" id="btnDELbusqueda"><i class="fa fa-times"></i></button>
                    <button class="btn btn-success" id="btnbusqueda"><i class="fa fa-search"></i></button>
              </div>
          </div>

          <div id="EtqtCondicion" class="input-group col-md-12" style="padding-bottom: 6px; margin-top: 2px;">
          </div>          
         

<script type="text/javascript">

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
                                                                 $resul['modelo'].push($nModCod);      
                                                           }
                                          }
                    }  
                }      
    
         for (var [key, value] of Object.entries(ocurr)) { 
                                                            if ($coincidencias.includes(value)) { ocurr[key]='';  } 
                                                            } 
                                              
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

      //cargarListaProductos($tmp);
      $dataCond='';
      for (const prop in $tmp){
      if (($tmp[prop]).length>0){  
            $dataCond+='&'+prop+'='+$tmp[prop];
      }
      }
      $('#portador').val($dataCond);
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
      //var elemento="<div class='CndcnEtq'>"+condicion+"<div>"; 
      //$('#EtqtCondicion').append(elemento);  
    }

    $('#busqueda').keypress(function(event){
                  var keycode = (event.keyCode ? event.keyCode : event.which);
                  if(keycode == '13'){
                     Filtrar($('#busqueda').val());
                     $('#btnbusqueda').click();
                  } 
    });

    $('#busqueda').on('change', function(){
                  Filtrar($('#busqueda').val());
    });

    /*Pulsación de una tecla en la barra de búsqueda*/
    $('#busqueda').on('keyup', function(){

          if ($('#busqueda').val()=="")
          {
              $('#btnDELbusqueda').hide(); 
              MuestraProductos("");
          } else { 
                    $('#btnDELbusqueda').show();  
                  }
    });

     $('#btnDELbusqueda').on('click', function(){
        $('#busqueda').val("");
        $('#btnDELbusqueda').hide(); 
        MuestraProductos(""); 
    });
    

    $("#busqueda").focusin( function(){      $("#busqueda").select();    });

</script>
