<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobiuz</title>

    <link href="<?=$base?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$base?>template/css/style.css" rel="stylesheet">
    <link href="<?=$base?>template/css/maps.css" rel="stylesheet">
    <script src="<?=$base?>template/js/jquery.min.js"></script>
    <script src="<?=$base?>template/js/bootstrap.min.js"></script>
    <script src="<?=$base?>template/js/jquery.js"></script>
    <script src="<?=$base?>template/js/jquery-ui.js"></script>
    <script src="<?=$base?>template/js/jquery-ui.min.js"></script>

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
                                 <a href="<?=site_url('web/user/profile')?>" class="menuup"><i class="icon-user"></i></a>
                              </h1>

                        </div>
                      
             </div>
</div>
<!-- Row Logo Seach Menu Iconos-->
                          
<!-- Row Nombre Menu 1  Menu 2  Config -->
<div class="container-fluid">
          <div class="row" style="background:#cbcbcb">
                        <div class="col-md-2"></div>
                        <!-- div col md 8-->
                            <div class="col-md-1"> <img src="<?=$result['picture']?>" class="img-circle userpicture font27"></div>
                            <div class="col-md-2 font27"><h3><?=$this->session->userdata("user_name");?>&nbsp;&nbsp;&nbsp;<a href="<?=site_url('web/user/logout')?>">Logout</a></h3> </div>
                                                         
                            <div class="col-md-2"> 
                                 <h1 class="font27">
                                    <a class="menudown"><i class="icon-star"></i></a>
                                    <a class="menudown"><i class="icon-earth"></i></a>
                                    <a class="menudown"><i class="icon-flag"></i></a>
                                    <a href="<?=site_url('web/user/filters')?>" class="menudown"><i class="icon-ellipsis"></i></a>
                                 </h1>
                            </div>
                              
                              <div class="col-md-2">  
                                    <h1 class="font27">
                                    <a href="<?=site_url('web/user/list_notices')?>" class="menudown"><i class="icon-vcard"></i></a>
                                    <a href="<?=site_url('web/user/list_favorites')?>" class="menudown"><i class="icon-paperclip"></i></a>
                                    <a href="<?=site_url('web/user/message')?>" class="menudown"><i class="icon-pencil"></i></a>
                                    </h1>   
                               </div>
                               
                               <div class="col-md-1"> 
                               <h1 class="font27">
                               <a class="menudown"><i class="icon-cog"></i></a> 
                               </h1>
                               </div>
                         <div class="col-md-2"></div>
                  </div>
</div>

<!-- Row Nombre Menu 1  Menu 2  Config -->      
<div class="container-fluid">

    <div class="row">
       
        <div class="container" style="background:#ffffff" >

            <form action="<?=site_url('web/message/insert')?>" method="post">
                <div class="col-md-12">
                    <div class="col-md-2">
                    <label align="left">MESSAGE</label> <br>
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

                        <div class="col-md-8">Message:</div>
                        
                        <textarea class="form-control" rows="3" placeholder="Write your message here"></textarea>
                        <div class="col-md-8">Salary:</div>
                        
                        <input type="text" name="wage"  class="profile" placeholder="Wage pretension" />
                        <div class="col-md-8">Day:</div>
                        
                        <div class="col-md-8">
                            <div class="col-md-4">
                                <select name="time_day_initial"  class="profile" placeholder="" class="form-control">
                                    <option>Select</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-md-2">To</div>
                            <div class="col-md-4">
                                <select name="time_day_end"  class="profile" placeholder="" class="form-control">
                                    <option>Select</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">Time:</div>
                        <div class="col-md-8">
                            <div class="col-md-4">
                                <select name="schedule_time_initial"  class="profile" placeholder="" class="form-control">
                                    <option>Select</option>
                                    <option value="1:00">1:00</option>
                                    <option value="2:00">2:00</option>
                                    <option value="3:00">3:00</option>
                                    <option value="4:00">4:00</option>
                                    <option value="5:00">5:00</option>
                                    <option value="6:00">6:00</option>
                                    <option value="7:00">7:00</option>
                                    <option value="8:00">8:00</option>
                                    <option value="9:00">9:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                    <option value="21:00">21:00</option>
                                    <option value="22:00">22:00</option>
                                    <option value="23:00">23:00</option>
                                    <option value="24:00">24:00</option>
                                </select>
                            </div>
                            <div class="col-md-2">To</div>
                            <div class="col-md-4">
                                <select name="schedule_time_end"  class="profile" placeholder="" class="form-control">
                                    <option>Select</option>
                                    <option value="1:00">1:00</option>
                                    <option value="2:00">2:00</option>
                                    <option value="3:00">3:00</option>
                                    <option value="4:00">4:00</option>
                                    <option value="5:00">5:00</option>
                                    <option value="6:00">6:00</option>
                                    <option value="7:00">7:00</option>
                                    <option value="8:00">8:00</option>
                                    <option value="9:00">9:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                    <option value="21:00">21:00</option>
                                    <option value="22:00">22:00</option>
                                    <option value="23:00">23:00</option>
                                    <option value="24:00">24:00</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-12">
                    <center><input type="submit" name="datauser_submit" value="Submit"></center>
                </div>
            </form> 
            
        </div>

    </div>

</div>
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

    
</script>