 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="organization" method="POSt">

      <div class="form-grid">
        
        <div class="form-group col-md-4 <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
          <label required>Inventory Name</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="ABC(pvt)Ltd">
        </div>

        <div class="form-group col-md-4 <?php echo (form_error('short_name'))?'error':'';?>" data-error="<?php echo (form_error('short_name'))? form_error('short_name'):'';?>">
          <label required>Short Name</label>
          <input type="text" name="short_name" class="form-control" id="short_name" value="<?php echo set_value('short_name', $editdata['short_name']);?>" placeholder="Short Name">
        </div>

        <div class="form-group col-md-4 <?php echo (form_error('registration_no'))?'error':'';?>" data-error="<?php echo (form_error('registration_no'))? form_error('registration_no'):'';?>">
          <label>Registration Number</label>
          <input type="text" name="registration_no" class="form-control" id="registration_no" value="<?php echo set_value('registration_no', $editdata['registration_no']);?>" placeholder="Registration Number">
        </div>

        <div class="form-group col-md-4 <?php echo (form_error('org_type'))?'error':'';?>" data-error="<?php echo (form_error('org_type'))? form_error('org_type'):'';?>">
          <label required>Inventory Type</label>
          <select class="form-control" name="org_type" id="org_type">
            <option value="">---Select---</option>
               <?php foreach($org_types as $type):
                    $sel = ($type['id'] == set_value('org_type', $editdata['org_type']))?'selected':'';
               ?>
                <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
               <?php endforeach;?>
          </select>
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? form_error('email'):'';?>">
          <label required>Email Address</label>
          <input type="text" name="email" class="form-control" id="email" value="<?php echo set_value('email', $editdata['email']);?>" placeholder="Email Address">
        </div>
        

        <div class="form-group col-md-4 <?php echo (form_error('phone'))?'error':'';?>" data-error="<?php echo (form_error('phone'))? form_error('phone'):'';?>">
          <label required>Phone</label>
          <input type="text" name="phone" class="form-control" id="phone" value="<?php echo set_value('phone', $editdata['phone']);?>" placeholder="Phone">
        </div>
        
        <div class="form-group col-md-4 <?php echo (form_error('fax'))?'error':'';?>" data-error="<?php echo (form_error('fax'))? form_error('fax'):'';?>">
          <label>Fax</label>
          <input type="text" name="fax" class="form-control" id="fax" value="<?php echo set_value('fax', $editdata['fax']);?>" placeholder="Fax">
        </div>
        
        <div class="form-group col-md-6 <?php echo (form_error('address'))?'error':'';?>" data-error="<?php echo (form_error('address'))? form_error('address'):'';?>">
          <label required>Address</label>
          <textarea class="form-control" name="address" id="address" rows="5" placeholder="Detailed Address"><?php echo set_value('address', $editdata['address']);?></textarea>
        </div>
        
        
        <div class="form-group col-md-6 <?php echo (form_error('note'))?'error':'';?>" data-error="<?php echo (form_error('note'))? form_error('note'):'';?>">
          <label>Note</label>
          <textarea class="form-control" name="note" rows="5" placeholder="Additional info if any" id="note"><?php echo set_value('note', $editdata['note']);?></textarea>
        </div>

        <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>">

        <div class="form-group col-md-2 col-md-offset-8">   
          <a href="<?php echo site_url('inventory');?>" class="btn btn-block active text-center">Back</a>
        </div>
        
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Save</button>
        </div>
    
    </div>

  </form>

</div>  
