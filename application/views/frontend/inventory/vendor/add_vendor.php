<form  class="form-horizontal ctrl_grp_4" enctype="multipart/form-data" name="form_vendor_add" id="form_vendor_add" action="<?php echo site_url('product/vendor_add');?>" method="POST"> 
<div class="row-fluid">
  <table class="table table-bordered">
    <tbody class="gray-bg">
      <tr>
        <td>

          <div class="row">
            <div class="col-md-12">

              <label>Vendor:*</label>
              <div class="form-group" data-error="<?php echo (form_error('vendor_id'))? form_error('vendor_id'):'';?>">
                <?php echo form_dropdown('vendor_id', $vendor_list, set_value('vendor_id', $edit_data['vendor_id']), 'class="boot_select_false "');?>
                <?php echo form_error('vendor_id', '<span class="error_text">', '</span>');?>
              </div>
              
              <label>SKU:*</label>
              <div class="form-group" data-error="<?php echo (form_error('sku'))? form_error('sku'):'';?>">
                <input class="input-medium" name="sku" id="sku" value="<?php echo set_value('sku', (!empty($edit_data['sku']))?$edit_data['sku']:$edit_data['product']['sku']);?>" type="text">
                <?php echo form_error('sku', '<span class="error_text">', '</span>');?>
              </div>
              
              <label>Cost:*</label>
              <div class="form-group" data-error="<?php echo (form_error('cost'))? form_error('cost'):'';?>">
                <input class="input-medium" name="cost" id="cost" value="<?php echo set_value('cost', (!empty($edit_data['cost']))?$edit_data['cost']:$edit_data['product']['retail_price']);?>" type="text">
                <?php echo form_error('cost', '<span class="error_text">', '</span>');?>
              </div>
              
              <label>In Stock?</label>
              <div class="form-group" data-error="<?php echo (form_error('in_stock'))? form_error('in_stock'):'';?>">
                <?php 
                echo form_dropdown('in_stock', array('Yes' => 'Yes', 'No' => 'No'), set_value('in_stock', $edit_data['in_stock']), 'class="input-medium" data-width="100px"');
                ?>
                <?php echo form_error('in_stock', '<span class="error_text">', '</span>');?>
              </div>
              
              <label>Priority:*</label>
              <div class="form-group" data-error="<?php echo (form_error('priority'))? form_error('priority'):'';?>">
                <input class="input-medium" name="priority" id="priority" value="<?php echo set_value('priority', $edit_data['priority'])?>" type="text">
                <?php echo form_error('priority', '<span class="error_text">', '</span>');?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              
              <label>Status:</label>
              <div class="form-group" data-error="<?php echo (form_error('vendor_product_name'))? form_error('vendor_product_name'):'';?>">
                <?php 
                $options = array('1' => 'Enabled', '0' => 'Disabled');
                echo form_dropdown('enabled', $options, set_value('enabled', $edit_data['enabled']), 'class="input-medium" data-width="100px"');
                ?>
                <?php echo form_error('enabled', '<span class="error_text">', '</span>');?>
              </div>

              
              <label>Stock Level:</label>
              <div class="form-group " data-error="<?php echo (form_error('stock_level'))? form_error('stock_level'):'';?>">
                <input class="input-medium" name="stock_level" id="stock_level" value="<?php echo set_value('stock_level', $edit_data['stock_level'])?>" type="text">
                <?php echo form_error('stock_level', '<span class="error_text">', '</span>');?>
              </div>
              
              <label>Shipping Cost:</label>
              <div class="form-group " data-error="<?php echo (form_error('shipping_cost'))? form_error('shipping_cost'):'';?>">
                <input class="input-medium" name="shipping_cost" id="shipping_cost" value="<?php echo set_value('shipping_cost', $edit_data['shipping_cost'])?>" type="text">
                <?php echo form_error('shipping_cost', '<span class="error_text">', '</span>');?>
              </div>
              
              <label>Shipping Service:</label>
              <div class="form-group" data-error="<?php echo (form_error('shipping_service'))? form_error('shipping_service'):'';?>">
                <?php 
                      echo form_dropdown('shipping_service', get_shipping_services(TRUE), set_value('shipping_service', strtolower($edit_data['shipping_service'])), 'class="input-medium" data-width="100px"');
                ?>
                <?php echo form_error('shipping_service', '<span class="error_text">', '</span>');?>
              </div>

             <!--
 <label>Dropship Fee:</label>
              <div class="form-group" data-error="<?php //echo (form_error('dropship_fee'))? form_error('dropship_fee'):'';?>">
                <input class="input-medium" name="dropship_fee" id="dropship_fee" value="<?php //echo set_value('dropship_fee', $edit_data['dropship_fee'])?>" type="text">
                <?php //echo form_error('dropship_fee', '<span class="error_text">', '</span>');?>
              </div>
-->
              
              <!--
<label>In Bound</label>
              <div class="form-group" >
                <input class="input-medium" name="in_bound" id="in_bound" value="<?php //echo set_value('in_bound', $edit_data['in_bound'])?>" type="text">
                
              </div>
              
-->
            </div>
            
            <input  type="hidden" name="edit_id" value="<?php echo $edit_data['id'];?>" /> 
            <input  type="hidden" name="product_id" value="<?php echo $product_id;?>" />
          </div>

        </td>
      </tr>
    </tbody>
  </table>
</div>
</form>