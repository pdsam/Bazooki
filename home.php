<?php
	
function body(){

	echo '
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner" style="height: 400px; margin: auto;">
	    <div class="carousel-item active">
	      <img class="d-block w-100" src="https://sigarra.up.pt/feup/pt/fotografias_service.foto?pct_cod=201705591" alt="First slide">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="https://sigarra.up.pt/feup/pt/fotografias_service.foto?pct_cod=201705723" alt="Second slide">
	    </div>
	    <div class="carousel-item">
	      <img class="d-block w-100" src="https://sigarra.up.pt/feup/pt/fotografias_service.foto?pct_cod=201706956" alt="Third slide">
	    </div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
';

}


include 'base.php';
?>
