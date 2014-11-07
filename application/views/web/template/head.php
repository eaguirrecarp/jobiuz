<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobiuz</title>

    <link href="<?=base_url().'template/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?=base_url().'template/css/style.css'?>" rel="stylesheet">
    <link href="<?=base_url().'template/css/maps.css'?>" rel="stylesheet">
    <script src="<?=base_url().'template/js/jquery.min.js'?>"></script>
    <script src="<?=base_url().'template/js/bootstrap.min.js'?>"></script>
    <script src="<?=base_url().'template/js/jquery.js'?>"></script>
    <script src="<?=base_url().'template/js/jquery-ui.js'?>"></script>
    <script src="<?=base_url().'template/js/jquery-ui.min.js'?>"></script>
    <!--Load script file js -->
    <?php 
         if (isset($scripts) && count($scripts) > 0)
         {
            foreach ($scripts as $script) 
            {
                echo '<script src="'.base_url().$script.'"></script>';
            }
         } 
    ?>
    <!--Load stylesheet-->
    <?php 
         if (isset($styles) && count($styles) > 0)
         {
            foreach ($styles as $style) 
            {
                echo '<link href="'.base_url().$style.'" rel="stylesheet">';
            }
         } 
    ?>
    <script type="text/javascript">
        var centreGot = false;
        var base_url = "<?php echo base_url();?>";
    </script>
    <?php
      if(isset($gmap))
      {
        if (count($gmap) > 3)
        {
          foreach ($gmap as $value) 
          {
            echo $value['js'];
          }
        }
        else
        {
          echo $gmap['js'];
        }
      }

    ?>

</head>
<body>