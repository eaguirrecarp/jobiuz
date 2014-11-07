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

    <script type="text/javascript">
        var centreGot = false;
    </script>
    <?=$map['js'];?>

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
                                    <a class="menudown"><i class="icon-ellipsis"></i></a>
                                 </h1>
                            </div>
                              
                              <div class="col-md-2">  
                                    <h1 class="font27">
                                    <a class="menudown"><i class="icon-paperclip"></i></a>
                                    <a class="menudown"><i class="icon-vcard"></i></a>
                                    <a class="menudown"><i class="icon-pencil"></i></a>
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
            <div class="col-md-12">
                <div class="col-md-2">
                    <img src="<?=$result['picture']?>" class="img-circle userpictureloc font30">
                </div>
                <div>
                    <span ><?=$map['company_name']?> <br><?=$map['responsible']?> / <?=$map['email']?> </span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="map">
                        <?php echo $map['html']; ?>
                    </div>
                    <div class="rowcolor2">
                        <p><?=$map['message']?> <br> $us. <?=$map['wage']?>.-/<?=$map['time_day_initial']?> to <?=$map['time_day_end']?> <?=$map['schedule_time_initial']?> - <?=$map['schedule_time_end']?>  </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding: 30px 0 30px 0;">
                <div class="col-md-2"></div>
                <div class="list-group ">
                    <div class="col-md-8 list-group-item ">
                        <div class="col-md-1 ">
                            <div class="font27 icon-location"></div>
                            <div class="font27 icon-paperclip"></div>
                            <div class="font27 icon-chat"></div>
                        </div>
                        <div class="col-md-7 ">
                            <p class="list-group-item-text" style="padding: 0 0 4px 0;font-weight:bold;">Company name</p>
                            <p class="list-group-item-text">Text</p>
                            <p class="list-group-item-text">Salary</p>
                            <p class="list-group-item-text">Time</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
       </div>

        </div>

    </div>
</body>
</html>
