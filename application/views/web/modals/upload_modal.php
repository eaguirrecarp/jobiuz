<div class="container">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Change Picture</h4>
        </div>
        <div class="modal-body">
                <!-- <div >
                        <?php if (isset($images) && count($images)):
                            foreach($images as $image): ?>
                            <div class="thumb">
                                <a href="<?php echo $image['url']; ?>">
                                    <img src="<?php echo $image['thumb_url']; ?>" />
                                </a>                
                            </div>
                        <?php endforeach; else: ?>
                            <div id="blank_gallery">Please Upload an Image</div>
                        <?php endif; ?>
                    </div> -->
                <?php
                    $attributes = array(
                                        'name'=>'upload_file',
                                        'id'=>'upload_file'
                                        );
                ?>
                <?= form_open_multipart('web/user/profile', $attributes)?>
                    <div >
                        <?= form_upload('userfile')?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?= form_submit('upload', 'Upload', 'class="btn btn-primary"') ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>