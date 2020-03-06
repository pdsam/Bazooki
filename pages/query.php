<html>
    <head>
	<?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
    <title> Coisa  </title>
    <?php include_once(getcwd() . '/../templates/bootstrap_includes.php'); bootstrap($files_path);?>




    </head>
    <body>
    <?php include_once(getcwd() . '/../templates/header.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-3 p-1 bg-light">
        <form>
          <label for="firearmCat">Firearms</label>
          <input type="checkbox" name="category" id="firearmCat" value="firearms">
          <label for="swordsCat">Swords</label>
          <input type="checkbox" name="category" id="swordsCat" value="swords">
          <label for="bowsCat">Bows/Crossbows</label>
          <input type="checkbox" name="category" id="bowsCat" value="bows">
        </form>
      </div>

      <div class="col-9 p-1 bg-light">
        <?php for ($i=0; $i < 10; $i++) { ?>
          <div class="card shadow-sm rounded-0 border-0 m-1">
            <div class="row no-gutters">
              <div class="col-md-4">
	      <img src="<?php echo $files_path . '/assets/logo.png' ?>" class="card-img" alt="logo">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
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
    <?php include_once(getcwd() . '/../templates/footer.php');?>
    </body>
</html>
