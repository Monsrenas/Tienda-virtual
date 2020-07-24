 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

    
  <form class="form-grup" id="formBuscar">
      @csrf
      <input type="text" name="referencia" value="fabricantes" hidden="">
      <input type="text" name="busqueda" style="width: 100%; margin-bottom: 5%;" placeholder="Ocurrencia para busqueda" onkeyup="NuevaLista(this.value, 'ListaFabricante')" >    
  </form>

    <div id="MemoriaFabricantes" hidden=""  >
      
    </div>

    <div id="ListaFabricante"  class="list-group list-group-flush ListFabricant">
      
    </div>

  
 

<script type="text/javascript">

  
  cargarLista('formBuscar','MemoriaFabricantes','ListaFabricante',['codigo_fabricante','descr_fabricante']);


  /*carga el contenido de una colleccion en 2 div en forma de lista <li>*/
  function cargarLista($ElForm,$Memoria, $Visible, $campos)
  {  
     $data=$("#"+$ElForm).serialize();

     $.get('DevuelveBase', $data, function(subpage){ 
        var $element='';  var $elemenX='';
        for (const prop in subpage)
            {
              $element=$element+"<li><a id='"+prop+"' class='guardados'>"+subpage[prop]+"</a></li>" ;
               
              $datos=[prop.toString(),subpage[prop].toString()];
              $elemenX=$elemenX+"<li><a href=\"javascript:SetDatos('"+prop+"','"+subpage[prop]+"');\" id='"+prop+"' class='fbct' >"+subpage[prop]+"</a></li>" ;
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