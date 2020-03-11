<head>
    <title>Bazooki</title>
    <?php $path = explode('/', $_SERVER['REQUEST_URI']);
    array_pop($path);
    array_pop($path);
    $files_path = join("/", $path); ?>
    <?php include_once(getcwd() . '/../templates/header.php') ?>
    <link rel="stylesheet" href="<?= $files_path ?>/css/profile.css">
</head>

<body>
    <div class="container-fluid">
        <?php include_once(getcwd() . '/../templates/navbar.php') ?>
        <div class="row">

            <div id="profile_pic" class="col-sm-4">
                <img src="https://picsum.photos/300/300">
            </div>
            <div id="profile_description" class="col-sm-8">
                <div class="jumbotron">
                    <h1 class="display-4">Mário Gil</h1>
                    <div id="profile_stats" class="row">
                        <div class="col-sm-4">
                            <p>8 Users</p>
                        </div>
                        <div class="col-sm-4">
                            <p>8 Users</p>
                        </div>
                        <div class="col-sm-4">
                            <p>8 Users</p>
                        </div>
                    </div>

                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac luctus diam, non porta augue. Pellentesque tempor vel enim ut posuere. Quisque in sagittis quam, sit amet facilisis diam. Nam tellus ipsum, fringilla non nisl id, molestie volutpat neque. Curabitur quis dapibus justo, eget malesuada mauris. Duis quis finibus magna. Mauris laoreet varius dolor, eget semper odio posuere ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sollicitudin velit sed purus gravida lobortis. Sed ut imperdiet felis. Cras massa mauris, volutpat auctor fringilla nec, imperdiet sit amet mauris. Duis ac lacinia orci. Cras interdum mi dignissim, elementum sapien mattis, pulvinar justo. Duis molestie leo eu nulla suscipit convallis. Nam tristique commodo aliquam.</p>
                </div>
            </div>
            
        </div>
    </div>

    <hr class="customhr">

    <ul id="profile_tabs_select" class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">First Panel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Second Panel</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Third Panel</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div id="profile_tabs" class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="row">
                <div class="col-12">Row 1</div>
                <div class="col-12">Row 2</div>
                <div class="col-12">Row 3</div>
            </div>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="row">
                <div class="col-12">Row 4</div>
                <div class="col-12">Row 5</div>
                <div class="col-12">Row 6</div>
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="row">
                <div class="col-12">Row 7</div>
                <div class="col-12">Row 8</div>
                <div class="col-12">Row 9</div>
            </div>
        </div>
    </div>
</body>
