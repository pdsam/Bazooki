@extends('layouts.app')

@section('title', 'Bazooki - Create auction')

@section('error_handling')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                <li>Invalid input provided</li>
            </ul>
        </div>
    @endif
@endsection

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <script src="{{ asset('/js/create_auction.js') }}" defer></script>
    <link rel="stylesheet" href={{ asset('css/create_auction.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <div>
        <h1>Create auction</h1>
        <form action="/auctions/add" method="POST" id="createAuctionForm" onsubmit="return addRequiredInputs();" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-4 ml-4 mr-4">
                @error('name')
                    <div class="text-left">
                        <p class="text-danger m-0">{{ $message }}</p>
                    </div>
                @enderror
                <h3>Product title*</h3>
                <input name="name" type="text" class="form-control" id="productTitle" placeholder="Title" required>
            </div>

            <div class="form-group mt-4 ml-4 mr-4">
                @error('short_description')
                    <div class="text-left">
                        <p class="text-danger m-0">{{ $message }}</p>
                    </div>
                @enderror
                <h3>Short product description*</h3>
                <input name="short_description" class="form-control" id="short_description" placeholder="Short description" required>
            </div>
            
            <div class="form-group mt-4 ml-4 mr-4">
                @error('description')
                    <div class="text-left">
                        <p class="text-danger m-0">{{ $message }}</p>
                    </div>
                @enderror
                <h3>Product description*</h3>
                <textarea name="description" class="form-control" rows="5" id="description" placeholder="Description"></textarea>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        @error('base_bid')
                            <div class="text-left">
                                <p class="text-danger m-0">{{ $message }}</p>
                            </div>
                        @enderror
                        <h3>Base bid*</h3>
                        <input name="base_bid" type="number" placeholder="Base bid" step="1" min="0" class="form-control" required>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-12" hidden>
                    <div class="form-group ml-4 mr-4">
                        @error('insta_buy')
                            <div class="text-left">
                                <p class="text-danger m-0">{{ $message }}</p>
                            </div>
                        @enderror
                        <h3>Instant buy price (optional)</h3>
                        <input name="instant_buy" type="number" placeholder="Instant Buy Price" step="1" min="0" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        @error('start_time')
                            <div class="text-left">
                                <p class="text-danger m-0">{{ $message }}</p>
                            </div>
                        @enderror
                        <h3>Start date*</h3>    
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="start_time" placeholder="Start time" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text bg-olive"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group ml-4 mr-4">
                        @error('duration')
                            <div class="text-left">
                                <p class="text-danger m-0">{{ $message }}</p>
                            </div>
                        @enderror
                        <h3>Duration*</h3>
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
                    @error('categories')
                        <div class="text-left">
                            <p class="text-danger m-0">{{ $message }}</p>
                        </div>
                    @enderror
                    @error('categories.*')
                        <div class="text-left">
                            <p class="text-danger m-0">{{ $message }}</p>
                        </div>
                    @enderror
                    <div class="card-title">
                        <h3>Categories</h3>
                        <p>Select all that apply</p>
                    </div>
                    <select class="auction_categories" name="categories[]" multiple="multiple">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>            
                </div>
            </div>
        
            <div class="card mt-4 ml-4 mr-4">
                <div class="card-body">
                    @error('photos')
                        <div class="text-left">
                            <p class="text-danger m-0">{{ $message }}</p>
                        </div>
                    @enderror
                    @error('photos.*')
                        <div class="text-left">
                            <p class="text-danger m-0">{{ $message }}</p>
                        </div>
                    @enderror
                    <div class="card-title">
                        <h3>Pictures</h3>
                        <p>May select more than one</p>
                    </div>
                    <ul class="thumbnails">
                    </ul>
                    <input name="photos[]" type="file" accept='image/*' class="form-control-file" id="auctionImageInput" multiple>
                    
                </div>
            </div>

            <div class="card mt-4 ml-4 mr-4">
                <div class="card-body">
                    @error('certification')
                        <div class="text-left">
                            <p class="text-danger m-0">{{ $message }}</p>
                        </div>
                    @enderror
                    <div class="card-title">
                        <h3>Certification</h3>
                        <p>You many annex one file as your Certification proof in PDF format.</p>
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
