 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>
  
  <div class="row">
  <form name="category" method="POSt">
      <div class="form-grid col-md-6">
        <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
          <label required>Category Name</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="Category Name" />
        </div>
        <div class="form-group  <?php echo (form_error('description'))?'error':'';?>" data-error="<?php echo (form_error('description'))? form_error('description'):'';?>">
          <label required>Description</label>
          <textarea name="description" class="form-control" id="description"><?php echo set_value('description', $editdata['description']); ?> </textarea>
        </div>
        <div class="form-group <?php echo (form_error('enabled'))?'error':'';?>" data-error="<?php echo (form_error('enabled'))? form_error('enabled'):'';?>">
          <label>Enabled</label>
          <input type="radio" name="enabled" value="1" <?php echo set_radio('enabled', '1', ($editdata['enabled']==1)?TRUE:""); ?> /> Yes
          <input type="radio" name="enabled" value="0" <?php echo set_radio('enabled', '1', ($editdata['enabled']==0)?TRUE:""); ?> /> No
        </div>
        
        <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>" />
        <div class="form-group col-md-2 col-md-offset-8">   
          <input type="reset" class="form-control btn btn-block" value="RESET" />
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">SAVE</button>
        </div>
    </div>
  </form>
</div>  
