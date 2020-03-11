<html>
    <?php include_once('../templates/header.php') ?>

    <body>
        <link rel="stylesheet" href="<?= $files_path ?>/css/profile.css">
        <div class="container">
            <?php include_once(getcwd() . '/../templates/navbar.php') ?>
        </div>
        <div class="container-fluid">

            <div class="row">

                <div id="profile_pic" class="col-sm-4">
                    <img src="https://picsum.photos/300/300">
                </div>
                <div id="profile_description" class="col-sm-8">
                    <div class="jumbotron">
                        <h1 class="display-4">Mário Gil</h1>
                        <div id="profile_stats" class="row">
                            <div class="col-sm-4">
                                <p>8 Users</p>
                            </div>
                            <div class="col-sm-4">
                                <p>8 Users</p>
                            </div>
                            <div class="col-sm-4">
                                <p>8 Users</p>
                            </div>
                        </div>

                        <p class="lead">I am a history fanatic and love to collect guns from different epochs.</p>
                        <p class="lead">Always looking for new and exquisite additions to my collection.</p>
                    </div>
                </div>
                
            </div>
        </div>

        <hr class="customhr">

        <ul id="profile_tabs_select" class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Current Bids</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Won Auctions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">My Auctions</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div id="profile_tabs" class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="row">
                    <?php create_current_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                    <?php create_current_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                    <?php create_current_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                </div>
            </div>
            <div class="tab-pane" id="tabs-2" role="tabpanel">
                <div class="row">
                    <?php create_winning_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                    <?php create_winning_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                    <?php create_winning_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                </div>
            </div>
            <div class="tab-pane" id="tabs-3" role="tabpanel">
                <div class="row">
                    <?php create_own_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                    <?php create_own_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                    <?php create_own_bid_card("Super cool gun", "Chuck Norris", "999") ?>
                </div>
            </div>
        </div>
        <?php include_once("../templates/footer.php"); ?>
    </body>
</html>

<?php function create_current_bid_card($title, $owner, $currentbid) { ?>
    <div class="col-12 row profile-tab-entry">
        <div class="col-3 image-tab">
            <img src="../assets/gun.jpg">
        </div>
        <div class="col-7">
            <div class="jumbotron">
                <h2><?=$title?></h2>
                <p class="lead"><?=$owner?></p>
                <p class="lead">Current bid: <span><?=$currentbid?></span>€</p>
            </div>
        </div>
        <div class="col-2">
            <a href="product.php" class="btn btn-primary btn-lg centered_vertically">Visit</a>
        </div>
    </div>
<?php } ?>

<?php function create_winning_bid_card($title, $owner, $currentbid) { ?>
    <div class="col-12 row profile-tab-entry">
        <div class="col-3 image-tab">
            <img src="../assets/gun.jpg">
        </div>
        <div class="col-6">
            <div class="jumbotron">
                <h2><?=$title?></h2>
                <p class="lead"><?=$owner?></p>
                <p class="lead">Winning bid: <span><?=$currentbid?></span>€</p>
            </div>
        </div>
        <div class="col-3">
            <div class="jumbotron">
                <p class="lead">Rating: </p>
                <span>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </span>
            </div>
        </div>
    </div>
<?php } ?>

<?php function create_own_bid_card($title, $owner, $currentbid) { ?>
    <div class="col-12 row profile-tab-entry">
        <div class="col-3 image-tab">
            <img src="../assets/gun.jpg">
        </div>
        <div class="col-7">
            <div class="jumbotron">
                <h2><?=$title?></h2>
                <p class="lead"><?=$owner?></p>
                <p class="lead">Highest bid: <span><?=$currentbid?></span>€</p>
            </div>
        </div>
        <div class="col-2">
            <a href="product.php" class="btn btn-primary btn-lg centered_vertically">Visit</a>
        </div>
    </div>
<?php } ?>