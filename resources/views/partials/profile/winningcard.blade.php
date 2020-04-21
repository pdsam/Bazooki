<div class="card">
    <a href="/auctions">
        <img class="card-img-top" src="{{ asset('../assets/gun.jpg') }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $title }}</h5>
            <p class="card-text"><small class="text-muted">{{ $owner }}</small></p>
            <p class="card-text">{{ $description }}</p>
            <h5>Winning bid: {{ $currentbid }} €</h5>
            <div class="card-rating">
                <p>Leave a rating: </p>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
        </div>
    </a>
</div>
