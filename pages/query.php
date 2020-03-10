<html>
    <head>
      <?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
      <title> Coisa </title>
      <?php include_once(getcwd() . '/../templates/bootstrap_includes.php'); bootstrap($files_path);?>
      <link rel="stylesheet" href="<?= $files_path ?>/css/query.css">
      <link rel="stylesheet" href="../css/components/footer.css">
    </head>
<body class="bg-light">
  <div class="container mt-2">
    <?php include_once(getcwd() . '/../templates/header.php'); ?>
		<div class="d-flex justify-content-end align-items-baseline bg-white shadow-sm mb-2 p-1" style="margin-left:-15px; margin-right:-15px;">
			<label class="mr-1"for="sort">Sort by:</label>
			<select class="w-auto custom-select rounded-0" name="sortBy" id="sort">
				<option value="bid" selected>Highest Bid Price</option>
				<option value="date">End date</option>
			</select>
			</div>
    <div class="row">
      <!-- FILTERS -->
      <div class="col-xs-12 col-md-3 p-2 p-md-4 bg-white shadow-sm rounded-0">
        <a id="filters-toggle" class="pb-1 border-bottom" href="#filters" data-toggle="collapse" data-target="#filters">
          <div class="d-flex justify-content-between">
            <p class="m-0">Filters</p>
            <span class="fa fa-chevron-up"></span>
          </div>
        </a>
        <div id="filters" class="collapse show">
          <form id="filtersForm">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <a class="d-block mt-2 section-toggle" href="#categoriesGroup" data-toggle="collapse" data-target="#categoriesGroup">
              <div class="d-flex justify-content-between align-items-center">
                <p class="m-0">Category</p>
                <span class="fa fa-chevron-up"></span>
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

            <a class="d-block mt-2 section-toggle" href="#maxBidPriceGroup" data-toggle="collapse" data-target="#maxBidPriceGroup">
              <div class="d-flex justify-content-between align-items-center">
                <p class="m-0">Max Bid Price</p>
                <span class="fa fa-chevron-up"></span>
              </div>
            </a>
            <div id="maxBidPriceGroup" class="collapse show">
              <label for="maxBid">Maximum bid price: <p id="maxBidDisplay"></p>$</label>
              <input class="custom-range" type="range" name="maximumBid" id="maxBid" min="0" max="1000">
            </div>

            <button class="btn btn-primary mt-2" type="submit">Apply filters</button>
          </form>
        </div>
      </div>


      <!-- CONTENT DISPLAY -->
      <div class="col-xs-12 col-md-9 mt-2 mt-md-0 p-0">
        <div class="ml-md-1">
          <?php for ($i=0; $i < 10; $i++) { ?>
            <div class="card shadow-sm rounded-0 border-0 mb-1">
              <div class="row align-items-center no-gutters">
                <div class="col-xs-12 col-sm-4">
                  <img src="<?php echo $files_path . '/assets/logo.png' ?>" class="card-img" alt="logo">
                </div>
                <div class="col-xs-12 col-sm-8">
                  <div class="card-body">
                    <h5 class="card-title">Weapon</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
                </div>
                <a href="#" class="stretched-link"></a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>


    </div>
  </div>
  <?php include_once('../templates/footer.php'); ?>

  <script src="<?php echo $files_path . '/js/queryFilters.js';?>"></script>
  <script src="<?php echo $files_path . '/js/queryRangeFilter.js';?>"></script>
</body>

</html>
