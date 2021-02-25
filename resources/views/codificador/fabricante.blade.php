<style type="text/css">
  .FabClas a:hover { 
            background: gray;
            color: white; 
            display: inline-flex;
            text-decoration-line: none;
          }
  .FabClas a {
      
        font-size: medium;
        color: gray;

    }   

  .FabClas li { 
                  list-style-type: none;
             }       
</style>
    
  <form class="form-grup" id="formBuscar">
      @csrf
      <input type="text" name="coleccion" value="Fabricante" hidden="">
      <input type="text" name="busqueda" style="width: 100%; margin-bottom: 2%; background: #F5F4F4; border: none;" placeholder="&#128270" onkeyup="NuevaLista(this.value, 'ListaFabricante')" autocomplete="off" >    
  </form>

    <div id="MemoriaFabricantes" class="FabClas" hidden=""  >
      
    </div>

    <div id="ListaFabricante"  class="list-group list-group-flush ListFabricant FabClas">
      
    </div>

  
 

<script type="text/javascript">

  
  cargarLista('formBuscar','MemoriaFabricantes','ListaFabricante',['codigo_fabricante','descr_fabricante']);


  /*carga el contenido de una colleccion en 2 div en forma de lista <li>*/
  function cargarLista($ElForm,$Memoria, $Visible, $campos)
  {  
     $data=$("#"+$ElForm).serialize();

     $.get('/Resgistro', $data, function(subpage){ 
        var $element='';  var $elemenX='';
        for (const prop in subpage)
            {
              $element=$element+"<li><a id='"+subpage[prop]['codigo']+"' class='guardados'>"+subpage[prop]['nombre']+"</a></li>" ;
               
              $datos=[subpage[prop]['codigo'].toString(),subpage[prop]['nombre'].toString()];
              $elemenX=$elemenX+"<li><a href=\"javascript:SetDatos('"+subpage[prop]['codigo']+"','"+subpage[prop]['nombre']+"');\" id='"+subpage[prop]['codigo']+"' class='fbct' >"+subpage[prop]['nombre']+"</a></li>" ;
            }      

          var txt = document.getElementById($Memoria);
          txt.innerHTML=$element;
          
          var txt = document.getElementById($Visible);
          txt.innerHTML=$elemenX;

    }).fail(function() {
       console.log('Error en carga de Datos');
  });

  }

   /* Modifica el contenido de la lista visible en la medida en que el usuario modifique el texto de busqueda*/ 
  function NuevaLista($Ocurrencia,$Memoria)
  {
     var x = document.getElementById($Memoria);     x.innerHTML="";

     var Elts = document.getElementsByClassName("guardados");
        for (var i = 0; i < Elts.length; i++) 
                    {    
                        if ( Elts[i].text.toUpperCase().indexOf($Ocurrencia.toUpperCase())>-1)
                          {
                            x.insertAdjacentHTML('beforeend',"<li><a href=\"javascript:SetDatos('"+Elts[i].id+"','"+Elts[i].text+"');\"  id='"+Elts[i].id+"'>"+Elts[i].text+"</a></li>") ;

                          } 
                      }
                                          
  }

</script>