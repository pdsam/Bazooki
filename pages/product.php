<html>

<head>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <title> Coisa </title>
    <?php include_once(getcwd() . '/../templates/bootstrap_includes.php');
    bootstrap($files_path); ?>
    <link rel="stylesheet" href="<?= $files_path ?>/css/product.css">
    <link rel="stylesheet" href="../css/components/footer.css">
</head>

<body>

    <body class="bg-light">
        <div class="container mt-2">
            <?php include_once(getcwd() . '/../templates/header.php'); ?>
            <div class="row">
                <div class="col">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="../assets/chart.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../assets/chart.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../assets/chart.png" alt="Third slide">
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
                <div class=col>
                    <div>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in libero fringilla, pellentesque libero eu, tincidunt velit. Duis odio leo, ultricies tincidunt finibus in, condimentum at purus. Fusce urna dui, fringilla in convallis ut, consequat id risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam aliquam urna et arcu maximus, condimentum hendrerit sem accumsan. Aliquam eleifend orci vitae pharetra venenatis. Suspendisse sagittis dui lacus, sit amet dignissim urna pharetra ac. Sed vestibulum dignissim leo, at faucibus mauris.

</p>
                    </div>

                    <div class="form-inline mx-sm-3 mb-2">
                        <label for="bidAmount" class="sr-only">Bid</label>
                        <input type="number" class="form-control" id="bidAmount" placeholder="MIN-BID-VALUE">
                        <button type="submit" class="btn btn-primary ">Bid</button>
                    </div>
                </div>
            </div>



            <div>
                <img src="../assets/chart.png">
            </div>


            <?php include_once('../templates/footer.php'); ?>
        </div>
    </body>

</body>