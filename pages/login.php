<html>
    <?php include_once("../templates/header.php"); ?>

    <body class="bg-light">
        <link rel="stylesheet" href="<?= $files_path . '/css/login.css';?>">       

        <div class="container">
            <?php include_once("../templates/navbar.php"); ?>
        </div>

        <div class="container-fluid row"> 
            <div class="col-lg-5 col-sm-12">
                <div id="login-container" class="text-center">
                    <form class="form-signin">
                        <img class="mb-4" src="../assets/panda_transparency.png" alt="" width="150" height="150">
                        <h1 class="h3 mb-3 font-weight-normal">Welcome back Bazooker!</h1>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="loginUsername" aria-describedby="userHelp" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="password">
                        </div>
                        
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me"> Keep me logged in 
                            </label>
                        </div>
                        
                        <button class="btn btn-lg btn-primary btn-block" type="submit">SIGN IN</button>
                                    

                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
        
                        <div id="forgot-password">
                            <a href="#recover-password">Forgot your password?</a>
                        </div>
                        
                        <div id="register-prompt">
                            <p>Want to become a bazooker? <a href="register.php">Register here</a></p>
                        </div>
                    </form>
                </div>
                <?php include_once("../templates/footer.php"); ?>
            </div>
            <div id="login-img" class="col-lg-7 col-sm-12 text-center">
                <img src="../assets/login_img.jpg">
                <div class="jumbotron">
                    <h1 class="display-4"></h1>
                    <hr class="my-4">
                    <p class="lead">“The whole point of collecting is the thrill of acquisition, which must be maximized, and maintained at all costs.”</p>
                    <p>John Baxter, A Pound of Paper: Confessions of a Book Addict</p>
                </div>
            </div>
        </div>
            
    </body>
</html>