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
    <link href="<?= $files_parh ?>/css/dashboard.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php include('../templates/navbar.php')?>
        <div class="row">
            <nav class="col-12 col-lg-2 bg-light sidebar">
                <ul class="nav flex-column" role="tablist">
                    <li class="nav-item py-2">
                        <a class="nav-link active" href="#sales" data-toggle="tab" role="tab">
                            <i class="fas fa-home"></i>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item py-2">
                        <a class="nav-link" href="#auctions" data-toggle="tab" role="tab">
                            <i class="fa fa-money-bill-wave"></i>
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

            <main class="col-12 col-lg-10 ml-sm-auto px-0 px-lg-4 tab-content">
                <div id="sales" class="tab-pane active" role="tabpanel">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                This week
                            </button>
                        </div>
                    </div>

                    <h2>Sales</h2>

                    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                    <th>Header</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1,001</td>
                                    <td>Lorem</td>
                                    <td>ipsum</td>
                                    <td>dolor</td>
                                    <td>sit</td>
                                </tr>
                                <tr>
                                    <td>1,002</td>
                                    <td>amet</td>
                                    <td>consectetur</td>
                                    <td>adipiscing</td>
                                    <td>elit</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>Integer</td>
                                    <td>nec</td>
                                    <td>odio</td>
                                    <td>Praesent</td>
                                </tr>
                                <tr>
                                    <td>1,003</td>
                                    <td>libero</td>
                                    <td>Sed</td>
                                    <td>cursus</td>
                                    <td>ante</td>
                                </tr>
                                <tr>
                                    <td>1,004</td>
                                    <td>dapibus</td>
                                    <td>diam</td>
                                    <td>Sed</td>
                                    <td>nisi</td>
                                </tr>
                                <tr>
                                    <td>1,005</td>
                                    <td>Nulla</td>
                                    <td>quis</td>
                                    <td>sem</td>
                                    <td>at</td>
                                </tr>
                                <tr>
                                    <td>1,006</td>
                                    <td>nibh</td>
                                    <td>elementum</td>
                                    <td>imperdiet</td>
                                    <td>Duis</td>
                                </tr>
                                <tr>
                                    <td>1,007</td>
                                    <td>sagittis</td>
                                    <td>ipsum</td>
                                    <td>Praesent</td>
                                    <td>mauris</td>
                                </tr>
                                <tr>
                                    <td>1,008</td>
                                    <td>Fusce</td>
                                    <td>nec</td>
                                    <td>tellus</td>
                                    <td>sed</td>
                                </tr>
                                <tr>
                                    <td>1,009</td>
                                    <td>augue</td>
                                    <td>semper</td>
                                    <td>porta</td>
                                    <td>Mauris</td>
                                </tr>
                                <tr>
                                    <td>1,010</td>
                                    <td>massa</td>
                                    <td>Vestibulum</td>
                                    <td>lacinia</td>
                                    <td>arcu</td>
                                </tr>
                                <tr>
                                    <td>1,011</td>
                                    <td>eget</td>
                                    <td>nulla</td>
                                    <td>Class</td>
                                    <td>aptent</td>
                                </tr>
                                <tr>
                                    <td>1,012</td>
                                    <td>taciti</td>
                                    <td>sociosqu</td>
                                    <td>ad</td>
                                    <td>litora</td>
                                </tr>
                                <tr>
                                    <td>1,013</td>
                                    <td>torquent</td>
                                    <td>per</td>
                                    <td>conubia</td>
                                    <td>nostra</td>
                                </tr>
                                <tr>
                                    <td>1,014</td>
                                    <td>per</td>
                                    <td>inceptos</td>
                                    <td>himenaeos</td>
                                    <td>Curabitur</td>
                                </tr>
                                <tr>
                                    <td>1,015</td>
                                    <td>sodales</td>
                                    <td>ligula</td>
                                    <td>in</td>
                                    <td>libero</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="auctions" class="tab-pane" role="tabpanel">
                    <?php for ($i=0; $i < 10; $i++) { ?>
                        <div class="card shadow-sm rounded-0 border mt-3 mt-lg-1">
                            <div class="row align-items-center no-gutters">
                                <div class="col-12 col-sm-4">
                                    <img src="<?php echo $files_path . '/assets/logo.png' ?>" class="card-img" alt="logo">
                                </div>
                                <div class="col-12 col-sm-8">
                                    <div class="card-body">
                                        <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                                            <div class="">
                                                <h5 class="card-title">Weapon</h5>
                                                <h6 class="card-subtitle text-muted">Ends at: dd/mm/yyyy hh:mm:ss</h6>
                                            </div>
                                            <div>
                                                <span class="mr-1" style="font-size: 2rem">300</span>$
                                            </div>
                                        </div>
                                        <p class="card-text">Big descritpion thingy</p>
                                    </div>
                                </div>
                                <a href="#" class="stretched-link"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="certifications" class="tab-pane" role="tabpanel">
                    <?php for ($i=0; $i < 10; $i++) { ?>
                        <div class="shadow-sm border mt-3 mt-lg-1">
                            <div class="card rounded-0 border-0">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-12 col-sm-4">
                                        <img src="<?php echo $files_path . '/assets/logo.png' ?>" class="card-img" alt="logo">
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Weapon</h5>
                                            <h6 class="card-subtitle text-muted">Owner</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="certification<?= $i ?>" class="collapse p-3">
                                <div>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa omnis dolores, modi vitae vero corporis odio cumque. Cumque ullam velit exercitationem tenetur molestias sint natus reiciendis magnam, libero illum nihil!
                                    Sed molestias ipsum suscipit ducimus natus ex libero necessitatibus ea voluptatibus, sunt adipisci velit doloribus, ipsam commodi itaque. Ab fugiat quos odit, sapiente accusamus dignissimos a omnis voluptas. Distinctio, blanditiis?
                                    Laboriosam, dicta. Hic voluptatibus, nulla perspiciatis accusamus nobis quae ipsam in similique sunt, obcaecati consectetur asperiores magnam sed voluptas error nemo, quibusdam modi officia. Repellat corporis architecto deleniti amet hic.
                                    Modi aspernatur eum voluptates est placeat dicta magni tempora omnis, laudantium nam, maiores dolorum optio neque quaerat debitis. Perferendis quis aliquid perspiciatis ducimus, veniam tempora ipsa sunt doloremque eaque porro!
                                    Sit nostrum tenetur reprehenderit inventore? Hic facere perspiciatis dignissimos tempora aperiam cumque adipisci tenetur, totam, atque repellat assumenda nam aut doloremque quos error voluptatem distinctio, numquam quisquam ex consequatur. Qui?
                                    Voluptates sed iste nostrum ad facilis dolore modi. Commodi eligendi fuga magni atque amet consequatur accusantium. Possimus adipisci sequi magni ratione? Repudiandae eos non ex, expedita sequi ratione itaque fugit.
                                    Dolorem tempora minima dolorum ratione illo iste perferendis neque! Eligendi placeat quaerat iusto autem odit harum suscipit quis quod. Iste exercitationem dignissimos ullam eaque veritatis voluptas. Dolor accusantium dolores dignissimos?
                                    Itaque sed vitae nulla explicabo id quos nostrum at hic? Culpa nam molestiae sequi voluptatum labore! Tempore veritatis deserunt voluptatum temporibus, nisi repellat fugit quidem. Excepturi ipsam obcaecati iusto illo.
                                    Veritatis necessitatibus mollitia et, debitis, quae error explicabo rem aperiam, ipsum cupiditate doloribus ut aut neque possimus perspiciatis. Magni nisi iste sapiente temporibus similique! Porro magnam unde ipsam nesciunt asperiores.
                                    Ratione dignissimos delectus voluptatibus, provident consequuntur, officiis placeat hic et beatae, culpa praesentium! Qui distinctio minus iusto aliquid dicta, cupiditate expedita rem consequuntur saepe autem magnam blanditiis veniam aperiam laborum?
                                </div>
                                <div class="my-3 mx-2">
                                    Certification documents:
                                    <ul>
                                        <li>
                                            <a href="#">document1</a>
                                        </li>
                                        <li>
                                            <a href="#">document2</a>
                                        </li>
                                        <li>
                                            <a href="#">document3</a>
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
    <script src="<?= $files_parh ?>/js/dashboard.js"></script>
</body>

</html>