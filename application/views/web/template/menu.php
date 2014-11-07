<!--Begin Content-->
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
                                 <a href="<?=$this->session->userdata("user_name") == 1 ? site_url('web/user/profile') : site_url('web/employer/profile')?>" class="menuup"><i class="icon-user"></i></a>
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
                            <div class="col-md-1"> <img src="<?=base_url().'profile/employers/thumbs/'.$this->session->userdata('user_logo');?>" class="img-circle userpicture font27"></div>
                            <div class="col-md-2 font27"><h3><?=$this->session->userdata("user_name");?>&nbsp;&nbsp;&nbsp;<a href="<?= $this->session->userdata("user_name") == 1 ? site_url('web/user/logout') : site_url('web/employer/logout')?>">Logout</a></h3> </div>
                                                         
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