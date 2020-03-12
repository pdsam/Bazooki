<html>
<?php include_once('../templates/header.php') ?>

<body id="profile-page" class="bg-light">
    <link rel="stylesheet" href="<?= $files_path ?>/css/profile.css">
    <div class="container">
        <?php include_once(getcwd() . '/../templates/navbar.php') ?>
    </div>
    <div class="container">

        <div class="row">

            <div id="profile_pic" class="col-sm-4">
                <img src="https://picsum.photos/300/300">
            </div>
            <div id="profile_description" class="col-sm-8">
                <div class="jumbotron">
                    <div class="d-flex justify-content-between">
                        <h1 class="display-4">Mário Gil</h1>
                        <div class="align-self-center">
                            <button class="btn btn-lg btn-olive">Edit</button>
                        </div>
                    </div>
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
                    <p class="lead">Love Chuck Norris Super Cool guns.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <hr class="customhr">
    </div>
    <ul id="profile_tabs_select" class="nav nav-tabs container" role="tablist">
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
    <div id="profile_tabs" class="tab-content container">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="card-deck">
                <?php create_current_bid_card("Super cool gun", "This gun is very strong. It is also very pretty.", "Chuck Norris", "2000") ?>
                <?php create_current_bid_card("Super cool gun 2", "This gun is very strong. It is also very pretty.", "Chuck Norris", "100") ?>
                <?php create_current_bid_card("Super cool gun 3", "This gun is very strong. It is also very pretty.", "Chuck Norris", "12") ?>
                <?php create_current_bid_card("Super cool gun 4", "This gun is very strong. It is also very pretty.", "Chuck Norris", "58") ?>
            </div>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="card-deck">
                <?php create_winning_bid_card("Super cool gun 5", "This gun is very strong. It is also very pretty.", "Chuck Norris", "666") ?>
                <?php create_winning_bid_card("Super cool gun 6", "This gun is very strong. It is also very pretty.", "Chuck Norris", "345") ?>
                <?php create_winning_bid_card("Super cool gun 7", "This gun is very strong. It is also very pretty.", "Chuck Norris", "5") ?>
                <?php create_winning_bid_card("Super cool gun 8", "This gun is very strong. It is also very pretty.", "Chuck Norris", "68") ?>
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="card-deck">
                <?php create_own_bid_card("Super cool gun 9", "This gun is very strong. It is also very pretty.", "Mário Gil", "2008") ?>
                <?php create_own_bid_card("Super cool gun 10", "This gun is very strong. It is also very pretty.", "Mário Gil", "90000") ?>
                <?php create_own_bid_card("Super cool gun 11", "This gun is very strong. It is also very pretty.", "Mário Gil", "50") ?>
                <?php create_own_bid_card("Super cool gun 11", "This gun is very strong. It is also very pretty.", "Mário Gil", "46") ?>
            </div>
        </div>
    </div>
    <?php include_once("../templates/footer.php"); ?>
</body>

</html>

<?php function create_current_bid_card($title, $description, $owner, $currentbid)
{ ?>

    <div class="card">
        <a href="../pages/product.php">
            <img class="card-img-top" src="../assets/gun.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?></h5>
                <p class="card-text"><small class="text-muted"><?= $owner ?></small></p>
                <p class="card-text"><?= $description ?></p>
                <h5>Current bid: <?= $currentbid ?>€</h5>
            </div>
        </a>
    </div>
<?php } ?>

<?php function create_winning_bid_card($title, $description, $owner, $currentbid)
{ ?>
    <div class="card">
        <a href="../pages/product.php">
            <img class="card-img-top" src="../assets/gun.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?></h5>
                <p class="card-text"><small class="text-muted"><?= $owner ?></small></p>
                <p class="card-text"><?= $description ?></p>
                <h5>Winning bid: <?= $currentbid ?>€</h5>
                <div class="card-rating">
                    <p>Leave a rating: </p>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </a>
    </div>
<?php } ?>

<?php function create_own_bid_card($title, $description, $owner, $currentbid)
{ ?>
    <div class="card">
        <a href="../pages/product.php">
            <img class="card-img-top" src="../assets/gun.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?></h5>
                <p class="card-text"><small class="text-muted"><?= $owner ?></small></p>
                <p class="card-text"><?= $description ?></p>
                <h5>Highest bid: <?= $currentbid ?>€</h5>
            </div>
        </a>
    </div>
<?php } ?>