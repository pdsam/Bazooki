<head>
  <title>Bazooki</title>

  <?php $path = explode('/', $_SERVER['REQUEST_URI']);
  array_pop($path);
  array_pop($path);
  $files_path = join("/", $path); ?>
  <?php include_once('../templates/bootstrap_includes.php') ?>
  <link rel="stylesheet" href="<?= $files_path ?>/css/components/header.css">
  <link rel="stylesheet" href="<?= $files_path ?>/css/pallet.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
    
