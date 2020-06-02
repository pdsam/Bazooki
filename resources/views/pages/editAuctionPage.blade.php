@extends('layouts.app')

@section('title', 'Bazooki - Create auction')

@section('head')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<script type="text/javascript" src="{{ asset('/js/create_auction.js') }}" defer></script>
<link rel="stylesheet" href={{ asset('css/create_auction.css') }}>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div>
    <form action="/auctions/{{$id}}"/edit method="POST" id="createAuctionForm" onsubmit="return addRequiredInputs();" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mt-4 ml-4 mr-4">
            <h3>Product title</h3>
            <input name="name" type="text" class="form-control" id="productTitle" aria-describedby="prodTitle" placeholder="Title" value="{{$name}}" required>
        </div>

        <div class="form-group mt-4 ml-4 mr-4">
            <h3>Short product description</h3>
            <input name="short_description" class="form-control" id="short_description" placeholder="Short description" value={{$sDescription}} required>
        </div>

        <div class="form-group mt-4 ml-4 mr-4">
            <h3>Product description</h3>
            <textarea name="description" class="form-control" rows="5" id="description" placeholder="Description" >{{$description}}</textarea>
        </div>



        <div class="card mt-4 ml-4 mr-4">
            <div class="card-body">
                <div class="card-title">
                    <h3>Categories</h3>
                    <p>Select all that apply</p>
                </div>
                <select class="auction_categories" name="categories[]" multiple="multiple">
                    @foreach($categories as $cat)
                    @if($sCategories->contains($cat)))
                    <option value="{{ $cat->id }}" selected="true">{{ $cat->name }}</option>
                    @else
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card mt-4 ml-4 mr-4">
            <div class="card-body">
                <div class="card-title">
                    <h3>Pictures</h3>
                    <p>May select more than one</p>
                </div>
                <ul class="thumbnails">
                </ul>
                <input name="photos[]" type="file" accept='image/*' class="form-control-file" id="auctionImageInput" multiple>

            </div>
        </div>
<!--
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
    -->
        <div class="mt-4 ml-4 mr-4">
            <button class="btn btn-olive" style="width:100%;">Submit</button>
        </div>

    </form>
</div>
@endsection