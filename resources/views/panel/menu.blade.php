
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo</title>

 
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!--
  
 
  
  -->
 

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    



<link rel="stylesheet" href="./css/style.css">


</head>
<body style="background: #ECF0F1;">
<!-- partial:index.partial.html -->
<html>




<div data-component="navbar">
<nav class="navbar  fixed-top">
<div>
  <div class="right-links float-right mr-4">
    
    <div class="d-inline dropdown">
      <a class="dropdown-toggle" id="messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
        <img src="http://1.gravatar.com/avatar/47db31bd2e0b161008607d84c74305b5?s=96&d=mm&r=g">
      </a> William
      <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="messages">
        <a class="dropdown-item" href="#">Editar Datos</a>
        <a class="dropdown-item" href="#">Cerrar sesión</a>
      </div> <!-- /.dropdown-menu -->
    </div> <!-- /.dropdown -->
    
  </div> <!-- /.right-links -->
  
  </div>

</nav>
</div> <!-- END TOP NAVBAR -->



  <body><div class="area"></div>
    <nav class="main-menu" style="color: black; color: black; margin-top: 57px;">
            <ul>     
                <li>
                    <span  class='caret'>
                        <a href="#" >
                            <i class="fa fa-book fa-2x"></i>
                            <span class="fa">
                                Operaciones
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>
                        <li><a href="#">Despacho</a></li>
                        <li><a href="#">Recepción</a></li>                        
                    </ul>       
                </li>

                <li>
                    <span class="caret">
                        <a href="#" >
                            <i class="fa fa-list fa-2x"></i>
                            <span class="fa" >
                                Catálogo
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>
                        <li><a href="{{url('listaProductos')}}">Productos</a></li>
                        <li><a href="{{url('productos')}}">Nuevo Producto</a></li>
                        <li><a href="#">Fabricantes</a></li>
                        <li><a href="{{url('EdicionMarcaModelo')}}">Marcas y Modelos</a></li>
                        <li><a href="#">Categorias</a></li>                        
                    </ul>       
                </li>


                <li>
                    <span  class='caret'>
                        <a href="#" >
                            <i class="fa fa-users  fa-2x"></i>
                            <span class="fa">
                                Personas
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>
                        <li><a href="#">Personas</a></li>                    
                    </ul>       
                </li>


                <li>
                    <span  class='caret'>
                        <a href="#"  >
                            <i class="fa fa-sliders fa-2x"></i>
                            <span class="fa">
                                Parametros
                            </span>
                        </a>
                    </span>
                    <ul class='nested'>
                        <li><a href="#">Datos de la empresa</a></li>
                        <li><a href="#">Parametros de búsqueda</a></li>
                        <li><a href="#">Parametros de visualización</a></li>
                        <li><a href="#">Otros</a></li>                        
                    </ul>       
                </li>
<!--


                <li>
                    <a href="http://justinfarrow.com">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-laptop fa-2x"></i>
                        <span class="nav-text">
                            Stars Components
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-list fa-2x"></i>
                        <span class="nav-text">
                            Forms
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-folder-open fa-2x"></i>
                        <span class="nav-text">
                            Pages
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-bar-chart-o fa-2x"></i>
                        <span class="nav-text">
                            Graphs and Statistics
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-font fa-2x"></i>
                        <span class="nav-text">
                           Quotes
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                       <i class="fa fa-table fa-2x"></i>
                        <span class="nav-text">
                            Tables
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                        <i class="fa fa-map-marker fa-2x"></i>
                        <span class="nav-text">
                            Maps
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                       <i class="fa fa-info fa-2x"></i>
                        <span class="nav-text">
                            Documentation
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
                <li>
                   <a href="#">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
            </ul> -->
        </nav>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-11" style="margin: 62px;">
            @yield('operaciones')
    </div>
</div>
<!-- partial -->

<!--
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

-->


<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>

</body>
</html>

<script type="text/javascript">
     var toggler = document.getElementsByClassName("caret");
            var i;
            for (i = 0; i < toggler.length; i++) {
              toggler[i].addEventListener("click", function() { 
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
              });
            }

</script>