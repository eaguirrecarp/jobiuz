<div class="container">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Delete Account</h4>
        </div>
        <div class="modal-body">

                <?php
                    $attributes = array(
                                        'name'=>'delete_account',
                                        'id'=>'delete_account'
                                        );
                ?>
                <?= form_open('web/user/delete', $attributes)?>
                    <div >
                        Are you sure you want to delete this account?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?= form_submit('delete', 'Delete', 'class="btn btn-primary"') ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>