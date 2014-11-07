 <!--Begin Content-->     
<div class="container-fluid">
 <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="background:#fff">
            <form action="<?=site_url('web/employer/profile')?>" method="post">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <label align="left">PROFILE</label> <br>
                         <i class=""><img id="logo-user" src="<?=base_url().'profile/employers/thumbs/'.$result['nombre_archivo']?>" /></i>
                        <button id="btn-upload" class="btn btn-primary btn-xs" type="button">Change/Load your Picture</button>
                    </div>
                    <div class="col-md-8">

                        <div class="message_panel">
                           <?php if (strlen($error) > 0):?>
                            <div id="message_success" class="alert alert-success alert-block fade in" style="display:none">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p><?= $error?></p>
                            </div>
                        <?php endif;?>
                            <div id="message_error" class="alert alert-block alert-danger fade in" style="display:none" >
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="icon-remove"></i>
                                </button>
                                <strong></strong>
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

                        Business Name:
                        <input type="text" name="company_name" value="<?=set_value('company_name',$result['nombre_cuenta'])?>" class="profile" />
                        <?php echo form_error('company_name', '<div class="error">', '</div>'); ?>
                        User name:
                        <input type="text" name="user_name" value="<?=set_value('user_name',$result['email'])?>" class="profile" />
                        <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
                        Responsible (Full Name):
                        <input type="text" name="responsible" value="<?=set_value('responsible',$result['responsable'])?>" class="profile" />
                        <?php echo form_error('responsible', '<div class="error">', '</div>'); ?>
                        NIT:
                        <input type="text" name="nit" value="<?=set_value('nit',$result['nit'])?>" class="profile" />
                        <?php echo form_error('nit', '<div class="error">', '</div>'); ?>
                        Business Web:
                        <input type="text" name="web" value="<?=set_value('web',$result['web'])?>" class="profile" />
                        <?php echo form_error('web', '<div class="error">', '</div>'); ?>
                        Business Phone:
                        <input type="text" name="phone" value="<?=set_value('phone',$result['telefono'])?>" class="profile" />
                        <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                        Description:
                        <textarea name="description" class="profile"><?=set_value('description',$result['descripcion'])?></textarea>
                        <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                        Country:
                        <select name="country" class="profile">
                            <option value="Bolivia">Bolivia</option>
                        </select>
                        <?php echo form_error('country', '<div class="error">', '</div>'); ?>
                        City:
                        <select name="city" class="profile">
                            <option value="Santa Cruz">Santa Cruz</option>
                        </select>
                        <?php echo form_error('city', '<div class="error">', '</div>'); ?>
                        Area:
                        <input type="text" name="area" value="<?=set_value('area',$result['direccion_area'])?>" class="profile" />
                        <?php echo form_error('area', '<div class="error">', '</div>'); ?>
                        Description Address:
                        <textarea name="description_address" class="profile"><?=set_value('description_address',$result['direccion_detalle'])?></textarea>
                        <?php echo form_error('description_address', '<div class="error">', '</div>'); ?>
                        <!--Password:
                        <div class="input-group ">
                            <input type="password" value="<?=$result['password']?>" class="profile" />
                            <span class="input-group-btn">
                                <button data-toggle="modal" href="#changepassModal" class="btn btn-white profile" type="button">Change</button>
                            </span>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>Networks and Notification</h3>
                    <div class="col-md-2">
                        <i class="icon-facebook2 font48"></i>
                    </div>

                    <div class="col-md-8">
                        <p>Use your Facebook account to Login. </p>
                        <p>Publish your activity to your timeline. </p>
                    </div>
                    <div class="col-md-2">
                        <div class="switch has-switch">
                            <div class="switch-on switch-animate">
                                <input type="checkbox" name="connect_facebook" <?=($result['connect_facebook']==1)?"checked":""?> data-toggle="switch">
                                <span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span>
                            </div>
                        </div>
                        <div class="switch has-switch">
                            <div class="switch-on switch-animate">
                                <input type="checkbox" name="publish_timeline_facebook" <?=($result['publish_timeline_facebook']==1)?"checked":""?> data-toggle="switch">
                                <span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span>
                            </div>
                        </div>
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
                    <div class="switch has-switch">
                        <div class="switch-on switch-animate">
                            <input type="checkbox" name="connect_google" <?=($result['connect_google']==1)?"checked":""?> data-toggle="switch">
                            <span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span>
                        </div>
                    </div>
                    <div class="switch has-switch">
                        <div class="switch-on switch-animate">
                            <input type="checkbox" name="publish_hangout_google" <?=($result['publish_hangout_google']==1)?"checked":""?> data-toggle="switch">
                            <span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span>
                        </div>
                    </div>
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
                        <?php echo $gmap['html']; ?>
                        <input type="hidden" id="latitude" name="latitude" value="<?=set_value('latitude',$result['direccion_latitud'])?>">
                        <input type="hidden" id="longitude" name="longitude" value="<?=set_value('longitude',$result['direccion_longitud'])?>">
                        <?php echo form_error('latitude', '<div class="error">', '</div>'); ?> 
                        <?php echo form_error('longitude', '<div class="error">', '</div>'); ?> 
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
    <?php echo $this->load->view('web/modals/changepass_modal'); ?>
    <?php echo $this->load->view('web/modals/delete_modal'); ?>
<script>
$(function() {
        // Botón para subir la firma
        var btn_firma = $('#btn-upload'), interval;
            new AjaxUpload('#btn-upload', {
                action: base_url+'web/job_ajax/upload_image',
                onSubmit : function(file , ext){
                    if (! (ext && /^(jpg|jpeg)$/.test(ext))){
                        // extensiones permitidas
                        alert('Images only allowed extensions .jpg and .jpeg');
                        // cancela upload
                        return false;
                    } else {
                        //$('#loaderAjax').show();
                        btn_firma.text('Wait please...');
                        this.disable();
                    }
                },
                onComplete: function(file, response){

                    // alert(response);
                    btn_firma.text('Change/Load your Picture');
                    
                    respuesta = $.parseJSON(response);
                    console.log(respuesta.error);
                    console.log(respuesta.message);
                    console.log(respuesta.filename);
                    if(respuesta.error == 0)
                    {
                        $('#logo-user').removeAttr('scr');
                        $('#logo-user').attr('src',base_url+'profile/employers/thumbs/' + respuesta.filename);
                        //$('#loaderAjax').show();
                        alert(respuesta.mensaje);
                    }
                    else
                    {
                        alert(respuesta.message);
                    }
                        
                    //$('#loaderAjax').hide();    
                    this.enable();  
                }
        });
    });
</script>
</div>
<!--End Content-->