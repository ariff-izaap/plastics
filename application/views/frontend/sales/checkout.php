 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>
<?php //print_r($editdata); ?>
  <div class="row">

  <form name="checkout" id="checkout" method="POST" action="<?php echo site_url();?>salesorder/checkout">
    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo (isset($editdata['id']) && !empty($editdata['id']))?$editdata['id']:""; ?>" />
      <div class="form-grid col-md-8">
        <div class="form-group col-md-6 <?php echo (form_error('customer_id'))?'error':'';?>" data-error="<?php echo (form_error('customer_id'))? form_error('customer_id'):'';?>">
          <label required>Customer Name</label>
          <select name="customer_id" id="customer_id" onchange="get_customer_details(<?php echo $this->uri->segment(3);?>);" >
            <option value="">Select Customer</option>
            <?php if(count($customer)>0){
                foreach($customer as $ckey=>$cvalue){ ?>
                  <option value="<?php echo $cvalue['id'];?>" <?php echo set_select('customer_id',$cvalue['id'],(($editdata['customer_id'] == $cvalue['id'])?true:false));?>><?php echo $cvalue['business_name']; ?></option>  
               <?php }} ?>
          </select>
        </div>
       <div id="customer_details_view" class="col-md-12"> 
        <?php $this->load->view("frontend/sales/customer_details",$this->data);?>
       </div>
</div>  
<div class="col-md-4">
    
   <div class="form-group <?php echo (form_error('type'))?'error':'';?>" data-error="<?php echo (form_error('type'))? form_error('type'):'';?>" >
      <label>Type</label>
      <select name="type" class="form-group" >
        <option value="">Select Type</option>
         <?php if(count($saletype)>0){
                foreach($saletype as $tkey=>$tvalue){ ?>
                  <option value="<?php echo $tvalue['name'];?>" <?php echo set_select('type',$tvalue['name'],(($editdata['type'] == $tvalue['name'])?true:false));?>><?php echo $tvalue['name']; ?></option>  
         <?php }} ?>
      </select>
    </div>
   <div class="form-group <?php echo (form_error('shipping_type'))?'error':'';?>" data-error="<?php echo (form_error('shipping_type'))? form_error('shipping_type'):'';?>">
      <label>Shipping Type</label>
      <select name="shipping_type" class="form-group">
        <option value="">Select Shipping Type</option>
        <?php if(count($shipping_type)>0){ foreach($shipping_type as $skey => $svalue){ ?>
         <option value="<?php echo $svalue['id']; ?>" <?php echo set_select('shipping_type',$svalue['id'],(($editdata['shipping_type'] == $svalue['id'])?true:false));?>><?php echo $svalue['type']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))?form_error('credit_type'):'';?>" >
      <label>Credit Type</label>
      <select name="credit_type" class="form-group">
        <option value="">Select Credit Type</option>
        <?php if(count($credit_type)>0){ foreach($credit_type as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('credit_type',$cvalue['id'],(($editdata['credit_type'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group <?php echo (form_error('carrier'))?'error':'';?>" data-error="<?php echo (form_error('carrier'))?form_error('carrier'):'';?>" >
      <label>Carrier</label>
      <select name="carrier" class="form-group">
        <option value="">Select Carrier</option>
        <?php if(count($carrier)>0){ foreach($carrier as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('carrier',$cvalue['id'],(($editdata['carrier'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    
    <div class="form-group <?php echo (form_error('order_status'))?'error':'';?>" data-error="<?php echo (form_error('order_status'))? form_error('order_status'):'';?>" >
      <label>Order Status</label>
      <select name="order_status" class="form-group" >
        <option value="">Select Status</option>
         <option value="NEW" <?php echo set_select('order_status',"NEW",(($editdata['order_status'] == "NEW")?true:false));?>>NEW</option>
         <option value="PROCESSING" <?php echo set_select('order_status',"PROCESSING",(($editdata['order_status'] == "PROCESSING")?true:false));?>>PROCESSING</option>
         <option value="PENDING" <?php echo set_select('order_status',"PENDING",(($editdata['order_status'] == "PENDING")?true:false));?>>PENDING</option>
         <option value="COMPLETED" <?php echo set_select('order_status',"COMPLETED",(($editdata['order_status'] == "COMPLETED")?true:false));?>>COMPLETED</option>
      </select>
    </div>
    <div class="form-group" >
      <label>SO Instructions</label>
      <textarea name="so_instructions" class="form-control"><?php echo $editdata['so_instructions']; ?></textarea>
    </div>
    <div class="form-group " >
      <label>BOL Instructions</label>
      <textarea class="form-control" name="bol_instructions"><?php echo $editdata['bol_instructions']; ?></textarea>
    </div>
     
  </div>
   <div class="form-group" id="cartItems">
     <?php $this->load->view("frontend/salesproductselection/cart_items",$this->data); ?>
   </div>
  
  <div class="form-group">
  </div>
  <div>
    <input type="submit" name="so" class="btn btn-default" value="<?php echo (isset($editdata['btn']))?$editdata['btn']:""; ?>" />
  </div>  
  </form> 
  
 <div id="updat_cart" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="sales_update_to_cart" id="sales_update_to_cart">
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
      <input type="hidden" name="cart_id" id="cart_id" value="" />
       <div class="row"> 
        <div class="form-group col-md-4">
            <label>Quantity</label>
            <input type="text" name="quantity" id="quantity"/>
        </div>
       </div>
     </div>  
     <div class="row">
        <div class="form-group col-md-4">
            <input type="button" name="cancel" onclick="modal_close();" data-dismiss="modal" class="btn btn-block" id="cancel" data-pid=""  value="Cancel" />
        </div>
        <div class="form-group col-md-4">  
            <input type="button" name="up_cart" onclick="sales_update_cart('');" data-dismiss="modal"  id="confirm" class="btn btn-block" value="Update" />
        </div>
     </div>
     </form>
      
    </div>
  </div>
</div>