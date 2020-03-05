<head>
	<title>Bazooki</title>
    <link rel="stylesheet" href="css/landing_page.css">
    <link rel="stylesheet" href="css/lib/bootstrap.min.css">
    <script type="text/javascript" src="js/lib/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>

</head>

<body>
    <div class="carousel slide" id="myCarousel" data-ride="carousel" >
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="col-xs-3">
                    <a href="#">
                        <img src="http://placehold.it/500/e499e4/fff&amp;text=1" class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-xs-3">
                    <a href="#">
                        <img src="http://placehold.it/500/e477e4/fff&amp;text=2" class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-xs-3">
                    <a href="#">
                        <img src="http://placehold.it/500/e477e4/fff&amp;text=3" class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-xs-3">
                    <a href="#">
                        <img src="http://placehold.it/500/e477e4/fff&amp;text=4" class="img-responsive">
                    </a>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <script type="text/javascript">
        $('#myCarousel').carousel({
            interval: false
        })

        $('.carousel .carousel-item').each(function(){
            let next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        
            for (let i=0;i<2;i++) {
                next=next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                
                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
</body>
