 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="inventoryform" method="POST">

      <div class="form-grid col-md-6">
        
        <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
          <label required>Package</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="Form Name" />
        </div>

        <div class="form-group <?php echo (form_error('status'))?'error':'';?>" data-error="<?php echo (form_error('status'))? form_error('status'):'';?>">
          <label>Status</label>
          <input type="radio" name="status" value="1" <?php echo set_radio('status', '1', ($editdata['status']==1)?TRUE:""); ?> /> Yes
          <input type="radio" name="status" value="0" <?php echo set_radio('status', '1', ($editdata['status']==0)?TRUE:""); ?> /> No
        </div>

        <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>">

        <div class="form-group col-md-2 col-md-offset-8">   
          <a href="<?php echo site_url('inventoryform');?>" class="btn btn-block active text-center">Back</a>
        </div>
        
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Save</button>
        </div>
    
    </div>

  </form>

</div>  
