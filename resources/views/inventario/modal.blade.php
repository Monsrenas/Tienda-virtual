<?php 
  if(!isset($_SESSION)){ session_start();}

  if (!isset($_SESSION['MyCarrito'])) {$_SESSION['MyCarrito']= [];}

  $Importe=0;
  $cantItem=0;
  $carLista=$_SESSION['MyCarrito']; 
  $i=1;

?>

<div class="modal" id="xPreFactura"  >
  <div class="modal-dialog" style="max-width: 1100px; ">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        
      </div>

      <!-- Modal body -->
      <div id="PreFactura-body" style=" padding: 30px; max-height: 500px; overflow: scroll;"> 

	

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" id="cierraPedido" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
      </div>

    </div>
  </div>
</div>