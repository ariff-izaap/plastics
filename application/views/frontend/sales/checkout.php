 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>

  <div class="row">

  <form name="checkout" id="checkout" method="POST" action="<?php echo site_url();?>salesorder/checkout">
      <div class="form-grid col-md-6">
        <div class="form-group col-md-6 <?php echo (form_error('business_name'))?'error':'';?>" data-error="<?php echo (form_error('business_name'))? form_error('business_name'):'';?>">
          <label required>Customer Name</label>
          <select name="customer_name" id="customer_id" onchange="get_customer_details();" >
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
</div>  
<div class="col-md-6">
     <h2>Cart Items</h2>
   <div class="form-grid col-md-12">
     <?php $this->load->view("frontend/salesproductselection/cart_items",$this->data); ?>
   </div>
   <div class="form-group" >
      <label>Type</label>
      <select name="type" class="form-control">
        <option value="">Select Type</option>
         <option value="SALE">Sale</option>
         <option value="PURCHASE">Purchase</option>
         <option value="RETURN">Return</option>
      </select>
    </div>
   <div class="form-group" >
      <label>Shipping Type</label>
      <select name="shipping_type" class="form-control">
        <option value="">Select Shipping Type</option>
        <?php if(count($shipping_type)>0){ foreach($shipping_type as $skey => $svalue){ ?>
         <option value="<?php echo $svalue['id']; ?>"><?php echo $svalue['type']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group " >
      <label>Credit Type</label>
      <select name="credit_type" class="form-control">
        <option value="">Select Credit Type</option>
        <?php if(count($credit_type)>0){ foreach($credit_type as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>"><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group " >
      <label>SO Instructions</label>
      <textarea name="so_instructions" class="form-control"></textarea>
    </div>
    <div class="form-group " >
      <label>BOL Instructions</label>
      <textarea class="form-control" name="bol_instructions"></textarea>
    </div>
  </div>
  <div>
    <input type="submit" name="so" class="btn btn-default" value="Create Order" />
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