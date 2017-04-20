     
  <div class="row blue-mat">
      <div class="breadcrumbs col-md-6">
        <?php echo set_breadcrumb(); ?>
        <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
      </div>
      <div class="col-md-6 action-buttons text-right">
        <a href="javascript:void(0)" class="btn active" capsOn>Delete</a>
        <!--
<button type="button" class="btn" onclick="inventory_sub();">Create Inventory</button>
-->
        
<a class="btn active" onclick="inventory_sub('create','');" >Create Inventory</a>

    </div>
  </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
    
  <?php echo $grid;?>
  
   <div id="inventory_form" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="modal_close();">&times;</button>
      </div>
      
      <div class="modal-body">
      
     </div>  
     
     
    </div>
  </div>
</div>