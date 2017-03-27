  <div class="row blue-mat">
      <div class="breadcrumbs col-md-6">
        <?php echo set_breadcrumb(); ?>
        <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
      </div>
      <div class="col-md-6 action-buttons text-right">
       
    </div>
  </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
    
    <div id="popOverBox" style="display: block;"></div>
    
 
  <?php echo $grid; ?>
  
      
</div>  
