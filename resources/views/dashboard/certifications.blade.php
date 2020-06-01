@extends('layouts.dashboard_page')

@section('active-certifications', 1)

@section('tab-content')
    <h2>Certifications</h2>

        
    @foreach ($auctions as $auction)
        <div class="shadow-sm border mt-3 mt-lg-1">
            <div class="card rounded-0 border-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-12 col-sm-4">
                        <img src="{{ asset($auction->photo) }}" class="card-img rounded-0" alt="logo">
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $auction->item_name }}</h4>
                            <h6 class="card-subtitle text-muted">Owned by: <a href="/profile/{{ $auction->owner }}">{{ $auction->owner_name }}</a></h6>
                            <div class="mt-3">
                                <p>
                                    {{ $auction->item_short_description }}
                                </p>
                            </div>
                            <a class="btn btn-primary" href="{{ asset($auction->certification_path) }}">View certification</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="certification{{ $auction->id }}" class="certification_actions collapse">
                <div class="row my-3 mx-2">
                    <div class="col-lg-6">
                        <button class="btn btn-success">
                            Accept
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-danger">
                            Reject
                        </button>
                    </div>
                </div>
            </div>
            <a href="#certification{{ $auction->id }}" class="cert-toggle justify-content-center d-flex py-3 text-muted bg-light" data-toggle="collapse" data-target="#certification{{ $auction->id }}">
                <p class="m-0">Actions <span class="fa fa-chevron-down"></span></p>
            </a>
        </div>
    @endforeach

    <script src="{{ asset('js/collapseChevron.js') }}"></script>
@endsection