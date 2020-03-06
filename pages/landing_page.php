<head>
	<title>Bazooki</title>
    <link rel="stylesheet" href="css/landing_page.css">
    <link rel="stylesheet" href="css/lib/bootstrap.min.css">
    <script type="text/javascript" src="js/lib/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/lib/bootstrap.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
            <div class="carousel-inner row w-10 mxauto" role="listbox">
                <div class="carousel-item col-md-4 active">
                    <img class="img-fluid mx-auto d-bloc" src="/assets/logo.png" alt="slide 1">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 2">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 3">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 4">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 5">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 6">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 7">
                </div>
                <div class="carousel-item col-md-4">
                    <img class="img-fluid mx-auto d-block" src="/assets/logo.png" alt="slide 7">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <i class="fa fa-chevron-left fa-lg text-muted"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                <i class="fa fa-chevron-right fa-lg text-muted"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
        
    </div>
    <script type="text/javascript">
        $('#carouselExample').on('slide.bs.carousel', function (e) {

            /*

            CC 2.0 License Iatek LLC 2018
            Attribution required

            */

            let $e = $(e.relatedTarget);

            let idx = $e.index();

            let itemsPerSlide = 8;
            let totalItems = $('.carousel-item').length;

            if (idx >= totalItems-(itemsPerSlide-1)) {
                let it = itemsPerSlide - (totalItems - idx);
                for (let i=0; i<it; i++) {
                    // append slides to end
                    if (e.direction=="left") {
                        $('.carousel-item').eq(i).appendTo('.carousel-inner');
                    }
                    else {
                        $('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });
    </script>
</body>
