<html>
    <?php include_once("../templates/header.php"); ?>

    <body class="bg-light">
        <link rel="stylesheet" href="<?= $files_path . '/css/landing_page.css';?>">

        <script type="text/javascript" defer>
            $(document).ready(function(){
                //Event for pushed the video
                $('.carousel').carousel({
                    pause: true,
                    interval: false
                });
            });
        </script>        

        <div class="container">
            <?php include_once("../templates/navbar.php"); ?>
        </div>

        <div id="landing_page" class="container">

            <div class="jumbotron">
                <h1 class="display-4">Current Auctions <i class="fas fa-gavel"></i></h1>
                <hr class="my-4">
                <p class="lead">“Those who dare seek, shall find what they are seeking for.”</p>
                <p>- Lailah Gifty Akita, Think Great: Be Great!</p>
            </div>

            <?php hot_deals_carousel(); ?>
            <?php flash_carousel(); ?>
            <?php main_carousel(); ?>
        </div>
            
        <?php include_once("../templates/footer.php"); ?>
    </body>
</html>


<?php function make_carousel($title, $id, $items, $cardsize) { ?>
    <div class="carouselParent">
        <h3><?=$title?></h3>
        <div id="<?=$id?>" class="carousel slide add-margin" data-ride="carousel">
            
            <div class="carousel-inner">
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
        </div>
        <div class="row carousel-controls">
            <a class="col-lg-1 col-sm-6 btn btn-olive btn-lg" href="#<?=$id?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="col-lg-1 col-sm-6 btn btn-olive btn-lg" href="#<?=$id?>" role="button" data-slide="next">
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
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            )
        ),
        1 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            )
        )        
    );

    make_carousel(
        "<i class='fas fa-fire' style='color:red'></i> HOT DEALS <i class='fas fa-fire' style='color:red'></i>", 
        "hot-deals-carousel", 
        $items, 
        "col-md-3"
    );
?>
<?php } ?>

<?php function flash_carousel() {
    $items = array(
        0 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            )
        ),
        1 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun0",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            )
        )        
    );

    make_carousel(
        "<i class='fas fa-bolt' style='color:#caa900'></i> FLASH SALES <i class='fas fa-bolt' style='color:#caa900'></i>", 
        "flash-carousel", 
        $items, 
        "col-md-3"
    );
?>
<?php } ?>

<?php function main_carousel() {
    $items = array(
        0 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            )
        ),
        1 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                "description" => "This gun is very strong. It is also very pretty."
            )
        )        
    );

    make_carousel(
        "<i class='fas fa-search' style='color:var(--highlight-purple)'></i> CATEGORIES <i class='fas fa-search' style='color:var(--highlight-purple)'></i>", 
        "main-carousel", 
        $items, 
        "col-md-4"
    );
?>
<?php } ?>



<?php function make_carousel_card($title, $img, $description, $size) { ?>
    <div class="<?=$size?>">
        <div class="card carousel-card-small">
            <a href="product.php">
                <img class="card-img-top" src="<?=$img?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$title?></h5>
                    <p class="card-text"><?=$description?></p>
                </div>
            </a>
        </div>
    </div>
<?php } ?>
