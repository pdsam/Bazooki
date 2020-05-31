@extends('layouts.app')

@section('title', 'Bazooki - Create auction')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.1/image-picker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/image-picker/0.3.1/image-picker.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/create_auction.js') }}" defer></script>
	
	<style>
		.datepicker td, .datepicker th {
			width: 2.5rem;
			height: 2.5rem;
			font-size: 0.85rem;
		}

        .thumbnails img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

	</style>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <form action="/auctions/add" method="POST" id="createAuctionForm" onsubmit="return addRequiredInputs();" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-4 ml-4 mr-4">
                <h3>Product title</h3>
                <input name="name" type="text" class="form-control" id="productTitle" aria-describedby="prodTitle" placeholder="Title" required>
            </div>

            <div class="form-group mt-4 ml-4 mr-4">
                <h3>Short product description</h3>
                <input name="short_description" class="form-control" id="short_description" placeholder="Short description" required></input>
            </div>
            
            <div class="form-group mt-4 ml-4 mr-4">
                <h3>Product description</h3>
                <textarea name="description" class="form-control" rows="5" id="description" placeholder="Description"></textarea>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        <h3>Base bid</h3>
                        <input name="base_bid" type="number" placeholder="Base bid" step="0.1" min="0" class="form-control" required></input>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        <h3>Instant buy price (optional)</h3>
                        <input name="instant_buy" type="number" placeholder="Instant Buy Price" step="0.1" min="0" class="form-control"></input>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        <h3>Start date</h3>    
                        <div class="datepicker-start date input-group p-0">
                            <input name="start_time" type="text" placeholder="Start date" class="form-control" id="reservationDate" required>
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        <h3>Duration</h3>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Days" id="days" step="1" min="0" required>
                            <input type="number" class="form-control" placeholder="Hours" id="hours" step="1" min="0" max="24" required>
                            <input type="number" class="form-control" placeholder="Minutes" id="mins" step="1" min="0" max="60" required>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="card mt-4 ml-4 mr-4">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Pictures</h3>
                        <p>May select more than one</p>
                    </div>
                    <select class="image-picker show-html">
                    </select>
                    <input name="photos[]" type="file" accept='image/*' class="form-control-file" id="auctionImageInput" multiple>
                    
                </div>
            </div>

            <div class="card mt-4 ml-4 mr-4">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Certification (optional)</h3>
                    </div>
                    <div class="form-check" style="margin-bottom: 10px;">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="certification_check">
                        <label class="form-check-label" for="defaultCheck1">
                            I confirm I have a certificate in PDF format and it's genuine.
                        </label>
                    </div>
                    <input name="certification" accept="application/pdf" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
            </div>
            <div class="mt-4 ml-4 mr-4">
                <button class="btn btn-olive" style="width:100%;">Submit</button>
            </div>

        </form>
    </div>
@endsection
