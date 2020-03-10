<head>
	<title>Bazooki</title>
    <link rel="stylesheet" href="../css/landing_page.css">
    <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
    <script type="text/javascript" src="../js/lib/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/lib/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            //Event for pushed the video
            $('.carousel').carousel({
                pause: true,
                interval: false
            });
        });
    </script>

</head>
<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Current Auctions</h1>
            <hr class="my-4">
            <p class="lead">“Those who dare seek, shall find what they are seeking for.”</p>
            <p>Lailah Gifty Akita, Think Great: Be Great!</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Signup</a>
            </p>
        </div>

        <?php hot_deals_carousel(); ?>
        <?php flash_carousel(); ?>
        <?php main_carousel(); ?>
    </div>
</body>



<?php function make_carousel($title, $id, $items, $cardsize) { ?>
    <div class="carouselParent">
        <h3><?=$title?></h3>
        <div id="<?=$id?>" class="carousel slide row" data-ride="carousel">
            <a class="carousel-control-prev col-1" href="#<?=$id?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <div class="carousel-inner col-10">
                <?php foreach($items as $i => $curr) { ?>
                    <div class="carousel-item<?php if($i===0) echo " active"?>">
                        <div class="row">
                            <?php 
                                foreach($curr as $card) {
                                    make_carousel_card(
                                        $card['title'], 
                                        $card['img'], 
                                        $card['description'],
                                        $cardsize
                                    );
                                }
                            ?>
                        </div>                
                    </div>
                <?php } ?>
            </div>
            <a class="carousel-control-next col-1" href="#<?=$id?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
<?php } ?>

<?php function hot_deals_carousel() {
    $items = array(
        0 => array(
            array(
                "title" => "Card title 1",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 2",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 3",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 4",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 5",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 6",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            )
        ),
        1 => array(
            array(
                "title" => "Card title 7",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 8",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 9",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 10",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 11",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 12",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            )
        )        
    );

    make_carousel("🔥 HOT DEALS 🔥", "hot-deals-carousel", $items, "col-2");
?>
<?php } ?>

<?php function flash_carousel() {
    $items = array(
        0 => array(
            array(
                "title" => "Card title 1",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 2",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 3",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 4",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 5",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 6",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            )
        ),
        1 => array(
            array(
                "title" => "Card title 7",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 8",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 9",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 10",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 11",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 12",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            )
        )        
    );

    make_carousel("⚡ FLASH SALES ⚡", "flash-carousel", $items, "col-2");
?>
<?php } ?>

<?php function main_carousel() {
    $items = array(
        0 => array(
            array(
                "title" => "Card title 1",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 2",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 3",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 4",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            )
        ),
        1 => array(
            array(
                "title" => "Card title 5",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 6",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 7",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            ),
            array(
                "title" => "Card title 8",
                "img" => "../assets/logo.png",
                "description" => "Some quick example text to build on the card title and make up the bulk of the card's content."
            )
        )        
    );

    make_carousel("⚔️ CATEGORIES ⚔️", "main-carousel", $items, "col-3");
?>
<?php } ?>



<?php function make_carousel_card($title, $img, $description, $size) { ?>
    <div class="<?=$size?>">
        <div class="card carousel-card-small">
            <a href="#batata">
                <img class="card-img-top" src="<?=$img?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$title?></h5>
                    <p class="card-text"><?=$description?></p>
                </div>
            </a>
        </div>
    </div>
<?php } ?>