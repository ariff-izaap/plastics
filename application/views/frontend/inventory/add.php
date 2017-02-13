 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="inventory" method="POSt">

      <div class="form-grid col-md-6">
        
        <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
          <label required>Inventory Name</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="Product Name" />
        </div>

        <div class="form-group <?php echo (form_error('sku'))?'error':'';?>" data-error="<?php echo (form_error('sku'))? form_error('sku'):'';?>">
          <label required>SKU</label>
          <input type="text" name="sku" class="form-control" id="sku" value="<?php echo set_value('sku', $editdata['sku']);?>" placeholder="Sku">
        </div>
        
        <div class="form-group col-md-4 <?php echo (form_error('color_id'))?'error':'';?>" data-error="<?php echo (form_error('color_id'))? form_error('color_id'):'';?>">
          <label required>Inventory Colors</label>
          <select class="form-control" name="color_id" id="color_id">
            <option value="">---Select---</option>
              <?php foreach($colors as $type):

                  $sel = ($type['id'] == set_value('color_id', $editdata['color_id']))?'selected':'';
              ?>
                <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
              <?php endforeach;?>
          </select>
        </div>
        
        <div class="form-group col-md-4 <?php echo (form_error('form_id'))?'error':'';?>" data-error="<?php echo (form_error('form_id'))? form_error('form_id'):'';?>">
          <label required>Inventory Forms</label>
          <select class="form-control" name="form_id" id="form_id">
            <option value="">---Select---</option>
              <?php foreach($forms as $type):

                  $sel = ($type['id'] == set_value('form_id', $editdata['form_id']))?'selected':'';
              ?>
                <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
              <?php endforeach;?>
          </select>
        </div>
        
        <div class="form-group col-md-4 <?php echo (form_error('package_id'))?'error':'';?>" data-error="<?php echo (form_error('package_id'))? form_error('package_id'):'';?>">
          <label required>Inventory Packages</label>
          <select class="form-control" name="package_id" id="package_id">
            <option value="">---Select---</option>
              <?php foreach($packages as $type):

                  $sel = ($type['id'] == set_value('package_id', $editdata['package_id']))?'selected':'';
              ?>
                <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
              <?php endforeach;?>
          </select>
        </div>
        
        <div class="form-group  <?php echo (form_error('quantity'))?'error':'';?>" data-error="<?php echo (form_error('quantity'))? form_error('quantity'):'';?>">
          <label>Quantity</label>
          <input type="text" name="quantity" class="form-control" id="quantity" value="<?php echo set_value('quantity', $editdata['quantity']);?>" placeholder="Quantity">
        </div>

     
        <div class="form-group  <?php echo (form_error('retail_price'))?'error':'';?>" data-error="<?php echo (form_error('retail_price'))? form_error('retail_price'):'';?>">
          <label required>Retail Price</label>
          <input type="text" name="retail_price" class="form-control" id="retail_price" value="<?php echo set_value('retail_price', $editdata['retail_price']);?>" placeholder="Retail Price" />
        </div>
        

        <div class="form-group  <?php echo (form_error('wholesale_price'))?'error':'';?>" data-error="<?php echo (form_error('wholesale_price'))? form_error('wholesale_price'):'';?>">
          <label required>Wholesale Price</label>
          <input type="text" name="wholesale_price" class="form-control" id="wholesale_price" value="<?php echo set_value('wholesale_price', $editdata['wholesale_price']);?>" placeholder="Wholesale Price" />
        </div>
        
        <div class="form-group  <?php echo (form_error('shipping_cost'))?'error':'';?>" data-error="<?php echo (form_error('shipping_cost'))? form_error('shipping_cost'):'';?>">
          <label>Shipping Cost</label>
          <input type="text" name="shipping_cost" class="form-control" id="shipping_cost" value="<?php echo set_value('shipping_cost', $editdata['shipping_cost']);?>" placeholder="Shipping Cost" />
        </div>
        
        <div class="form-group <?php echo (form_error('ref_no'))?'error':'';?>" data-error="<?php echo (form_error('ref_no'))? form_error('ref_no'):'';?>">
          <label required>Ref No</label> 	
          <input type="text" name="ref_no" class="form-control" id="ref_no" value="<?php echo set_value('ref_no', $editdata['ref_no']);?>" placeholder="Ref No" />
        </div>
        
        
        <div class="form-group  <?php echo (form_error('internal_lot_no'))?'error':'';?>" data-error="<?php echo (form_error('internal_lot_no'))? form_error('internal_lot_no'):'';?>">
          <label>Internal Lot Number</label>
          <input type="text" name="internal_lot_no" class="form-control" id="internal_lot_no" value="<?php echo set_value('internal_lot_no', $editdata['internal_lot_no']);?>" placeholder="Internal lot No" />
        </div>
        
        <div class="form-group  <?php echo (form_error('vendor_lot_no'))?'error':'';?>" data-error="<?php echo (form_error('vendor_lot_no'))? form_error('vendor_lot_no'):'';?>">
          <label>Vendor Lot Number</label>
          <input type="text" name="vendor_lot_no" class="form-control" id="vendor_lot_no" value="<?php echo set_value('vendor_lot_no', $editdata['vendor_lot_no']);?>" placeholder="Vendor lot No" />
        </div>
        
         <div class="form-group <?php echo (form_error('received_at_customer'))?'error':'';?>" data-error="<?php echo (form_error('received_at_customer'))? form_error('received_at_customer'):'';?>">
          <label>Received At Customer</label>
          <input type="radio" name="received_at_customer" value="1" <?php echo set_radio('received_at_customer', '1', ($editdata['received_at_customer']==1)?TRUE:""); ?> /> Yes
          <input type="radio" name="received_at_customer" value="0" <?php echo set_radio('received_at_customer', '1', ($editdata['received_at_customer']==0)?TRUE:""); ?> /> No
        </div>
        
         <div class="form-group <?php echo (form_error('received_in_warehouse'))?'error':'';?>" data-error="<?php echo (form_error('received_in_warehouse'))? form_error('received_in_warehouse'):'';?>">
          <label>Received At Warehouse</label>
          <input type="radio" name="received_in_warehouse" value="1" <?php echo set_radio('received_in_warehouse', '1', ($editdata['received_in_warehouse']==1)?TRUE:""); ?> /> Yes
          <input type="radio" name="received_in_warehouse" value="0" <?php echo set_radio('received_in_warehouse', '1', ($editdata['received_in_warehouse']==0)?TRUE:""); ?> /> No
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
