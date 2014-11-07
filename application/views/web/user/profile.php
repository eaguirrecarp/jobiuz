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

    <script src="<?=$base?>template/js/jquery.validate.min.js"></script>
    <script src="<?=$base?>template/js/form-validation-script.js"></script>
    <script type="text/javascript">
        var centreGot = false;
    </script>
    <?php echo $map['js']; ?>
</head>
<body>
 <!-- Row Logo Seach Menu Iconos-->           
     <div class="container-fluid">
                <div class="row">
                              <div class="col-md-2"></div>          
                              <div class="col-md-2"><div class="logo"></div></div>
                              <div class="col-md-1"></div>
                              <div class="col-md-3">
                                    <form class="navbar-form" role="search">
                                        <div class="form-group">
                                        <input type="text" class="searchy font27" placeholder="Search">
                                        </div>
                                    </form>
                              </div>
                              <div class="col-md-4"> 
                                  <h1 class="text-left font30">
                                     <a href="<?=site_url('web/user/home')?>" class="menuup"><i class="icon-house"></i></a>
                                     <a class="menuup"><i class="icon-location2"></i></a>
                                     <a class="menuup"><i class="icon-mail"></i></a>
                                     <a class="menuup"><i class="icon-user"></i></a>
                                  </h1>

                            </div>
                          
                 </div>
    </div>
<!-- Row Logo Seach Menu Iconos-->
   

    <!-- banner -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="background:#fff">
            <form action="<?=site_url('web/user/profile')?>" method="post">
                <div class="col-md-12">
                    <div class="col-md-2">
                    <label align="left">PROFILE</label> <br>
                       <i class=""><img src="<?=$result['picture']?>" /></i>
                    <!-- <label align="center"><a data-toggle="modal" data-target="#myModal">Change/Load <br> your Picture</a></label> <br> -->
                            <button data-toggle="modal" href="#myModal" class="btn btn-white profile" type="button" style="border: 0px;">Change/Load your Picture</button>
                    </div>
                    <div class="col-md-8">

                        <div class="message_panel">
                           
                            <div id="message_success" class="alert alert-success alert-block fade in" style="display:none">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p><?= $message["success"] ?></p>
                            </div>
                            <div id="message_error" class="alert alert-block alert-danger fade in" style="display:none" >
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <strong><?= $message["error"] ?></strong>
                            </div>
                            <div class="alert alert-success fade in" style="display:none">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <strong>Well done!</strong> You successfully read this important alert message.
                            </div>
                            <div class="alert alert-info fade in" style="display:none">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                            </div>
                            <div class="alert alert-warning fade in" style="display:none">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <strong>Warning!</strong> Best check yo self, you're not looking too good.
                            </div>

                        </div>

                        Full name:
                        <input type="text" name="full_name" value="<?=$result['nombre_cuenta']?>" class="profile" />
                        User name:
                        <input type="text" name="user_name" value="<?=$result['nickname']?>" class="profile" />
                        E-mail:
                        <input type="text" name="email" value="<?=$result['email']?>" class="profile" />
                        Password:
                        <div class="input-group ">
                            <input type="password" value="<?=$result['password']?>" class="profile" />
                            <span class="input-group-btn">
                                <button data-toggle="modal" href="#changepassModal" class="btn btn-white profile" type="button">Change</button>
                            </span>
                        </div>
                        Gender Male<input type="radio" name="gender" value="MAL" <?=($result['genero']==1)?"checked":""?> /> Female<input type="radio" name="gender" value="FEM" <?=($result['genero']==2)?"checked":""?> /> Other<input type="radio" name="gender" value="OTH" <?=($result['genero']==3)?"checked":""?> />
                    </div>
                </div>
                <div class="col-md-12">
                    Networks and Notification      
                    <div class="col-md-2">
                        <i class="icon-facebook2 font48"></i>
                    </div>

                    <div class="col-md-8">
                        <p>Use your Facebook account to Login. </p>
                        <p>Publish your activity to your timeline. </p>
                    </div>
                    <div class="col-md-2">
                        <div class="switch has-switch"><div class="switch-on switch-animate"><input type="checkbox" name="connect_facebook" <?=($result['connect_facebook']==1)?"checked":""?> data-toggle="switch"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                        <div class="switch has-switch"><div class="switch-on switch-animate"><input type="checkbox" name="publish_timeline_facebook" <?=($result['publish_timeline_facebook']==1)?"checked":""?> data-toggle="switch"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                    </div>
                </div>
                <div class="col-md-12">
                     <div class="col-md-2">
                     <i class="icon-googleplus2 font48"></i>
                     </div>
                    
                    <div class="col-md-8">
                    <p>Use your Google account to Login. </p>
                    <p>Publish your activity to your hangout.</p>
                    </div>
                    <div class="col-md-2">
                    <div class="switch has-switch"><div class="switch-on switch-animate"><input type="checkbox" name="connect_google" <?=($result['connect_google']==1)?"checked":""?> data-toggle="switch"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                    <div class="switch has-switch"><div class="switch-on switch-animate"><input type="checkbox" name="publish_hangout_google" <?=($result['publish_hangout_google']==1)?"checked":""?> data-toggle="switch"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                    </div>
                </div>
                <div class="col-md-12">
                     <label>
                     Get an e-mail when..
                     </label>
                     <div class="col-md-2 ">
                     <i class="icon-mail font48"></i>
                     </div>
                    
                    <div class="col-md-8">
                    <p>A Company connectts whit you. </p>
                    <p>Someone wants to chat whit you.</p>
                    <p>A Company favorited your Ad.</p>
                    </div>
                    <div class="col-md-2">
                    <input type="checkbox" name="mail_company_connects" <?=($result['mail_company_connects']==1)?"checked":""?>  /><br>
                    <input type="checkbox" name="mail_company_chat_you" <?=($result['mail_company_chat_you']==1)?"checked":""?> /><br>
                    <input type="checkbox" name="mail_company_favorite_add" <?=($result['mail_company_favorite_add']==1)?"checked":""?> /><br>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2 "> 
                    </div>
                    <div class="col-md-8">
                        <?php echo $map['html']; ?>
                        <input type="hidden" id="latitude" name="latitude" >
                        <input type="hidden" id="longitude" name="longitude" > 
                    </div>
                    <div>
                    </div class="col-md-2 ">
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <!-- <a data-toggle="modal" data-target="#deleteModal">DELETE ACCOUNT</a> -->
                        <button data-toggle="modal" href="#deleteModal" class="btn btn-white profile" type="button" style="border: 0px;">DELETE ACCOUNT</button>
                    </div>
                    <div class="col-md-6"><div style="" class="switch-on switch-animate"><input checked="" type="checkbox"><span class="switch-left"><i class=" icon-ok"></i></span><label>&nbsp;</label><span class="switch-right"><i class="icon-remove"></i></span></div>  </div>
                </div>
                <div class="col-md-12">
                    <center><input type="submit" name="datauser_submit" value="Submit"></center>
                </div>
            </form>  
        </div>
        <div class="col-md-2"></div>
    </div>
    <?php echo $this->load->view('web/modals/upload_modal'); ?>
    <?php echo $this->load->view('web/modals/changepass_modal'); ?>
    <?php echo $this->load->view('web/modals/delete_modal'); ?>
</body>
</html>

<script type="text/javascript">
    var message = '<?php echo json_encode($message); ?>';
    var mess = $.parseJSON(message);
    if(mess.success)
    {
        $("#message_success").show();
        setTimeout(function(){
            $("#message_success").toggle("show");
        },4000);
    }
    if(mess.error)
    {
        $("#message_error").show();
        setTimeout(function(){
            $("#message_error").toggle("show");
        },4000);
    }


    function updateDatabase(newLat, newLng)
    {
        // make an ajax request to a PHP file
        // on our site that will update the database
        // pass in our lat/lng as parameters
        $("#latitude").val(newLat);
        $("#longitude").val(newLng);
    }
 
    
</script>