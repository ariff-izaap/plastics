
<div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm btn-danger pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>
  <div class="container">
  <div class="row">
  <form name="checkout" id="checkout" method="POST" action="<?php echo site_url();?>salesorder/checkout">
    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo (isset($editdata['id']) && !empty($editdata['id']))?$editdata['id']:""; ?>" />
      <div class="form-grid col-md-12">
        <div class="form-group col-md-4 <?php echo (form_error('customer_id'))?'error':'';?>" data-error="<?php echo (form_error('customer_id'))? form_error('customer_id'):'';?>" style="margin-left:14px;">
          <label required>Customer Name</label>
          <select name="customer_id" id="customer_id" onchange="get_customer_details(<?php echo $this->uri->segment(3);?>);" >
            <option value="">Select Customer</option>
            <?php if(count($customer)>0){
                foreach($customer as $ckey=>$cvalue){ ?>
                  <option value="<?php echo $cvalue['id'];?>" <?php echo set_select('customer_id',$cvalue['id'],(($editdata['customer_id'] == $cvalue['id'])?true:false));?>><?php echo $cvalue['business_name']; ?></option>  
               <?php }} ?>
          </select>
        </div>
       <div id="customer_details_view" class="col-md-8"> 
        <?php $this->load->view("frontend/sales/customer_details",$this->data);?>
        
       </div>
       <div class="form-grid col-md-4 panel panel-default panel-bor">
<div class="panel-heading formcontrol-box ship-details">
    
   <!--
<div class="form-group <?php //echo (form_error('type'))?'error':'';?>" data-error="<?php //echo (form_error('type'))? form_error('type'):'';?>" >
      <label>Type</label>
      <select name="type" class="form-group" >
        <option value="">Select Type</option>
         <?php //if(count($saletype)>0){
               // foreach($saletype as $tkey=>$tvalue){ ?>
                  <option value="<?php //echo $tvalue['name'];?>" <?php //echo set_select('type',$tvalue['name'],(($editdata['type'] == $tvalue['name'])?true:false));?>><?php //echo $tvalue['name']; ?></option>  
         <?php //}} ?>
      </select>
    </div>
-->

   <div style="margin-bottom:0px;" class="form-group <?php echo (form_error('shipping_type'))?'error':'';?>" data-error="<?php echo (form_error('shipping_type'))? form_error('shipping_type'):'';?>">
      <label>Shipping Type</label>
      <select name="shipping_type" class="form-group">
        <option value="">Select Shipping Type</option>
        <?php if(count($shipping_type)>0){ foreach($shipping_type as $skey => $svalue){ ?>
         <option value="<?php echo $svalue['id']; ?>" <?php echo set_select('shipping_type',$svalue['id'],(($editdata['shipping_type'] == $svalue['id'])?true:false));?>><?php echo $svalue['type']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div style="margin-bottom:0px;" class="form-group <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))?form_error('credit_type'):'';?>" >
      <select name="credit_type" class="form-group">
        <option value="">Select Credit Type</option>
        <?php if(count($credit_type)>0){ foreach($credit_type as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('credit_type',$cvalue['id'],(($editdata['credit_type'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <!--
<div class="form-group <?php //echo (form_error('carrier'))?'error':'';?>" data-error="<?php// echo (form_error('carrier'))?form_error('carrier'):'';?>" >
      <label>Carrier</label>
      <select name="carrier" class="form-group">
        <option value="">Select Carrier</option>
        <?php //if(count($carrier)>0){ foreach($carrier as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php //echo set_select('carrier',$cvalue['id'],(($editdata['carrier'] == $cvalue['id'])?true:false));?> ><?php //echo $cvalue['name']; ?></option>
        <?php //}} ?>
      </select>
    </div>

    
    <div class="form-group <?php //echo (form_error('order_status'))?'error':'';?>" data-error="<?php //echo (form_error('order_status'))? form_error('order_status'):'';?>" >
      <label>Order Status</label>
      <select name="order_status" class="form-group" >
        <option value="">Select Status</option>
         <option value="NEW" <?php //echo set_select('order_status',"NEW",(($editdata['order_status'] == "NEW")?true:false));?>>NEW</option>
         <option value="PROCESSING" <?php //echo set_select('order_status',"PROCESSING",(($editdata['order_status'] == "PROCESSING")?true:false));?>>PROCESSING</option>
         <option value="PENDING" <?php //echo set_select('order_status',"PENDING",(($editdata['order_status'] == "PENDING")?true:false));?>>PENDING</option>
         <option value="COMPLETED" <?php //echo set_select('order_status',"COMPLETED",(($editdata['order_status'] == "COMPLETED")?true:false));?>>COMPLETED</option>
      </select>
    </div> -->
    <div class="ship-col">
    <div class="form-group" >
     <label>COD Fee</label>
      <input type="text" name="cod_fee" onkeypress="return numbersonly(event);" value="<?php echo set_value('cod_fee',$editdata['cod_fee']);?>" id="cod_fee" placeholder="COD Fee"  />
    </div>
    
    <div class="form-group" >
      <label>Freight Paid</label>
      <input type="text" name="freight_paid" id="freight_paid" value="<?php echo set_value('freight_paid',$editdata['freight_paid']);?>" placeholder="Freight Paid" />
    </div>
    
    <div class="form-group" >
      <label>Amount</label>
      <input type="text" name="amount" id="amount" onkeypress="return numbersonly(event);" value="<?php echo set_value('amount',$editdata['amount']);?>" placeholder="Amount" />
    </div>
    <div class="form-group" >
      <label>Add Amount</label>
      <input type="text" name="add_amount" id="add_amount" onkeypress="return numbersonly(event);" value="<?php echo set_value('add_amount',$editdata['add_amount']);?>" placeholder="Add Amount" />
    </div>
    </div>
    
    <div class="form-group" style="margin-bottom:10px !important" >
      <textarea name="so_instructions" class="form-control" placeholder="SO Instructions"><?php echo set_value('so_instructions',$editdata['so_instructions']); ?></textarea>
    </div>
    <div class="form-group" style="margin-bottom:10px !important">     
      <textarea class="form-control" name="bol_instructions" placeholder="BOL Instructions"><?php echo set_value('bol_instructions',$editdata['bol_instructions']); ?></textarea>
    </div>
  </div>
  </div>
      
</div> 


  <div class="form-group">  
   <div class="col-md-2 cart-btn" style="margin-bottom:10px;float:right;" >
    <a href="<?php echo base_url(); ?>/salesproductselection" class="btn btn-info"  >Continue Shopping</a>
   </div>
     <div >  
      <button type="button" class="btn pull-right btn-warning" onclick="sales_update_cart('form','cartitem','cart','',this)"><i class="fa fa-edit edit"></i>Edit Cart</button>
   </div>
  </div> 

   <div class="form-group" id="cartItems">

     <?php $this->load->view("frontend/salesproductselection/cart_items",$this->data); ?>
   </div>
  
   <div class="col-md-6" style="margin-bottom:20px; float:right">
    <input type="submit" name="so" class="btn btn-primary btn-lg" value="<?php echo (isset($editdata['btn']))?$editdata['btn']:""; ?>" />
  </div>

  </form> 
  
  </div>
  </div>