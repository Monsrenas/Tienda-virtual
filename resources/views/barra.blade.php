<div id="tope"></div>
<nav class="navbar  navbar-expand-md justify-content-between barra-Menu" >
    <div class="container-fluid">
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse dual-nav w-50 order-1 order-md-0">
          <a href="javascript:MuestraProductos('')" style="text-align: center;">
          <span style="font-size: 2em;font-weight:900; font-family: 'Times New Roman', Times, serif; color: white; text-shadow:5px 3px 7px #040452; line-height : 10px;">{{$nom1 ?? ""}}<br> 
            <span style="font-size: .54em;font-weight:100; font-family: 'Arial';">{{$nom2 ?? ""}}</span>
          </span>
          </a>
        </div>

        <div class="navbar-collapse collapse dual-nav w-25 order-0 order-md-0">
          <a href="javascript:MuestraProductos('')">
          <span ><i class="fa fa-home" style="color: white; font-size: 2em;" aria-hidden="true"></i>

          </span>
          </a>
        </div>

        <a  class="navbar-brand mx-auto d-block text-center order-0 order-md-1 w-10">@INCLUDE('filtros.selectores')</a>
        <div class="navbar-collapse collapse dual-nav w-50 order-2">
          <ul class="nav navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
               <div id="operaUser" style="display: none");> 
                 <ul class="navbar-nav mr-auto my-2 mt-lg-0 ">
                   <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dataUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Usuario
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="#">Correo</a></li>
                      <li><a class="dropdown-item" href="javascript:cerrar()">Cerrar Seción</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            <!--<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">-->
            <button  style=" color: white" class="btn btn-outline-link my-1 my-sm-0 fa fa-user-circle" type="button" data-target='#myModal' data-toggle='modal' onclick="Modal('autenticacion.login','anc','asd')"> Iniciar sesión</button>
            <!--<button class="btn btn-outline-secondary my-2 my-sm-0 fa fa-user" type="button"> Registrarte</button>-->
          </form> 
          </ul>
        </div>
    </div>
</nav>