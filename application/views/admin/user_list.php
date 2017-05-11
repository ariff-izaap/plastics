     
  <div class="row blue-mat">
  	<div class="col-md-12 padding-zero">
      <div class="col-md-6 breadcrumbs">
        <?php echo set_breadcrumb(); ?>
      </div>
      <div class="col-md-6 action-buttons text-right">
        <!-- <a href="javascript:void(0)" class="btn active">Delete</a> -->
        <?php if($this->action->create==1){?>
          <a href="<?php echo site_url('admin/add_edit_user');?>" class="btn btn-success role" capsOn><i class="fa fa-plus"></i>Create User</a>
        <?php }?>
      </div>
    </div>
  </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
  <?=$grid;?>
    
  