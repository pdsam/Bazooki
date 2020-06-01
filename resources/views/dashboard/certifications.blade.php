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
                            <h6 class="card-subtitle text-muted">Owned by: <a href="/profile">{{ $auction->owner }}</a></h6>
                            <div class="mt-3">
                                <p>
                                    {{ $auction->item_short_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="certification{{ $auction->id }}" class="collapse p-3">
                <div class="my-3 mx-2">
                    Certification document:
                    <ul>
                        <li>
                            <a href="/assets/cert1.pdf">document1</a>
                        </li>
                    </ul>
                </div>
                <div class="mt-2">
                    <button class="btn btn-success">
                        Accept
                    </button>
                    <button class="btn btn-danger">
                        Reject
                    </button>
                </div>
            </div>
            <a href="#certification{{ $auction->id }}" class="cert-toggle justify-content-center d-flex py-3 text-muted bg-light" data-toggle="collapse" data-target="#certification{{ $auction->id }}">
                <p class="m-0">Document <span class="fa fa-chevron-down"></span></p>
            </a>
        </div>
    @endforeach

    <script src="{{ asset('js/collapseChevron.js') }}"></script>
@endsection