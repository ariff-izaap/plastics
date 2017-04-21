  <div class="row blue-mat">
      <div class="breadcrumbs col-md-6">
        <?php echo set_breadcrumb(); ?>
        <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
      </div>
      <div class="col-md-6 action-buttons text-right">
       
    </div>
  </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
    
    <div id="popOverBox" style="display: block;"></div>
    
  <h2 style="margin-left:24px;" class="container-title">Products in Selection</h2>
  <?php echo $grid; ?>
    <div class="col-md-12" id="product_shipping_lists">
       <h2 class="container-title">Products in Shipping Order</h2>
         <?php $this->load->view("frontend/salesproductselection/cart_items", $this->data); ?>
    </div>
      
      <br />
      <br />
   <div class="container button-sec">     
       <div class="row">
          <div class="col-md-2">
            <button type="button" class="col-md-2 btn btn-block" onclick="product_add_to_shipment()">Add Product to SO</button>
          </div>
          <div class="col-md-2">  
            <button type="button" class="col-md-2 btn btn-block">Edit Product On SO</button>
         </div>
         <div class="col-md-2">   
            <button type="button" class="col-md-2 btn btn-block">Delete Product From SO</button>
         </div>
         <div class="col-md-2">   
            <button type="button" class="col-md-2 btn btn-block">Existing SO</button>
         </div>
         <div class="col-md-2">   
           <!-- <button type="button" class="col-md-2 btn btn-block" >Save SO</button> -->
           <a href="<?php echo site_url();?>salesorder/checkout" class="col-md-2 btn btn-block">Save SO</a>
         </div>
         <div class="col-md-2">   
            <button type="button" class="col-md-2 btn btn-block">Create New SO</button>
         </div>
       </div>
   </div>
  
  <div id="product_ship" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="modal_close();">&times;</button>
      </div>
      <form name="sales_add_to_cart" id="sales_add_to_cart">
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
       <input type="hidden" name="product_id" id="product_id" />
        <!--
<div class="form-group">
         <label>Type of Sale</label>
         <select name="type_of_sale"> 
              <?php //if(count($salestype)>0){ foreach($salestype as $stkey=>$stvalue){ ?>
                <option value="<?php //echo $stvalue['id']; ?>"><?php //echo ucfirst($stvalue['name']); ?></option>
              <?php //}} ?>  
         </select>
        </div>
-->
        <div class="form-group">
         <!--
Warehouse <input type="radio" name="product_from" value="warehouse" /> 
         Vendor <input type="radio" name="product_from" value="vendor" /> 

         <input type="text" name="document_name" placeholder="Document Name" />
         <div class="form-group">
		    <input id="product_upload_image" name="product_upload_image" type="file" class="file" />
		    <input type="hidden" name="file_name" id="file_name" value="<?php //echo set_value('file_name', $editdata['file_name']);?>" />
            <?php //echo form_error('file_name', '<span class="help-block">', '</span>'); ?>
        </div>-->
        </div>
       <div class="row"> 
        <div class="form-group col-md-4">
            <label>Quantity Available</label>
            <input type="text" readonly="readonly" name="quantity_available" id="quantity_available"/>
        </div>
        <div class="form-group col-md-4">
            <label>Quantity to Order</label>
            <input type="text" name="quantity_to_order" id="quantity_to_order" value="0"/>
        </div>
        <div class="form-group col-md-4">
            <label>Price</label>
            <input type="text" name="price" id="price"/>
        </div>
       </div>
     </div>  
     <div class="row">
        <div class="form-group col-md-4">
            <input type="button" name="cancel" onclick="modal_close();" data-dismiss="modal" class="btn btn-block" id="cancel" data-pid=""  value="Cancel" />
        </div>
        <div class="form-group col-md-4">  
            <input type="button" name="confirm" onclick="sales_prod_add_to_cart();" data-dismiss="modal"  id="confirm" class="btn btn-block" value="Confirm" />
        </div>
     </div>
     </form>
      <!--
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
-->
    </div>
  </div>
</div>  
</div>  
