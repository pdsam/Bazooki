<html>
    <head>
      <?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
      <?php include_once('../templates/header.php');?>

      <link rel="stylesheet" href="<?= $files_path ?>/css/query.css">
	    <link rel="stylesheet" href="<?= $files_path . '/css/components/footer.css'?>">
</head>
<body class="bg-light">
  <div class="container mt-2">
    <?php include('../templates/navbar.php') ?>
      <div class="d-flex justify-content-end align-items-baseline mb-2 p-1" style="margin-left:-15px; margin-right:-15px;">
          <label class="mr-1"for="sort">Sort by:</label>
          <select class="w-auto custom-select rounded-0" name="sortBy" id="sort">
              <option value="bid" selected>Highest Bid Price</option>
              <option value="date">End date</option>
          </select>
      </div>
    <div class="row">
      <!-- FILTERS -->
      <div class="col-12 col-lg-3 p-2 p-md-4 bg-white shadow-sm rounded-0">
        <a id="filters-toggle" class="d-block d-lg-none pb-1 border-bottom" href="#filters" data-toggle="collapse" data-target="#filters">
          <div class="d-flex justify-content-between">
            <p class="m-0">Filters</p>
            <i class="fa fa-chevron-up"></i>
          </div>
        </a>
        <h3 class="d-none d-lg-block mb-4">
          Filters
        </h3>
        <div id="filters" class="collapse show">
          <form id="filtersForm">
            <a class="d-block mt-2 section-toggle mb-2 mt-3" href="#categoriesGroup" data-toggle="collapse" data-target="#categoriesGroup">
              <div class="d-flex justify-content-between align-items-center">
                <p class="m-0">Category</p>
                <i class="fa fa-chevron-up"></i>
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

            <a class="d-block mt-2 section-toggle mb-2 mt-3" href="#maxBidPriceGroup" data-toggle="collapse" data-target="#maxBidPriceGroup">
              <div class="d-flex justify-content-between align-items-center">
                <p class="m-0">Max Bid Price</p>
                <i class="fa fa-chevron-up"></i>
              </div>
            </a>
            <div id="maxBidPriceGroup" class="collapse show form-row">
              <input class="control-form col-auto" type="number" name="maxBid" id="maxBid" min="0">
            </div>

            <button class="btn btn-primary mt-2 btn-olive" type="submit">Apply filters</button>
          </form>
        </div>
      </div>


      <!-- CONTENT DISPLAY -->
      <div class="col-12 col-lg-9 mt-2 mt-md-0 p-0">
        <div class="ml-md-1">
          <?php for ($i=0; $i < 10; $i++) { ?>
            <div class="card shadow-sm rounded-0 border-0 mb-1 mt-5 mt-md-0">
              <div class="row align-items-center no-gutters">
                <div class="col-xs-12 col-sm-4">
                  <img src="<?= $files_path . '/assets/gun.jpg' ?>" class="card-img rounded-0" alt="logo">
                </div>
                <div class="col-xs-12 col-sm-8">
                  <div class="card-body">
                    <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                      <div class="">
                        <h5 class="card-title">Super cool gun</h5>
                        <h6 class="card-subtitle text-muted">Ends at: 05/07/2020 23:59:59</h6>
                      </div>
                      <div>
                        <span class="mr-1" style="font-size: 2rem">300</span>$
                      </div>
                    </div>
                    <p class="card-text">This gun is very strong. It is also very pretty.</p>
                  </div>
                </div>
                <a href="<?=$files_path . '/pages/product.php'?>" class="stretched-link"></a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>


    </div>
  </div>
  <?php include_once('../templates/footer.php'); ?>

  <script src="https://kit.fontawesome.com/07ed6a8693.js" crossorigin="anonymous"></script>
  <script src="<?php echo $files_path . '/js/collapseChevron.js';?>"></script>
</body>

</html>
