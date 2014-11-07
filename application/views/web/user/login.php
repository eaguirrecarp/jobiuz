<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobiuz</title>

    <link href="<?=$base?>template/css/bootstrap.min.css" rel="stylesheet">
      
    <link href="<?=$base?>template/css/style.css" rel="stylesheet">

    <script src="<?=$base?>template/js/jquery.min.js"></script>
    <script src="<?=$base?>template/js/bootstrap.min.js"></script>
    <script src="<?=$base?>template/js/jquery.js"></script>
    <script src="<?=$base?>template/js/jquery-ui.js"></script>
    <script src="<?=$base?>template/js/jquery-ui.min.js"></script>

</head>
<body>
    <!-- Container -->
    <div class="container">
        <header>
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="logo">                               
                    </div>
                </div>
                <div>
                    <p class="navbar-text navbar-right">
                        <h1 class="text-right titulo2 font36">Going mobile? <a href="http://localhost/jobiuz/index.php/web/user/login" class="navbar-link titulo font36">Download our app here...</a></h1>
                    </p>
                </div>
            </div>
        </header>
    </div>        
    <!-- end Container -->
    <!-- banner -->
    <div class="banner">
        <div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <h2 class="titulo2s font36"><br>The place<br>were work connections</h2> 
                    <h1 class="titulo2s font60">HAPPENS!</h1>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <form action="<?=site_url('web/user/authenticate')?>" class="form-signin" id="form-signin" method="post">
                        <div class="login-wrap">
                            <h5 class="titulo3 font54">Welcome!</h5>
                            <h5 class="titulo3 font36"> Please Log In...</h5>
                            <input type="text" name="email" autofocus placeholder="E-mail" class="form-control font32" />
                            <input type="password" name="password" placeholder="Password" class="form-control font32" />
                            <button type="submit" class="btn btn-lg btn-login btn-block font48">Log In</button>
                            <h5 class="font24 text-rigth"> Keep me logged
                                <input class="font24 text-rigth" name="renember" type="checkbox" value="remember"> 
                            </h5>
                            <h5 class="text-center font24"><br>Or Sign in whit ... </h5>
                        </div>
                        <div class="login-social-link">
                            <a class="facebook font27" href="<?=site_url('web/user/social_login/facebook')?>">
                            <i class="icon-facebook"></i>Facebook</a>
                            <a class="google font27" href="<?=site_url('web/user/social_login/google'); ?>">
                            <i class="icon-googleplus"></i>Google</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <div>
    <div>
         <div class="pie">
            <div>
                <div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <h1 class="text-center titulo2 font36">Not a member? <a href="<?=site_url('web/user')?>" class="navbar-link titulo font36">Sign on here...</a></h1>
                        </div>
                    </div>                          
                </div>
            </div>
         </div>
    </div> 
</body>
</html>