<form  class="form-horizontal ctrl_grp_4" enctype="multipart/form-data" name="form_vendor_add" id="form_vendor_add" action="<?php echo site_url('product/vendor_add');?>" method="POST"> 
<div class="row-fluid">
  <table class="table table-bordered">
    <tbody class="white_bg">
      <tr>
        <td>

          <div class="span6">
            <dl class="dl-horizontal text-left">

              <dt>Vendor:*</dt>
              <dd>
                <?php echo form_dropdown('vendor_id', $vendor_list, set_value('vendor_id', $edit_data['vendor_id']), 'class="boot_select_false "');?>
                <?php echo form_error('vendor_id', '<span class="error_text">', '</span>');?>
              </dd>

              <dt>Vendor Product Name:*</dt>
              <dd>
                <input class="input-medium" name="vendor_product_name" id="vendor_product_name" value="<?php echo set_value('vendor_product_name', $edit_data['vendor_product_name'])?>" type="text">
                <?php echo form_error('vendor_product_name', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>SKU:*</dt>
              <dd>
                <input class="input-medium" name="sku" id="sku" value="<?php echo set_value('sku', $edit_data['sku'])?>" type="text">
                <?php echo form_error('sku', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Cost:*</dt>
              <dd>
                <input class="input-medium" name="cost" id="cost" value="<?php echo set_value('cost', $edit_data['cost'])?>" type="text">
                <?php echo form_error('cost', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>In Stock?</dt>
              <dd>
                <?php 
                echo form_dropdown('in_stock', array('Yes' => 'Yes', 'No' => 'No'), set_value('in_stock', $edit_data['in_stock']), 'class="input-medium" data-width="100px"');
                ?>
                <?php echo form_error('in_stock', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Priority:*</dt>
              <dd>
                <input class="input-medium" name="priority" id="priority" value="<?php echo set_value('priority', $edit_data['priority'])?>" type="text">
                <?php echo form_error('priority', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Auto Order:</dt>
              <dd>
                <?php 
                $options = array('1' => 'Yes', '0' => 'No');
                echo form_dropdown('auto_order', $options, set_value('auto_order', $edit_data['auto_order']), 'data-width="100px"');
                ?>
                <?php echo form_error('auto_order', '<span class="error_text">', '</span>');?>
              </dd>
              

            </dl>
          </div>

          <div class="span6">
            <dl class="dl-horizontal text-left">
              
              <dt>Status:</dt>
              <dd>
                <?php 
                $options = array('1' => 'Enabled', '0' => 'Disabled');
                echo form_dropdown('enabled', $options, set_value('enabled', $edit_data['enabled']), 'class="input-medium" data-width="100px"');
                ?>
                <?php echo form_error('enabled', '<span class="error_text">', '</span>');?>
              </dd>

              <dt>UPC:*</dt>
              <dd>
                <input class="input-medium" name="upc" id="upc" value="<?php echo set_value('upc', $edit_data['upc'])?>" type="text">
                <?php echo form_error('upc', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Strict MAP:</dt>
              <dd>
                <input class="input-medium" name="vendor_strict_map" id="vendor_strict_map" value="<?php echo set_value('vendor_strict_map', $edit_data['vendor_strict_map'])?>" type="text">
                <?php echo form_error('vendor_strict_map', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Stock Level:</dt>
              <dd>
                <input class="input-medium" name="stock_level" id="stock_level" value="<?php echo set_value('stock_level', $edit_data['stock_level'])?>" type="text">
                <?php echo form_error('stock_level', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Lead Time:</dt>
              <dd>
                <input class="input-medium" name="lead_time" id="lead_time" value="<?php echo set_value('lead_time', $edit_data['lead_time'])?>" type="text">
                <?php echo form_error('lead_time', '<span class="error_text">', '</span>');?>
              </dd>
              
              <dt>Shipping Service:</dt>
              <dd>
                <?php 
                echo form_dropdown('shipping_service', get_shipping_services(TRUE), set_value('shipping_service', strtolower($edit_data['shipping_service'])), 'class="input-medium" data-width="100px"');
                ?>
                <?php echo form_error('shipping_service', '<span class="error_text">', '</span>');?>
              </dd>

              <dt>Dropship Fee:</dt>
              <dd>
                <input class="input-medium" name="dropship_fee" id="dropship_fee" value="<?php echo set_value('dropship_fee', $edit_data['dropship_fee'])?>" type="text">
                <?php echo form_error('dropship_fee', '<span class="error_text">', '</span>');?>
              </dd>
              
            </dl>
            
            <input  type="hidden" name="edit_id" value="<?php echo $edit_data['id'];?>" /> 
            <input  type="hidden" name="product_id" value="<?php echo $product_id;?>" />
          </div>

        </td>
      </tr>
    </tbody>
  </table>
</div>
</form>