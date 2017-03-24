 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="checkout" id="checkout" method="POST">
      <div class="form-grid col-md-6">
        <div class="form-group  <?php echo (form_error('business_name'))?'error':'';?>" data-error="<?php echo (form_error('business_name'))? form_error('business_name'):'';?>">
          <label required>Customer Name</label>
          <select name="customer_name" id="customer_id" onchange="get_customer_details();">
            <option value="">Select Customer</option>
            <?php if(count($customer)>0){
                foreach($customer as $ckey=>$cvalue){ ?>
                  <option value="<?php echo $cvalue['id'];?>"><?php echo $cvalue['business_name']; ?></option>  
               <?php }} ?>
          </select>
        </div>
       <div id="customer_details_view" class="col-md-12"> 
        <?php $this->load->view("frontend/sales/customer_details",$this->data);?>
       </div>
       <h2>Shipping Information</h2>
       <div class="form-grid col-md-12">
        
        <div class="form-group col-md-6  <?php echo (form_error('ship_first_name'))?'error':'';?>" data-error="<?php echo (form_error('ship_first_name'))? form_error('ship_first_name'):'';?>">
          <label required>first_name</label>
          <input type="text" name="ship_first_name" class="form-control" id="ship_first_name" value="<?php echo set_value('ship_first_name', $customer_ship_data['first_name']);?>" placeholder="" />
        </div>
        <div class="form-group col-md-6 <?php echo (form_error('ship_last_name'))?'error':'';?>" data-error="<?php echo (form_error('ship_last_name'))? form_error('ship_last_name'):'';?>">
          <label required>last_name</label>
          <input type="text" name="ship_last_name" class="form-control" id="ship_last_name" value="<?php echo set_value('ship_last_name', $customer_ship_data['last_name']);?>" placeholder="" />
        </div>
        <div class="form-group <?php echo (form_error('ship_mobile'))?'error':'';?>" data-error="<?php echo (form_error('ship_mobile'))? form_error('ship_mobile'):'';?>">
          <label required>Mobile</label>
          <input type="text" name="ship_mobile" class="form-control" id="ship_mobile" value="<?php echo set_value('ship_mobile', $customer_ship_data['mobile']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('ship_address1'))?'error':'';?>" data-error="<?php echo (form_error('ship_address1'))? form_error('ship_address1'):'';?>">
          <label required>Address 1</label>
          <textarea name="ship_address1" class="form-control" id="ship_address1"><?php echo $customer_ship_data['address1'];?> </textarea>
        </div>
        <div class="form-group " >
          <label required>Address 2</label>
          <textarea name="ship_address2" class="form-control" id="ship_address2" ><?php echo $customer_ship_data['address2'];?></textarea>
        </div>
        <div class="form-group  <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? form_error('ship_city'):'';?>">
          <label required>City</label>
          <input type="text" name="ship_city" class="form-control" id="ship_city" value="<?php echo set_value('ship_city', $customer_ship_data['city']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('ship_state'))?'error':'';?>" data-error="<?php echo (form_error('ship_state'))? form_error('ship_state'):'';?>">
          <label required>State</label>
          <input type="text" name="ship_state" class="form-control" id="ship_state" value="<?php echo set_value('ship_state', $customer_ship_data['state']);?>" placeholder="" />
        </div>
        <div class="form-group  <?php echo (form_error('ship_zipcode'))?'error':'';?>" data-error="<?php echo (form_error('ship_zipcode'))? form_error('ship_zipcode'):'';?>">
          <label >Zipcode</label>
          <input type="text" name="ship_zipcode" class="form-control" id="ship_zipcode" value="<?php echo set_value('ship_zipcode', $customer_ship_data['zipcode']);?>" placeholder="" />
        </div>
    </div>
    
    <h2>Cart Items</h2>
   <div class="form-grid col-md-12">
     <?php $this->load->view("frontend/salesproductselection/cart_items",$this->data); ?>
   </div>
  
  <div>
    <button name="create_so" class="btn btn-default">Create Order</button>
  </div>  
  </form>

</div>  
