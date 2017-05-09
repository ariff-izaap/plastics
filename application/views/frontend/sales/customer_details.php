<div class="clearfix"></div>   
    
	<?php if(isset($customer_data['status']) && ($customer_data['status'] == 'new')){ ?>
        
        <div class="form-group customer_valid" >
           For this customer no address so you should create create.
          <h6><a href="<?php echo site_url();?>salesorder/add_edit_customer?redirect=<?php echo $this->uri->segment(3);?>">Create Customer</a></h6>
        </div>
        <div class="clearfix"></div>
    <?php } ?>
   <?php // else
   // { ?>
      <input type="hidden" name="shipping_address_id" value="<?php echo $customer_data['shipping_id'];  ?>" />
      <input type="hidden" name="billing_address_id" value="<?php echo $customer_data['billing_id'];  ?>" />
      <div class="form-grid col-md-6 panel panel-default panel-bor">
      	<div class="panel-heading formcontrol-box billing-name">
      <div class="form-grid">
      <h2>Billing Information</h2>
        <div class="form-group  <?php echo (form_error('business_name'))?'error':'';?>" data-error="<?php echo (form_error('business_name'))? form_error('business_name'):'';?>">
        
          <input type="text" name="business_name" class="form-control" id="business_name" value="<?php echo set_value('business_name', $customer_data['business_name']);?>" placeholder="Business Name" />
        </div>
        <div class="form-group <?php echo (form_error('first_name'))?'error':'';?>" data-error="<?php echo (form_error('first_name'))? form_error('first_name'):'';?>">
        
          <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo set_value('first_name', $customer_data['first_name']);?>" placeholder="Firstname" />
        </div>
        <div class="form-group <?php echo (form_error('last_name'))?'error':'';?>" data-error="<?php echo (form_error('last_name'))? form_error('last_name'):'';?>">
      
          <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo set_value('last_name', $customer_data['last_name']);?>" placeholder="Lastname" />
        </div>
        <div class="form-group <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? form_error('email'):'';?>">
          
          <input type="text" name="email" class="form-control" id="email" value="<?php echo set_value('email', $customer_data['email']);?>" placeholder="Email" />
        </div>
        <div class="form-group  " >
       
          <input type="text" name="web_url" class="form-control" id="web_url" value="<?php echo set_value('web_url', $customer_data['web_url']);?>" placeholder="Website Url" />
        </div>
        <div class="form-group <?php echo (form_error('mobile'))?'error':'';?>" data-error="<?php echo (form_error('mobile'))? form_error('mobile'):'';?>">
        
          <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo set_value('mobile', $customer_data['phone']);?>" placeholder="Mobile" />
        </div>
        <div class="form-group  <?php echo (form_error('address1'))?'error':'';?>" data-error="<?php echo (form_error('address1'))? form_error('address1'):'';?>">
         
          <textarea name="address1" class="form-control" id="address1" placeholder="Address 1"><?php echo set_value('address1', $customer_data['address1']); ?></textarea>
        </div>
        <div class="form-group  <?php echo (form_error('web_url'))?'error':'';?>" >
          
          <textarea name="address2" class="form-control" id="address2" placeholder="Address 2"><?php echo $customer_data['address2'];?></textarea>
        </div>
        <div class="form-group  <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? form_error('city'):'';?>">
         
          <input type="text" name="city" class="form-control" id="city" value="<?php echo set_value('city', $customer_data['city']);?>" placeholder="City" />
        </div>
        <div class="form-group  <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? form_error('state'):'';?>">
          
          <input type="text" name="state" class="form-control" id="state" value="<?php echo set_value('state', $customer_data['state']);?>" placeholder="State" />
        </div>
        <div class="form-group  <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? form_error('zipcode'):'';?>">
         
          <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?php echo set_value('zipcode', $customer_data['zipcode']);?>" placeholder="Zipcode" />
        </div>
      </div>  
      </div> 
      </div>
      
      <div class="form-grid col-md-6 panel panel-default panel-bor">
      	<div class="panel-heading formcontrol-box shipping-name">
       
       <div class="form-grid">
       <h2>Shipping Information</h2>
        <?php $ship_first_name = explode(" ",$customer_data['loc_name']); ?>
        <div class="form-group <?php echo (form_error('ship_first_name'))?'error':'';?>" data-error="<?php echo (form_error('ship_first_name'))? form_error('ship_first_name'):'';?>">
          
          <input type="text" name="ship_first_name" class="form-control" id="ship_first_name" value="<?php echo set_value('ship_first_name', $ship_first_name[0]);?>" placeholder="Firstname" />
        </div>
        <div class="form-group <?php echo (form_error('ship_last_name'))?'error':'';?>" data-error="<?php echo (form_error('ship_last_name'))? form_error('ship_last_name'):'';?>">
         
          <input type="text" name="ship_last_name" class="form-control" id="ship_last_name" value="<?php echo set_value('ship_last_name', $ship_first_name[1]);?>" placeholder="Lastname" />
        </div>
        <div class="ship-mobile form-group <?php echo (form_error('ship_mobile'))?'error':'';?>" data-error="<?php echo (form_error('ship_mobile'))? form_error('ship_mobile'):'';?>">
         
          <input type="text" name="ship_mobile" class="form-control" id="ship_mobile" value="<?php echo set_value('ship_mobile', $customer_data['mobile']);?>" placeholder="Mobile" />
        </div>
		<div class="form-group <?php echo (form_error('ship_address1'))?'error':'';?>" data-error="<?php echo (form_error('ship_address1'))? form_error('ship_address1'):'';?>">
          
          <textarea name="ship_address1" class="form-control" id="ship_address1" placeholder="Address 1"><?php echo set_value('address1', $customer_data['ship_address1']); ?></textarea>
        </div> 
               
        <div class="form-group " >
          
          <textarea name="ship_address2" class="form-control" id="ship_address2" placeholder="Address 2"><?php echo $customer_data['ship_address2'];?></textarea>
        </div>
        
        <div class="form-group  <?php echo (form_error('ship_city'))?'error':'';?>" data-error="<?php echo (form_error('ship_city'))? form_error('ship_city'):'';?>">
         
          <input type="text" name="ship_city" class="form-control" id="ship_city" value="<?php echo set_value('ship_city', $customer_data['city']);?>" placeholder="City" />
        </div>
        <div class="form-group  <?php echo (form_error('ship_state'))?'error':'';?>" data-error="<?php echo (form_error('ship_state'))? form_error('ship_state'):'';?>">
          
          <input type="text" name="ship_state" class="form-control" id="ship_state" value="<?php echo set_value('ship_state', $customer_data['state']);?>" placeholder="State" />
        </div>
        <div class="form-group  <?php echo (form_error('ship_zipcode'))?'error':'';?>" data-error="<?php echo (form_error('ship_zipcode'))? form_error('ship_zipcode'):'';?>">
          
          <input type="text" name="ship_zipcode" class="form-control" id="ship_zipcode" value="<?php echo set_value('ship_zipcode', $customer_data['zipcode']);?>" placeholder="Zipcode" />
        </div>
    </div> 
    </div>
    </div>
   <?php //} ?> 