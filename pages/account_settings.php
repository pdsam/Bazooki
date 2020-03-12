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
            <div class="mb-5">
                <h2>Change Password</h2>
                <form action="#">
                    <div class="form-group">
                        <label for="oldPass">Old password</label>
                        <input class="form-control" type="password" name="oldPass" id="oldPass">
                    </div>

                    <div class="form-group">
                        <label for="newPass">New password</label>
                        <input class="form-control" type="password" name="newPass" id="newPass">
                    </div>

                    <div class="form-group">
                        <label for="confirmPass">Confirm new password</label>
                        <input class="form-control" type="password" name="confirmPass" id="confirmPass">
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
            <div class="mb-5">
                <div class="d-flex-column d-md-flex align-items-center mb-2 md-md-0">
                    <h2>
                        Payment methods
                    </h2>
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
                                    <a href="#" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="text-danger">Danger zone</h5>
                <p class="text-muted">The things in this area are very <span class="font-weight-bold">D A N G E R O U S</span></p>
                <div id="danger-zone-area" class="collapse mb-3 border border-danger">
                    <div class="d-flex justify-content-between border p-3">
                        <div>
                            <strong>
                                Delete account
                            </strong>
                            <p class="m-0">Once you delete your account, you can't get it back.</p>
                        </div>
                        <button class="btn btn-danger">Delete Account</button>
                    </div>
                </div>
                <button class="btn btn-outline-danger" data-toggle="collapse" data-target="#danger-zone-area">Show</button>
            </div>
        </div>
    </div>
    <?php include_once('../templates/footer.php'); ?>

    <script src="https://kit.fontawesome.com/07ed6a8693.js" crossorigin="anonymous"></script>
    <script src="<?php echo $files_path . '/js/queryFilters.js'; ?>"></script>
    <script src="<?php echo $files_path . '/js/queryRangeFilter.js'; ?>"></script>
</body>

</html>
