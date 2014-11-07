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
    <?php
      if(isset($gmap))
      {
          foreach ($gmap as $value) {
            echo $value['js'];
          }
      }

    ?>

</head>
<body>
<!--Begin Menu-->
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
                                 <a class="menuup"><i class="icon-house"></i></a>
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
<!--End Menu-->
<!-- Row Nombre Menu 1  Menu 2  Config --> 
<!--Begin Content-->     
    <div class="container-fluid">

        <div class="row">
       
        <div class="container" style="background:#ffffff" >

        <div><br></div>
        <div><br> </div>
            <?php
              if(isset($gmap))
              {
                $j=1;
                foreach ($gmap as $value)
                {
                ?>
                  <div class="col-md-4">
                  <div class="rowcolor">
                  <img src="<?=$result['picture']?>" class="img-circle userpictureloc font30">
                  <span class="titulo2"><?=$value['company_name']?> <br><?=$value['responsible']?> / <?=$value['email']?> </span>
                  </div>
                  <div class="map"><?php echo $value['html']; ?></div>
                  <div class="rowcolor2"><p><?=$value['message']?> <br> $us. <?=$value['wage']?>.-/<?=$value['time_day_initial']?> to <?=$value['time_day_end']?> <?=$value['schedule_time_initial']?> - <?=$value['schedule_time_end']?>  </p> </div>
                  </div>

                <?php
                  if($j==3)
                  {
                ?>
                    <div class="col-md-12" style="height:50px;"></div>
                <?php
                  }
                $j++;
                }
              }
              else
              {
                for ($i=0; $i < 6 ; $i++)
                { 
                ?>
                  <div class="col-md-4">
                  <div class="rowcolor">
                  <img src="<?=$result['picture']?>" class="img-circle userpictureloc font30">
                  <span class="titulo2">Nombre empresa <br>Responsable / mail@gmail.com </span>
                  </div>
                  <div class="map"></div>
                  <div class="rowcolor2"><p>Se necesita empleado para realizar<br> labores de trabajo. <br> Bs. 800.-/Lun a Vie 8:00 - 18:00  </p> </div>
                  </div>

                <?php
                  if($i==2)
                  {
                ?>
                    <div class="col-md-12" style="height:50px;"></div>
                <?php
                  }
                }
              }
            ?>
            <div class="col-md-4"> <br><br></div>
            <div class="col-md-4"><br><br></div>

       </div>

        </div>

    </div>
<!--End Content-->
<!--Begin Footer-->
</body>
</html>

<script type="text/javascript">

 
    
</script>
<!--End Footer-->