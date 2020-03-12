<html>

<head>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <?php include_once('../templates/header.php'); ?>

    <link rel="stylesheet" href="<?= $files_path ?>/css/query.css">
    <link rel="stylesheet" href="<?= $files_path . '/css/components/footer.css' ?>">
</head>

<body class="bg-light">
    <div class="container">
        <?php include('../templates/navbar.php') ?>
        <div class="px-2">
            <div class="d-flex-column d-md-flex align-items-center mb-2 md-md-0">
                <h1 class="">
                    Payment methods
                </h1>
                <a class="ml-0 ml-md-4" href="#">
                    <i class="fa fa-plus p-0"></i>
                    Add
                </a>
            </div>

            <div class="row">
                <?php for($i; $i < 4; $i++) { ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card mb-4 mx-auto" style="max-width: 16rem">
                            <img src="<?= $files_path ?>/assets/master-card-logo.jpg" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">**** **** **** abcd</h5>
                                <p class="card-text">Master Card</p>
                                <a href="#" class="btn btn-primary">Remove</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include_once('../templates/footer.php'); ?>

    <script src="https://kit.fontawesome.com/07ed6a8693.js" crossorigin="anonymous"></script>
    <script src="<?php echo $files_path . '/js/queryFilters.js'; ?>"></script>
    <script src="<?php echo $files_path . '/js/queryRangeFilter.js'; ?>"></script>
</body>

</html>