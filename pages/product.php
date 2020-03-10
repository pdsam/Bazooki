<html>

<head>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <title> That one gun </title>
    <?php include_once(getcwd() . '/../templates/header.php') ?>
    <link rel="stylesheet" href="<?= $files_path ?>/css/product.css">
    <link rel="stylesheet" href="../css/components/footer.css">
</head>



<body class="bg-light">
    <div class="container mt-2">
        <?php include_once(getcwd() . '/../templates/header.php'); ?>
        <div class="row" id="product-details">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="http://lorempixel.com/400/400" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="http://lorempixel.com/400/400" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="http://lorempixel.com/400/400   " alt="Third slide">
                                </div>
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
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center card-c-element card-body">M1 GARAND</h3>
                        <div id="price" class="card-c-element card-body">
                            <h3 class="card-title text-center" id="price">$100</h3>
                        </div>
                        <div id="bid-button" class="text-center card-body">
                            <input type="number" class="add-margin text-center" value="110"></input>
                            <button type="button" class="btn btn-block btn-primary btn-lg center-block">Bid Now</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Documentation</h3>
                <p class="card-text"></p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Price variation</h3>
                <img src="../assets/chart.png">
            </div>

        </div>


        <?php include_once('../templates/footer.php'); ?>
    </div>
</body>

</body>