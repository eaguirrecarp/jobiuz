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
                  <img src="<?=$logo_business;?>" class="img-circle userpictureloc font30">
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
                  <img src="<?=$logo_business;?>" class="img-circle userpictureloc font30">
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