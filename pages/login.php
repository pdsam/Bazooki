<html>
    <?php include_once("../templates/header.php"); ?>

    <body class="bg-light">
        <link rel="stylesheet" href="<?= $files_path . '/css/login.css';?>">       

        <div class="container">
            <?php include_once("../templates/navbar.php"); ?>
        </div>

        <div id="login-container" class="text-center container">
            <form class="form-signin">
                <img class="mb-4" src="../assets/panda_transparency.png" alt="" width="150" height="150">
                <h1 class="h3 mb-3 font-weight-normal">Welcome back!</h1>
                
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                
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
                    <p>Want to become a bazooker?</p>
                    <a href="register.php">Register here</a>
                </div>
            </form>
        </div>
            
        <?php include_once("../templates/footer.php"); ?>
    </body>
</html>