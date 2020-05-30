<div class="card shadow-sm rounded-0 border-0 @if (!$first) mt-3 mt-sm-2 @endif">
    <div class="row align-items-top no-gutters">
        <div class="col-xs-12 col-sm-4">
            <img src="{{ asset('assets/gun.jpg') }}" class="auction-img card-img rounded-0" alt="logo">
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="card-body">
                <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                    <div class="">
                        <h4 class="card-title">{{ $auction->item_name }}</h4>
                        @if ($auction->isOver())
                            <h6 class="card-subtitle text-muted">Already over</h6>
                        @else
                            <h6 class="card-subtitle text-muted">Ends: {{ $auction->endTime()->format('d M Y H:i:s') }}</h6>
                        @endif

                        <div>
                            @foreach($auction->categories as $cat)
                                <span class="badge badge-light border mr-1 mt-2">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <span class="mr-1 auction-price">{{ $auction->currentPrice() }}</span>$
                    </div>
                </div>
                <p class="mt-2 card-text auction-short-desc">{{ $auction->item_short_description }}</p>
            </div>
        </div>
        <a href="{{ route('auction', $auction->id) }}" class="stretched-link"></a>
    </div>
</div>
