<html>

<head>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <title>Bazooki</title>
    <?php include_once(getcwd() . '/../templates/bootstrap_includes.php');
    bootstrap($files_path); ?>
    <link rel="stylesheet" href="<?= $files_path ?>/css/product.css">
    <link rel="stylesheet" href="../css/components/footer.css">
    <link rel="stylesheet" href="../css/components/header.css">
    <link rel="stylesheet" href="../css/faq.css">

</head>

<body class="bg-light">
    <div class="container mt-2">

        <?php include_once(getcwd() . '/../templates/header.php'); ?>

        <div class="container py-3">
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="accordion" id="faqExample">
                <div class="card">
                    <div class="card-header p-2" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Q: Who are we?
                            </button>
                          </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet, tortor eget dignissim pulvinar, elit urna pulvinar turpis, ut feugiat quam est luctus ex.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header p-2" id="headingTwo">
                        <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Q: What is Bootstrap 4?
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                        <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet, tortor eget dignissim pulvinar, elit urna pulvinar turpis, ut feugiat quam est luctus ex.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header p-2" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Q. What is another question?
                            </button>
                          </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                        <div class="card-body">
                            The answer to the question can go here.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header p-2" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Q. What is the next question?
                            </button>
                          </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                        <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet, tortor eget dignissim pulvinar, elit urna pulvinar turpis, ut feugiat quam est luctus ex.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--/row-->
</div>
<!--container-->
        <?php include_once(getcwd() . '/../templates/footer.php'); ?>
    </div>


</body>


</html>