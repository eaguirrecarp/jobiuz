<div class="container">
    <div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel2">Change Password</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $attributes = array(
                                            'class'=>'cmxform form-horizontal tasi-form',
                                            'id'=>'signupForm',
                                            'novalidate'=>'novalidate'
                                            );
                    ?>
                    <?php echo form_open('web/user/profile', $attributes); ?>
                        <div>
                            Enter your password:
                            <?= form_password($password_old)?>
                            <br />
                            Enter new password:
                            <?= form_password($password)?>
                            Retry new password:
                            <?= form_password($confirm_password)?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php
                        $submit_bottom = array(
                                                'name'=>'changepass_submit',
                                                'id'=>'changepass_submit',
                                                'value'=>'Change',
                                                'class'=>'btn btn-primary'
                                            ); 
                    ?>
                    <?= form_submit($submit_bottom) ?>
                </div>
                    </form>
            </div>
        </div>
    </div>
</div>