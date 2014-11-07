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
    <script src="<?=$base?>template/js/bootstrap-filestyle.js"></script>
    <?php 
         if (isset($scripts) && count($scripts))
         {
            foreach ($scripts as $script) 
            {
                echo '<script src="'.base_url().$script.'"></script>';
            }
         } 
    ?>
    <?php 
         if (isset($styles) && count($styles))
         {
            foreach ($styles as $style) 
            {
                echo '<link href="'.base_url().$style.'" rel="stylesheet">';
            }
         } 
    ?>
    <script>

    </script>
</head>
<body>
    <!-- Container -->
    <div class="container">
        <header>
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="logo"></div> 
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
                    <form action="<?=site_url('web/employer/insert')?>" class="form-signin" method="post" id="form-signup" enctype="multipart/form-data">
                        <div class="login-wrap">
                            <div style="position: relative;">
                                <center>
                                        <div id="previewcanvascontainer" style="display:none">
                                            <canvas id="previewcanvas" class="img-circle">
                                            </canvas>
                                        </div>
                                        <img src="<?=(isset($image))?$image:''?>" class="img-circle" style="margin: 4px;" id="pre_image" />
                                        <div style="position: absolute;left: 31%;top: 3px;" >
                                            <input type="file" name="userfile"  data-input="false" id="filestyle-0" onchange="return ShowImagePreview( this.files );" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);" >
                                            <div class="bootstrap-filestyle input-group">
                                                    <label for="filestyle-0" class="btn btn-default " style="width: 150px;height: 150px; background-color: rgb(255,255,255);opacity: 0;position: inherit;">    
                                                    </label>
                                            </div>
                                        </div>
                                </center>
                            </div>
                            <input type="text" name="company_name" id="company_name" autofocus placeholder="Company Name" class="form-control font27" value="<?=set_value('company_name')?>">
                            <?php echo form_error('company_name', '<div class="error">', '</div>'); ?>
                            <input type="text" name="responsible_name" id="responsible_name" autofocus placeholder="Responsible (Full Name)" class="form-control font27" value="<?=set_value('company_name')?>">
                            <?php echo form_error('responsible_name', '<div class="error">', '</div>'); ?>
                            <input type="text" name="email" id="email" autofocus placeholder="E-mail" class="form-control font27" value="<?=set_value('company_name')?>">
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control font27" value="<?=set_value('company_name')?>">
                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                            <input type="password" name="re_password" id="re_password" placeholder="Confirm Password" class="form-control font27" value="<?=set_value('company_name')?>">
                            <?php echo form_error('re_password', '<div class="error">', '</div>'); ?>
                            <button type="submit" class="btn btn-lg btn-login btn-block font48">Register</button>
                            <!-- <h2 class="text-center font24">Or Sign in whit ... </h2> -->
                        </div>
                        <!-- <div class="login-social-link">
                            <a class="facebook font27" href="<?=site_url('web/employer/social_login/facebook')?>">
                            <i class="icon-facebook"></i> Facebook </a>
                            <a class="google font27" href="<?=site_url('web/employer/social_login/google')?>">
                            <i class="icon-googleplus"></i> Google </a>
                        </div> -->
                    </form>
                </div>
            </div>

        </div>
        
        <div class="pie">
            <div>
                <div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <h1 class="text-center titulo2 font36">Already a member,<a href="<?=site_url('web/employer/login')?>" class="navbar-link titulo font36">Log in here!</a></h1>
                        </div>
                    </div>                          
                </div>
            </div>
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

    function ShowImagePreview( files )
    {
        if( !( window.File && window.FileReader && window.FileList && window.Blob ) )
        {
          alert('The File APIs are not fully supported in this browser.');
          return false;
        }

        if( typeof FileReader === "undefined" )
        {
            alert( "Filereader undefined!" );
            return false;
        }

        var file = files[0];

        if( !( /image/i ).test( file.type ) )
        {
            alert( "File is not an image." );
            return false;
        }

        reader = new FileReader();
        reader.onload = function(event) 
                { var img = new Image; 
                  img.onload = UpdatePreviewCanvas; 
                  img.src = event.target.result;  }
        reader.readAsDataURL( file );
    }

    function UpdatePreviewCanvas()
    {
        var img = this;
        var canvas = document.getElementById( 'previewcanvas' );

        if( typeof canvas === "undefined" 
            || typeof canvas.getContext === "undefined" )
            return;

        var context = canvas.getContext( '2d' );

        var world = new Object();
        // world.width = canvas.offsetWidth;
        world.width = 150;
        // world.height = canvas.offsetHeight;
        world.height = 150;

        canvas.width = world.width;
        canvas.height = world.height;

        if( typeof img === "undefined" )
            return;

        var WidthDif = img.width - world.width;
        var HeightDif = img.height - world.height;

        var Scale = 0.0;
        if( WidthDif > HeightDif )
        {
            Scale = world.width / img.width;
        }
        else
        {
            Scale = world.height / img.height;
        }
        if( Scale > 1 )
            Scale = 1;

        // var UseWidth = Math.floor( img.width * Scale );
        var UseWidth = 150;
        // var UseHeight = Math.floor( img.height * Scale );
        var UseHeight = 150;

        var x = Math.floor( ( world.width - UseWidth ) / 2 );
        var y = Math.floor( ( world.height - UseHeight ) / 2 );
        $("#pre_image").hide();
        $("#previewcanvascontainer").show();
        context.drawImage( img, x, y, UseWidth, UseHeight );  
    }
</script>