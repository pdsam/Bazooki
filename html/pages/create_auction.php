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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.1/image-picker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.1/image-picker.min.js"></script>
	<script>
	$(function () {

    // INITIALIZE DATEPICKER PLUGIN
    $('.datepicker-start').datepicker({
        clearbtn: true,
        format: "dd/mm/yyyy"
    });

    $('.datepicker-end').datepicker({
        clearbtn: true,
        format: "dd/mm/yyyy"
    });

    // FOR DEMO PURPOSE
    $('#reservationDate').on('change', function () {
        var pickedDate = $('input').val();
        $('#pickedDate').html(pickedDate);
    });
});
	$(function(){$("select").imagepicker();});
	</script>
	
	<style>
		.datepicker td, .datepicker th {
    width: 2.5rem;
    height: 2.5rem;
    font-size: 0.85rem;
}

	</style>

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
			
				<div class="card mt-4 ml-4 mr-4">
					<div class="card-body">
						<div class="card-title">
							<h3>
							Pictures
							</h3>
						</div>
						<select class="image-picker show-html">
						<div class="form-row">
						<?php for($i = 0;$i<4; $i++){?>
						<div class="col-3">
						<option
  data-img-src='https://picsum.photos/100/100'
  value='<?= $i?>'
>
						</div>
						<?php }?>
						</div>
						</select>
						<input type="file" class="form-control-file" id="exampleFormControlFile1" multiple>
						
					</div>
				</div>

				<div class="card mt-4 ml-4 mr-4">
					<div class="card-body">
						<div class="card-title">
							<h3>Duration</h3>
						</div>
						
						<div class="row justify-content-between">
							<div class="col-md-3 datepicker-start date input-group p-0 ml-3 mr-3">
								<input type="text" placeholder="Start date" class="form-control py-4 px-4" id="reservationDate">
								<div class="input-group-append"></div>
							</div>
							<div class="col-md-4 input-group mt-4 mt-md-0">
								<input type="number" class="form-control" style="height:100%;" placeholder="days">
								<input type="number" class="form-control" style="height:100%;" placeholder="hours">
								<input type="number" class="form-control" style="height:100%;" placeholder="mins">
							</div>
						</div>
					</div>
				</div>
				
				<div class="card mt-4 ml-4 mr-4">
					<div class="card-body">
						<div class="card-title">
							<h3>Price</h3>
						</div>
						
						<div class="form-inline">
							<div class="form-group">
								<input type="number" placeholder="Price" step="0.1" class="form-control" />
								<input type="checkbox" id="meumeu" class="ml-2"/>
								<label class="ml-2 form-check-label mt-3 mt-md-0" for="meumeu">
								InstaBuy Price
								</label>
							</div>
						</div>


					</div>
				</div>

				<div class="card mt-4 ml-4 mr-4">
					<div class="card-body">
						<div class="card-title">
						<h3>Certification</h3>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
							<label class="form-check-label" for="defaultCheck1">
							I confirm I have a certificate and it's genuine.
							</label>
						</div>
						<input type="file" class="form-control-file" id="exampleFormControlFile1">
					</div>
				</div>
				<div class="mt-4 ml-4 mr-4">
				<button type="button" class="btn btn-olive" style="width:100%;">Submit</button>
				</div>

			</form>
        </div>

        <?php include_once('../templates/footer.php'); ?>
    </div>
</body>
