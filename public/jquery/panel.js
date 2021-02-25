 $('input').attr("autocomplete","off");
  
     var toggler = document.getElementsByClassName("caret");
            var i;
            for (i = 0; i < toggler.length; i++) {
              toggler[i].addEventListener("click", function() { 
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
              });
            }

function Registros(...args)
{
  const vista = (args.length > 0) ? args.shift() : null;
  const coleccion = (args.length > 0) ? args.shift() : null;
  const condiciones = (args.length > 0) ? args.shift() : null;
  const columnas = (args.length > 0) ? args.shift() : null;
  const destino = (args.length > 0) ? args.shift() : null;
  let aux=['',''];
  if (condiciones) {
                      aux=condiciones.split(',');
                    }

  $data="vista="+vista+"&coleccion="+coleccion+"&indice="+aux[0]+"&ocurrencia="+aux[1]+"&columnas="+columnas;
    
  $.get('/Resgistro', $data, function(subpage){ 
    
     if (columnas) { subpage=subpage[0][columnas]; }
          
     if (destino) {   $('#'+destino).html(subpage);       }
      else        {   $('#EspacioAccion').html(subpage);  }

  }).fail(function() {
       console.log('Error en carga de Datos');
  });
}

$('body').on( 'click', '.fa-trash-o', function () {  
                                                      
                                                                if (typeof $tablaMarcas=='undefined'){ return;} 
                                                                $tablaMarcas
                                                                  .row( $(this).parents('tr') )
                                                                  .remove()
                                                                  .draw(); 
                                                          
                                                    
                                                  });
  
//Activar boton de guardar para el formulario activo 
$('body').on('change', 'input, select', function()
{
    $("#btGuardaProd").attr('disabled',false);
});