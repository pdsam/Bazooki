<?php $path = explode('/', $_SERVER['REQUEST_URI']); array_pop($path); array_pop($path); $files_path = join("/", $path);?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div>        
        <a class="navbar-brand" href="<?= $files_path ?>/pages/landing_page.php"><img src="../assets/small_panda.png">Bazooki</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="nav-item form-inline my-auto mx-auto" action="<?= $files_path ?>/pages/query.php" method="GET">
            <div class="input-group">
                <input class="w-auto form-control rounded-0" type="search" placeholder="Search" aria-label="Search">
                <button class="input-group-light btn btn-reverse-purple rounded-0" type="submit">
                Search
                </button>
            </div>
        </form>
        <ul class="navbar-nav">
        <li class="nav-item active ">
            <a class="nav-link custom-hover" id="button1" href="<?= $files_path ?>/pages/faq.php">FAQ<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active ">
            <a class="nav-link custom-hover" id="button2" href="#">About</a>
        </li>
        <li class="nav-item active dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user p-0"></i>
            User
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= $files_path ?>/pages/profile.php">Profile</a>
            <a class="dropdown-item" href="#">Account Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= $files_path ?>/pages/login.php">Log out</a>
            </div>
        </li>
        </ul>
    </div>
</nav>