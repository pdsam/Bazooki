<!doctype html>
<html lang="en">

<head>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include('../templates/header.php') ?>

    <!-- Custom styles for this template -->
    <link href="<?= $files_path ?>/css/dashboard.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <?php include('../templates/navbar.php')?>
        <div class="row">
            <nav class="col-12 col-lg-3 bg-light sidebar">
                <ul class="nav flex-column" role="tablist">
                    <li class="nav-item py-2">
                        <a class="nav-link active" href="#sales" data-toggle="tab" role="tab">
                            <i class="fa fa-money-bill-wave"></i>
                            Sales <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a class="nav-link" href="#auctions" data-toggle="tab" role="tab">
                            <i class="fa fa-gavel"></i>
                            Auctions
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a class="nav-link" href="#certifications" data-toggle="tab" role="tab">
                            <i class="fa fa-user-check"></i>
                            Certifications
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a class="nav-link disabled text-muted" href="#">
                            <i class="fa fa-users"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a class="nav-link disabled text-muted" href="#">
                            <i class="fa fa-shield-alt"></i>
                            Moderators
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-12 col-lg-9 tab-content">
                <!-- <h1 class="h2 border-bottom">Dashboard</h1> -->
                <div id="sales" class="tab-pane active" role="tabpanel">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h2>Sales</h2>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                This week
                            </button>
                        </div>
                    </div>

                    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Sunday </td>
                                    <td>15339</td>
                                </tr>
                                <tr>
                                    <td> Monday </td>
                                    <td>21345</td>
                                </tr>
                                <tr>
                                    <td> Tuesday </td>
                                    <td>18483</td>
                                </tr>
                                <tr>
                                    <td> Wednesday </td>
                                    <td>24003</td>
                                </tr>
                                <tr>
                                    <td> Thursday </td>
                                    <td>23489</td>
                                </tr>
                                <tr>
                                    <td> Friday </td>
                                    <td>24092</td>
                                </tr>
                                <tr>
                                    <td> Saturday </td>
                                    <td>12034</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="auctions" class="tab-pane" role="tabpanel">
                    <h2>Auctions</h2>
                    <?php for ($i=0; $i < 10; $i++) { ?>
                        <div class="card shadow-sm rounded-0 border mt-3 mt-lg-1">
                            <div class="row align-items-center no-gutters">
                                <div class="col-12 col-sm-4">
                                    <img src="<?php echo $files_path . '/assets/gun.jpg' ?>" class="card-img rounded-0" alt="logo">
                                </div>
                                <div class="col-12 col-sm-8">
                                    <div class="card-body">
                                        <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                                            <div class="">
                                                <h5 class="card-title">Super cool gun</h5>
                                                <h6 class="card-subtitle text-muted">Ends at: 05/07/2020 23:59:59</h6>
                                            </div>
                                            <div>
                                                <span class="mr-1" style="font-size: 2rem">300</span>$
                                            </div>
                                        </div>
                                        <p class="card-text">This gun is very strong. It is also very pretty.</p>
                                        <div>
                                            <button class="btn btn-large btn-primary">Freeze</button>
                                            <button class="btn btn-large btn-danger">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="certifications" class="tab-pane" role="tabpanel">
                    <h2>Certifications</h2>
                    <?php for ($i=0; $i < 10; $i++) { ?>
                        <div class="shadow-sm border mt-3 mt-lg-1">
                            <div class="card rounded-0 border-0">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-12 col-sm-4">
                                        <img src="<?php echo $files_path . '/assets/gun.jpg' ?>" class="card-img rounded-0" alt="logo">
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Super cool gun</h5>
                                            <h6 class="card-subtitle text-muted">Owner</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="certification<?= $i ?>" class="collapse p-3">
                                <div>
                                    This is a genuine revolver, I got it from my grandfather. It dates back to WWII.
                                </div>
                                <div class="my-3 mx-2">
                                    Certification documents:
                                    <ul>
                                        <li>
                                            <a href="<?= $files_path ?>/assets/cert1.pdf">document1</a>
                                        </li>
                                        <li>
                                            <a href="<?= $files_path ?>/assets/cert2.pdf">document2</a>
                                        </li>
                                        <li>
                                            <a href="<?= $files_path ?>/assets/cert3.pdf">document3</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-success">
                                        Accept
                                    </button>
                                    <button class="btn btn-danger">
                                        Reject
                                    </button>
                                </div>
                            </div>
                                <a href="#certification<?= $i ?>" class="cert-toggle justify-content-center d-flex py-3 text-muted bg-light" data-toggle="collapse">
                                    <i class="fa fa-chevron-down"></i>
                                </a>
                        </div>
                    <?php } ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../templates/footer.php') ?>
    <script src="https://kit.fontawesome.com/07ed6a8693.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="<?= $files_path ?>/js/dashboard.js"></script>
</body>

</html>
