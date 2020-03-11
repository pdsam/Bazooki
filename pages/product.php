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
        <?php include_once(getcwd() . '/../templates/navbar.php') ?>
        <div class="row" id="product-details">
            <div class="col-md-7">
                <div class="card">
                    <div class="shadow-lg">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 image-responsive" src="https://picsum.photos/445/425" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 image-responsive" src="https://picsum.photos/445/425.jpg" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 image-responsive" src="https://picsum.photos/445/425/" alt="Third slide">
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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center card-c-element card-body">GSG FIREFLY .22LR PISTOL THREADED</h3>
                        <div id="price" class="card-c-element card-body">
                            <h3 class="card-title text-center" id="price">€100</h3>
                            <h3 class="card-title text-center">22d 10h</h3>
                        </div>
                        <div class="card-body d-inline-flex justify-content-between w-100 align-items-center">
                            
                                <input type="number" class=" text-center " value="110"></input>
                                <div class="">
                                <button type="button" class="btn btn-block btn-primary btn-lg center-block " id="bid-button">Bid Now</button>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Details </h3>
                <p class="card-text">The Draco NAK9 pistol is chambered in the cost-effective, low-recoil 9mm cartridge while capturing the look and feel of the AK-47 platform. The magazine well allows for compatibility with GLOCK 17 and GLOCK 19 magazines making it the perfect companion for your EDC 9mm handgun. The NAK9 comes equipped with a top-mounted Picatinny optics rail for mounting modern optics, a rear sling mount, one 33-round magazine and is compatible with aftermarket AKM handguards. The blowback operated design results in a platform as reliable as an AK, but in a smaller package with minimal recoil. Its lightweight and 11.14” barrel make the Draco NAK9 an excellent choice for your next truck gun, CQC or a fun day at the range.</div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Price variation</h3>
                <img src="../assets/chart.png" class="img-responsive" width="100%" />
            </div>

        </div>


        <?php include_once('../templates/footer.php'); ?>
    </div>
</body>

</body>