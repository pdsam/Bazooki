<html>

<head>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <title> Bazooker - Create Auction </title>
    <?php include_once(getcwd() . '/../templates/header.php') ?>
    <link rel="stylesheet" href="<?= $files_path ?>/css/product.css">
    <link rel="stylesheet" href="<?= $files_path ?>/css/components/footer.css">
</head>

<body class="bg-light">
    <div class="container mt-2">
        <?php include_once(getcwd() . '/../templates/navbar.php') ?>
        <div>
			<form>
				<div class="form-group mt-4 ml-4 mr-4">
					<input type="email" class="form-control form-control-lg" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title">
				</div>

				<div class="form-group mt-4 ml-4 mr-4">
					<input class="form-control form-control-sm" rows="5" id="description" placeholder="Short description"></textarea>
				</div>
				
				<div class="form-group mt-4 ml-4 mr-4">
					<textarea class="form-control" rows="5" id="description" placeholder="Description"></textarea>
				</div>
				
				<div class="card ml-4 mr-4">
					<div class="card-body">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							<label class="form-check-label" for="defaultCheck1">
							I confirm I have a certificate and it's genuine.
							</label>
						</div>
						<input type="file" class="form-control-file" id="exampleFormControlFile1">
					</div>
				</div>

				<div class="form-group mt-4 ml-4 mr-4">
					<input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title">
				</div>

			<div>
			<button type="submit" class="btn btn-primary ml-4">Submit</button>
			</div>
			</form>
        </div>

        <?php include_once('../templates/footer.php'); ?>
    </div>
</body>
