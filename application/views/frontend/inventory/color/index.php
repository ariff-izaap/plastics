     
  <div class="row blue-mat">
      <div class="breadcrumbs col-md-6">
        <?php echo set_breadcrumb(); ?>
        <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
      </div>
      <div class="col-md-6 action-buttons text-right">
        <a href="javascript:void(0)" class="btn active" capsOn>Delete</a>
        <a href="<?php echo site_url('inventorycolor/add');?>" class="btn" capsOn>Create Color</a>
    </div>
  </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
    
  <?php echo $grid;?>