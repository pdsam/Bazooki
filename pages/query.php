<html>
    <head>
      <?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
      <title> Coisa </title>
      <?php include_once(getcwd() . '/../templates/bootstrap_includes.php'); bootstrap($files_path);?>
    </head>
<body class="bg-light">
  <?php include_once(getcwd() . '/../templates/header.php'); ?>

  <div class="container mt-2">
    <div class="row">
      <div class="col-3 p-4 bg-white shadow-sm rounded-0">
        <form id="filtersForm">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <a class="d-block mt-2 section-toggle" href="#categoryGroup" data-toggle="collapse" data-target="#categoriesGroup">
            <div class="d-flex justify-content-between">
              <p>Category</p>
              <span class="catIcon fas fa-chevron-up"></span>
            </div>
          </a>
          <div id="categoriesGroup" class="collapse show">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input m-0" type="checkbox" name="category" id="firearmCat" value="firearms">
              <label class="custom-control-label" for="firearmCat">Firearms</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" name="category" id="swordsCat" value="swords">
              <label class="custom-control-label" for="swordsCat">Swords</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" name="category" id="bowsCat" value="bows">
              <label class="custom-control-label" for="bowsCat">Bows/Crossbows</label>
            </div>
          </div>

          <a class="d-block mt-2 section-toggle" href="#categoryGroup" data-toggle="collapse" data-target="#maxBidPriceGroup">
            <div class="d-flex justify-content-between">
              <p>Max Bid Price</p>
              <span class="fas fa-chevron-up"></span>
            </div>
          </a>
          <div id="maxBidPriceGroup" class="collapse show">
            <label for="maxBid">Maximum bid price: <p id="maxBidDisplay"></p>$</label>
            <input class="custom-range" type="range" name="maximumBid" id="maxBid" min="0" max="1000">
          </div>

          <button class="btn btn-primary mt-2" type="submit">Apply filters</button>
        </form>
      </div>

      <div class="col-9 p-0 bg-light">
        <div class="ml-1">
          <?php for ($i=0; $i < 10; $i++) { ?>
            <div class="card shadow-sm rounded-0 border-0 mb-1">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?php echo $files_path . '/assets/logo.png' ?>" class="card-img" alt="logo">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
                  <a href="#" class="stretched-link"></a>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../templates/footer.php'); ?>

  <script src="/js/queryFilters.js"></script>
  <script src="/js/queryRangeFilter.js"></script>
</body>

</html>