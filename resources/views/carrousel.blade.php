
  <div class="galeriaProductos" style="margin-bottom: 6px; margin-top: 6px; max-height: 200; min-height: 200px; overflow: hidden;">

  <div class="row">
    
  <div class="col-md-12">

  <?php 
    $colorfondo="background: transparent;";
    if (isset($_SESSION['config']['verfondo']))
                                              {
                                                 $colorfondo="background: ".$_SESSION['config']['color'] ?? "transparent;";  
                                              }
  ?>  

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
      <ol class="carousel-indicators">
     {{--   <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>  --}}
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active marco" style="padding-bottom: 2px; {{$colorfondo}}">
          <img class="img-fluid d-block m-l-none mx-auto" style=" max-height: 200px;" src="{{ asset($banner[0]) }}" alt="Imagen publicitaria principal">
        <div class="carousel-caption d-none d-md-block">

          {{--
          <h3 style="color: blue; margin: 2px;">Descuentos de locura</h3>
          <p style="color: gray;" >Estamos brindando los mejores descuentos a productos Bosch</p>
          <a href="" class="btn btn-primary">Mas informacion</a>  --}}
        </div>
        </div>
          @for ($i = 1; $i < count($banner); $i++)
            <div class="carousel-item marco" style="padding-bottom: 2px; {{$colorfondo}}">
            <img class="img-fluid d-block m-l-none mx-auto" style=" max-height: 200px;" src="{{ asset($banner[$i]) }}" alt="Screenshot 10">
            </div>
          @endfor
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  </div>
  </div>
