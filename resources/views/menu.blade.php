<!DOCTYPE html>
<html lang="en">
<head>
  
  

  <title>Kaizen</title>
   
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <style type="text/css">
    .dropdown-submenu {
  position: relative;
}

.dropdown-submenu a::after {
  transform: rotate(-90deg);
  position: absolute;
  right: 6px;
  top: .8em;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-left: .1rem;
  margin-right: .1rem;
}

.navbar-custom {
    background-color: blue;
}
/* change the brand and text color */
.navbar-custom .navbar-brand,
.navbar-custom .navbar-text {
    color: rgba(255,255,255,.8);
}
/* change the link color */
.navbar-custom .navbar-nav .nav-link {
    color: rgba(255,255,255,.5);
}
/* change the color of active or hovered links */
.navbar-custom .nav-item.active .nav-link,
.navbar-custom .nav-item:hover .nav-link {
    color: #ffffff;
}

  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="{{url('/inventario')}}">Inicio</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Operaciones
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <!--<li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li> -->

          <li class="dropdown-submenu" ><a class="dropdown-item dropdown-toggle disabled" href="#">Entrada</a>
            <ul class="dropdown-menu ">
              <li><a class="dropdown-item disabled" href="{{url('listadoProductos')}}">Listado</a></li>
              <li><a class="dropdown-item disabled" href="{{url('/productos')}}">Nuevo</a></li> 
            </ul>
          </li>


          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle disabled" href="#">Salida</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Marcas y Modelos</a></li>
              <li><a class="dropdown-item" href="#">Categoría</a></li>
              <li><a class="dropdown-item" href="#">Fabricantes</a></li>
            </ul>
          </li>

        </ul>
      </li>

       <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Nomencladores
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <!--<li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li> -->

              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Productos</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{url('listadoProductos')}}">Listado</a></li>
                  <li><a class="dropdown-item" href="{{url('/productos')}}">Nuevo</a></li> 
                </ul>
              </li>


              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle disabled" href="#">Clasificadores</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Marcas y Modelos</a></li>
                  <li><a class="dropdown-item" href="#">Categoría</a></li>
                  <li><a class="dropdown-item" href="#">Fabricantes</a></li> 
                </ul>
              </li>

            </ul>
          </li>
    </ul>
    <!--
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>  -->
  </div>
</nav>

<div>
            @yield('operaciones')
</div>



</body>

<div id="qwerty" class="modal fade bd-example-modal-lg" tabindex="10" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="cabecera"></h4>
      </div>

    </div>
  </div>
</div>

   <!-- The Mosdal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body" id="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>

<!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <input type="text" style="display: block;" name="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="modal-body2">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


</html>

<script type="text/javascript">

$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });


  return false;
});


</script>