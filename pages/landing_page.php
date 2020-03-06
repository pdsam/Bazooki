<head>
	<title>Bazooki</title>
    <link rel="stylesheet" href="../css/landing_page.css">
    <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
    <script type="text/javascript" src="../js/lib/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/lib/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            //Event for pushed the video
            $('#myCarousel').carousel({
                pause: true,
                interval: false
            });
        });
    </script>

</head>
<body>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row"> 
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../assets/logo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../assets/logo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../assets/logo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="../assets/logo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="carousel-item">
                <div class="row"> 
                    <div class="col-4">
                        <img class="d-block w-100" src="../assets/logo.png" alt="First slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="../assets/logo.png" alt="First slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="../assets/logo.png" alt="First slide">
                    </div>
                </div>  
            </div>
            <div class="carousel-item">
                <div class="row"> 
                    <div class="col-4">
                        <img class="d-block w-100" src="../assets/logo.png" alt="First slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="../assets/logo.png" alt="First slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="../assets/logo.png" alt="First slide">
                    </div>
                </div>  
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
</body>
