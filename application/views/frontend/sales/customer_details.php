<h2>Billing Information</h2>   
    
      <div class="form-grid col-md-6">
        <div class="form-group  <?php echo (form_error('business_name'))?'error':'';?>" data-error="<?php echo (form_error('business_name'))? form_error('business_name'):'';?>">
          <label required>Business Name</label>
          <input type="text" name="business_name" class="form-control" id="business_name" value="<?php echo set_value('business_name', $customer_data['business_name']);?>" placeholder="" />
        </div>
        <div class="form-group col-md-6  <?php echo (form_error('firs_tname'))?'error':'';?>" data-error="<?php echo (form_error('first_name'))? form_error('first_name'):'';?>">
          <label required>first_name</label>
          <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo set_value('first_name', $customer_data['first_name']);?>" placeholder="" />
        </div>
        <div class="form-group col-md-6 <?php echo (form_error('last_name'))?'error':'';?>" data-error="<?php echo (form_error('last_name'))? form_error('last_name'):'';?>">
          <label required>last_name</label>
          <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo set_value('last_name', $customer_data['last_name']);?>" placeholder="" />
        </div>
        <div class="form-group <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? form_error('email'):'';?>">
          <label required>Email</label>
          <input type="text" name="email" class="form-control" id="email" value="<?php echo set_value('email', $customer_data['email']);?>" placeholder="" />
        </div>
        <div class="form-group  " >
          <label >Website Url</label>
          <input type="text" name="web_url" class="form-control" id="web_url" value="<?php echo set_value('web_url', $customer_data['web_url']);?>" placeholder="" />
        </div>
        <div class="form-group <?php echo (form_error('mobile'))?'error':'';?>" data-error="<?php echo (form_error('mobile'))? form_error('mobile'):'';?>">
          <label required>Mobile</label>
          <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo set_value('mobile', $customer_data['mobile']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('address1'))?'error':'';?>" data-error="<?php echo (form_error('address1'))? form_error('address1'):'';?>">
          <label required>Address 1</label>
          <textarea name="address1" class="form-control" id="address1"><?php echo $customer_data['address1'];?> </textarea>
        </div>
        <div class="form-group  <?php echo (form_error('web_url'))?'error':'';?>" >
          <label required>Address 2</label>
          <textarea name="address2" class="form-control" id="address2" ><?php echo $customer_data['address2'];?></textarea>
        </div>
        <div class="form-group  <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? form_error('city'):'';?>">
          <label required>City</label>
          <input type="text" name="city" class="form-control" id="city" value="<?php echo set_value('city', $customer_data['city']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? form_error('state'):'';?>">
          <label required>State</label>
          <input type="text" name="state" class="form-control" id="state" value="<?php echo set_value('state', $customer_data['state']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? form_error('zipcode'):'';?>">
          <label >Zipcode</label>
          <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?php echo set_value('zipcode', $customer_data['zipcode']);?>" placeholder="" />
        </div>
    </div>