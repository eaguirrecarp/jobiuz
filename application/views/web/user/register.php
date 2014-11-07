<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobiuz</title>
    <!-- Bootstrap -->
    <!--  <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Bootstrap -->
    <link href="<?=$base.'template/css/bootstrap.min.css'?>" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?=$base.'template/css/style.css'?>" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=$base?>template/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
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
                    <div class="logo"></div> 
                </div>
                <div>
                    <p class="navbar-text navbar-right"><h1 class="text-right titulo2 font36">Already a member?<a href="<?=site_url('web/user/login')?>" class="navbar-link titulo font36">Log In here...</a></h1></p>
                </div>
            </div>
        </header>
    </div>        
    <!-- end Container -->
    <!-- banner -->
    <div class="banner">
        <div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-3"><h2 class="titulo2s font36"><br>The place<br>were work connections</h2> 
                    <h1 class="titulo2s font60">HAPPENS!</h1>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-6">
                    <form action="<?=site_url('web/user/insert')?>" class="form-signin" method="post" id="form-signup">
                        <div class="login-wrap">
                            <h1 class="font54"> Welcome!<br> <small>Please Sign In...</small></h1>
                            <input type="text" name="email" id="email" autofocus placeholder="E-mail" class="form-control font27">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control font27">
                            <input type="password" name="re_password" id="re_password" placeholder="Confirm Password" class="form-control font27">
                            <button type="submit" class="btn btn-lg btn-login btn-block font48">Register</button>
                            <h2 class="text-center font24">Or Sign in whit ... </h2>
                        </div>
                        <div class="login-social-link">
                            <a class="facebook font27" href="<?=site_url('web/user/social_login/facebook')?>">
                            <i class="icon-facebook"></i> Facebook </a>
                            <a class="google font27" href="<?=site_url('web/user/social_login/google')?>">
                            <i class="icon-googleplus"></i> Google </a></div>

                            <!-- Modal -->
                            <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                     <div class="modal-dialog">
                                       <div class="modal-content">
                                        <div class="modal-header">
                                         <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                         <h4 class="modal-title">Forgot Password ?</h4>
                                       </div>
                                       <div class="modal-body">
                                         <p>Enter your e-mail address below to reset your password.</p>
                                         <input type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Email" name="email">

                                       </div>
                                       <div class="modal-footer">
                                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                         <button type="button" class="btn btn-success">Submit</button>
                                       </div>
                                     </div>
                                   </div>
                            </div> -->
                            <!-- modal -->
                    </form>
                </div>
            </div>

        </div>
        <div>
            <div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <h1 class="text-center titulo2 font36">I'm an employer,<a href="<?=site_url('web/employer')?>" class="navbar-link titulo font36">click here!</a></h1>
                    </div>
                </div>                          
            </div>
        </div>
        <div class="pie"> 
        </div>
    </div>
    <!-- banner -->


</body>
</html>

<script>

    $( document ).ready(function() {
        $( "#form-signup" ).submit(function( event ) {
            var pass = $("#password").val();
            var re_pass = $("#re_password").val();

            if(validar_email($("#email").val()))
            {
                if( pass == re_pass)
                {
                    $("#form-signup").submit();
                }
                else
                {
                    alert("Password and confirm password must be equal ");
                    $("#password").val("");
                    $("#re_password").val("");
                    $("#password").focus();
                }
            }else
            {
                alert("El email no es valido");
                $("#email").focus();
            }
            return false;
            event.preventDefault();
        });

        function validar_email(valor)
        {
            var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            if(filter.test(valor))
                return true;
            else
                return false;
        }
    });

</script>