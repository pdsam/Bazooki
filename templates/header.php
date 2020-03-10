<head>
  <title>Bazooki</title>
  
  <?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
  <?php include_once('../templates/bootstrap_includes.php') ?>
  <link rel="stylesheet" href="<?= $files_path . '/css/components/header.css';?>">
</head>
    
