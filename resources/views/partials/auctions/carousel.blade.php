<div class="carouselParent">
    <h3>{!! $title !!}</h3>
    <div id="{{ $id }}" class="carousel slide add-margin" data-ride="carousel">

        <div class="carousel-inner">
            @foreach($items as $i => $curr)
                <div class="carousel-item @if($i===0) active @endif">
                <div class="row">
                    @foreach($curr as $card)
                        @include('partials.auctions.carousel_card', [
                            'size' => $cardsize,
                            'title' => $card['title'], 
                            'img' => $card['img'], 
                            'description' => $card['description']
                        ])
                    @endforeach
                </div>                
            </div>
            @endforeach
        </div>
    </div>
    <div class="row carousel-controls">
        <a class="col-lg-1 col-sm-6 btn btn-olive btn-lg" href="#{{ $id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="col-lg-1 col-sm-6 btn btn-olive btn-lg" href="#{{ $id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
