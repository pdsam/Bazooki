<html>
    <?php include_once("../templates/header.php"); ?>

    <body class="bg-light">
        <link rel="stylesheet" href="<?= $files_path . '/css/register.css';?>">       

        <div class="container">
            <?php include_once("../templates/navbar.php"); ?>
        </div>

        <div class="container-fluid row"> 
            <div id="login-img" class="col-lg-7 col-sm-12 text-center">
                <img src="../assets/budda_cropped.jpg">
                <div class="jumbotron">
                    <h1 class="display-4"></h1>
                    <hr class="my-4">
                    <p class="lead">“There are two mistakes one can make along the road to truth… not going all the way, and not starting.”</p>
                    <p>- Buddha</p>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div id="register-container" class="text-center">
                    <form class="form-signin" method="POST">
                        <img class="mb-4" src="../assets/panda_transparency.png" alt="" width="150" height="150">
                        <h1 class="h3 mb-3 font-weight-normal">Bazooker Sign Up</h1>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="registerUsername" aria-describedby="userHelp" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="registerPassword" placeholder="Password" name="password">
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="terms-and-conditions" required> I accept the Terms and Conditions 
                            </label>
                        </div>
                        
                        <button class="btn btn-lg btn-primary btn-block" type="submit">REGISTER</button>
                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Register with Google</button>
                                    
                    </form>
                </div>
                <?php include_once("../templates/footer.php"); ?>
            </div>
        </div>
            
    </body>
</html>