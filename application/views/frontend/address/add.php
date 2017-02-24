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
          <label required>Name</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="Name" />
        </div>
        <div class="form-group  <?php echo (form_error('first_name'))?'error':'';?>" data-error="<?php echo (form_error('first_name'))? form_error('first_name'):'';?>">
          <label required>Firstname</label>
          <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo set_value('first_name', $editdata['first_name']);?>" placeholder="First Name" />
        </div>
        <div class="form-group  <?php echo (form_error('last_name'))?'error':'';?>" data-error="<?php echo (form_error('last_name'))? form_error('last_name'):'';?>">
          <label required>Lastname</label>
          <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo set_value('last_name', $editdata['last_name']);?>" placeholder="Last Name" />
        </div>
        <div class="form-group  <?php echo (form_error('company'))?'error':'';?>" data-error="<?php echo (form_error('company'))? form_error('company'):'';?>">
          <label required>Company</label>
          <input type="text" name="company" class="form-control" id="company" value="<?php echo set_value('company', $editdata['company']);?>" placeholder="Company" />
        </div>
        <div class="form-group  <?php echo (form_error('address1'))?'error':'';?>" data-error="<?php echo (form_error('address1'))? form_error('address1'):'';?>">
          <label required>Address1</label>
          <textarea name="address1" class="form-control" id="address1"><?php echo set_value('address1', $editdata['address1']); ?> </textarea>
        </div>
        <div class="form-group  <?php echo (form_error('address2'))?'error':'';?>" data-error="<?php echo (form_error('address2'))? form_error('address2'):'';?>">
          <label required>Address2</label>
          <textarea name="address2" class="form-control" id="address2"><?php echo set_value('address2', $editdata['address2']); ?> </textarea>
        </div>
        <div class="form-group  <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? form_error('city'):'';?>">
          <label required>City</label>
          <input type="text" name="city" class="form-control" id="city" value="<?php echo set_value('city', $editdata['city']);?>" placeholder="City" />
        </div>
        <div class="form-group  <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? form_error('state'):'';?>">
          <label required>State</label>
          <input type="text" name="state" class="form-control" id="state" value="<?php echo set_value('state', $editdata['state']);?>" placeholder="State" />
        </div>
        <div class="form-group  <?php echo (form_error('country'))?'error':'';?>" data-error="<?php echo (form_error('country'))? form_error('country'):'';?>">
          <label required>Country</label>
          <input type="text" name="country" class="form-control" id="country" value="<?php echo set_value('country', $editdata['country']);?>" placeholder="Country" />
        </div>
        <div class="form-group  <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? form_error('zipcode'):'';?>">
          <label required>Zipcode</label>
          <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?php echo set_value('zipcode', $editdata['zipcode']);?>" placeholder="Zipcode" />
        </div>
        <div class="form-group  <?php echo (form_error('phone'))?'error':'';?>" data-error="<?php echo (form_error('phone'))? form_error('phone'):'';?>">
          <label required>Phonenumber</label>
          <input type="text" name="phone" class="form-control" id="phone" value="<?php echo set_value('phone', $editdata['phone']);?>" placeholder="Phonenumber" />
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
