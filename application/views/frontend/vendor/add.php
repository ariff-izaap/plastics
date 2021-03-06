 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>
<div class="container add-user1">
  <div class="row">

  <form name="inventorycolor" method="POSt">
  <div class="form-grid col-md-12 panel panel-default panel-bor">
      <div class="panel-heading formcontrol-box">
   
      <div class="form-grid">
        <div class="form-group  <?php echo (form_error('business_name'))?'error':'';?>" data-error="<?php echo (form_error('business_name'))? form_error('business_name'):'';?>">
          <label required class="col-md-3">Business Name</label>
          <input type="text" name="business_name" class="form-control col-md-9" id="business_name" value="<?php echo set_value('business_name', $editdata['business_name']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))? form_error('credit_type'):'';?>">
          <label required class="col-md-3">Credit Type</label>
          <input type="text" name="credit_type" class="form-control col-md-9" id="credit_type" value="<?php echo set_value('credit_type', $editdata['credit_type']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('web_url'))?'error':'';?>" data-error="<?php echo (form_error('web_url'))? form_error('web_url'):'';?>">
          <label required class="col-md-3">Website Url</label>
          <input type="text" name="web_url" class="form-control col-md-9" id="web_url" value="<?php echo set_value('web_url', $editdata['web_url']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('ups'))?'error':'';?>" data-error="<?php echo (form_error('ups'))? form_error('ups'):'';?>">
          <label required class="col-md-3">Ups</label>
          <input type="text" name="ups" class="form-control col-md-9" id="ups" value="<?php echo set_value('ups', $editdata['ups']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
          <label required class="col-md-3">Address</label>
          <select class="form-control col-md-9" name="address_id" id="address_id">
            <option value="">---Select---</option>
               <?php foreach(get_address() as $addr):
                  $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
               ?>
                  <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> >
                     <?php echo $addr['address1'].", ".$addr['city'].", ".$addr['state'].", ".$addr['country'];?>
                  </option>
              <?php endforeach;?>
          </select>
        </div>
        <div class="form-group <?php echo (form_error('status'))?'error':'';?>" data-error="<?php echo (form_error('status'))? form_error('status'):'';?>">
          <label class="col-md-3">Status</label>
          <input type="radio" name="status" value="1" <?php echo set_radio('status', '1', ($editdata['status']==1)?TRUE:""); ?> /> Yes
          <input type="radio" name="status" value="0" <?php echo set_radio('status', '1', ($editdata['status']==0)?TRUE:""); ?> /> No
        </div>
        <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>">
       
    </div>
</div>
</div>
 <div class="form-group col-md-2 col-md-offset-8">   
          <a href="<?php echo site_url('vendor');?>" class="btn btn-block active text-center">Back</a>
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Save</button>
        </div>
  </form>
  </div>

</div>  
