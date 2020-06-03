    <div class="{{ $size }}">
        <div class="card h-100 carousel-card-small">
            <a href="/auctions/{{ $card['id'] }}">
                <img class="card-img-top card-image-sexy" src="{{ $img }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $title }}</h5>
                    <p class="card-text">{{ $description }} €</p>
                </div>
            </a>
        </div>
    </div>
