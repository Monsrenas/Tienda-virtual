<style type="text/css">
  .navbar-custom {
    background-color: #ff5500;
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

<nav class="navbar navbar-expand-lg bg-primary navbar-custom">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
 
    </ul>



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
      <button  style="margin-right: 4px; color: white" class="btn btn-outline-success my-2 my-sm-0 fa fa-user-circle" type="button" data-target='#myModal' data-toggle='modal' onclick="Modal('autenticacion.login','anc','asd')"> Iniciar sesión</button>
      <!--<button class="btn btn-outline-secondary my-2 my-sm-0 fa fa-user" type="button"> Registrarte</button>-->
    </form>     

        
  </div>
</nav>

