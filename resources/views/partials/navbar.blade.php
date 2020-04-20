<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div>        
        <a class="navbar-brand" href="/auctions"><img src={{ asset('/assets/small_panda.png') }}>Bazooki</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="nav-item form-inline my-auto mx-auto" action="/auctions/query" method="GET">
            <div class="input-group">
                <input class="w-auto form-control rounded-0" type="search" placeholder="Search" aria-label="Search">
                <button class="input-group-light btn btn-olive rounded-0" type="submit">
                    <i class="fa fa-search p-0"></i>
                Search
                </button>
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/profile#profile_tabs">My Bids<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/auctions/add">Create Auction<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user p-0"></i>
                    User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profile">Profile</a>
                    <a class="dropdown-item" href="/dashboard">Dashboard</a>
                    <a class="dropdown-item" href="/profile#tabs-3">My auctions</a>
                    <a class="dropdown-item" href="/account/settings.php">Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/login">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
