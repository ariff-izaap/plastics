 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="inventorycolor" method="POSt">

      <div class="form-grid col-md-6">
        
        <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
          <label required></label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="" />
        </div>

      
        <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>">

        <div class="form-group col-md-2 col-md-offset-8">   
          <a href="<?php echo site_url('vendor');?>" class="btn btn-block active text-center">Back</a>
        </div>
        
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Save</button>
        </div>
    
    </div>

  </form>

</div>  
