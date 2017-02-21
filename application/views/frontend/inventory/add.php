 <div id="inventory_add_section">
 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo site_url('inventory');?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>
   
    <div class="row">
    
        <div class="col-md-12">
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1primary" class="tablinks" data-toggle="tab">Add Inventory</a></li>
                        <li><a href="#tab2primary" class="tablinks" data-toggle="tab">Inventory Images</a></li>
                        <li><a href="#tab3primary" class="tablinks" data-toggle="tab">Vendors</a></li>
                    </ul>
                </div>
                
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active tabcontent" id="tab1primary">
                        <form name="inventory" id="inventory_sub_form" method="POST" >
                            <div class="form-grid col-md-6">
                                <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
                                  <label required>Inventory Name</label>
                                  <input type="text" name="name" class="form-control" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="Product Name" />
                                </div>
                        
                                <div class="form-group <?php echo (form_error('sku'))?'error':'';?>" data-error="<?php echo (form_error('sku'))? form_error('sku'):'';?>">
                                  <label required>SKU</label>
                                  <input type="text" name="sku" class="form-control" id="sku" value="<?php echo set_value('sku', $editdata['sku']);?>" placeholder="Sku">
                                </div>
                                <div class="form-group col-md-6 <?php echo (form_error('category_id'))?'error':'';?>" data-error="<?php echo (form_error('category_id'))? form_error('category_id'):'';?>">
                              <label required>Categories</label>
                              <select class="form-control" name="category_id" id="category_id">
                                <option value="">---Select---</option>
                                    <?php foreach($categories as $category):
                                      $sel = ($category['id'] == set_value('category_id', $editdata['category_id']))?'selected':'';
                                    ?>
                                    <option value="<?php echo $category['id'];?>" <?php echo $sel;?> > <?php echo $category['name'];?> </option>
                                  <?php endforeach;?>
                              </select>
                            </div>
                                <div class="form-group col-md-6 <?php echo (form_error('color_id'))?'error':'';?>" data-error="<?php echo (form_error('color_id'))? form_error('color_id'):'';?>">
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
                                
                                <div class="form-group col-md-6 <?php echo (form_error('form_id'))?'error':'';?>" data-error="<?php echo (form_error('form_id'))? form_error('form_id'):'';?>">
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
                                
                                <div class="form-group col-md-6 <?php echo (form_error('package_id'))?'error':'';?>" data-error="<?php echo (form_error('package_id'))? form_error('package_id'):'';?>">
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
                                <br />
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
                                </div>
                                
                                <div class="form-grid col-md-6">
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
                                
                                <div class="form-group  <?php echo (form_error('length'))?'error':'';?>" data-error="<?php echo (form_error('length'))? form_error('length'):'';?>">
                                  <label>Length</label>
                                  <input type="text" name="length" class="form-control" id="length" value="<?php echo set_value('length', $editdata['length']);?>" placeholder="Length" />
                                </div>
                                <div class="form-group  <?php echo (form_error('width'))?'error':'';?>" data-error="<?php echo (form_error('width'))? form_error('width'):'';?>">
                                  <label>Width</label>
                                  <input type="text" name="width" class="form-control" id="width" value="<?php echo set_value('width', $editdata['width']);?>" placeholder="Width" />
                                </div>
                                <div class="form-group  <?php echo (form_error('height'))?'error':'';?>" data-error="<?php echo (form_error('height'))? form_error('height'):'';?>">
                                  <label>Height</label>
                                  <input type="text" name="height" class="form-control" id="height" value="<?php echo set_value('height', $editdata['height']);?>" placeholder="Height" />
                                </div>
                                <div class="form-group  <?php echo (form_error('weight'))?'error':'';?>" data-error="<?php echo (form_error('weight'))? form_error('weight'):'';?>">
                                  <label>Weight</label>
                                  <input type="text" name="weight" class="form-control" id="weight" value="<?php echo set_value('weight', $editdata['weight']);?>" placeholder="Weight" />
                                </div>
                                <div class="form-group  <?php echo (form_error('in_stock'))?'error':'';?>" data-error="<?php echo (form_error('in_stock'))? form_error('in_stock'):'';?>">
                                  <label>In Stock</label>
                                  <input type="text" name="in_stock" class="form-control" id="in_stock" value="<?php echo set_value('in_stock', $editdata['in_stock']);?>" placeholder="In Stock" />
                                </div>
                                <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>">
                        
                                </div>
                                <div class="form-group col-md-2 col-md-offset-8">   
                                  <a href="<?php echo site_url('inventory');?>" class="btn btn-block active text-center">Back</a>
                                </div>
                                <div class="form-group col-md-2">   
                                  <button type="button" class="btn btn-block" id="inventory_submit" onclick="return inventory_sub();">Next</button>
                                </div>
                                
                                 </form>
                                 
                        </div>
                        <div class="tab-pane fade tabcontent" id="tab2primary">
                            <div class="col-md-12 text-right" style="padding-bottom: 20px;">
                              <button type="button" class="btn btn-info btn-lg" id="load_image_popup"  onclick="check_product_id(this);">Upload Images</button>
                            </div>     
                         
                              <table class="table table-striped table-hover tableSite table-bordered">
                                 <tr>
                                    <td>Title</td>
                                    <td>Image</td>
                                    <td>Action</td>
                                 </tr>
                                   <?php //print_r($editdata['images']); 
                                       if(count($editdata['images'])>0) { 
                                         foreach($editdata['images'] as $ekey => $evalue) {
                                     ?>
                                        <tr>
                                            <td><?php echo $evalue['image_title']; ?></td>
                                            <td><img src="<?php echo base_url(); ?>assets/images/product/<?php echo $evalue['file_name']; ?>" /></td>
                                            <td><i class="fa fa-trash-o trash" onclick="product_image_delete('<?php echo $evalue['id'];?>');"></i></td>
                                        </tr>
                                 <?php }} 
                                      else { ?>
                                   <tr>
                                    <td colspan="3"><?php echo "No Images Found!"; ?></td>
                                   </tr>
                                  <?php
                                    
                                 }?>
                              </table>
                        </div>
                        <div class="tab-pane fade tabcontent" id="tab3primary">
                            <div class="form-group col-md-2">
                              <h4>Vendors</h4>
                            </div>
                        </div>
                        <div class="tab-pane fade tabcontent" id="tab4primary">Primary 4</div>
                        <div class="tab-pane fade tabcontent" id="tab5primary">Primary 5</div>
                    </div>
                 </div>
            </div>
        </div>
	</div>
 </div>
<br /> 
<br />
 
<?php 
      //$img_url  = site_url()."assets/images/product/".$editdata['file_name'];
      $prev_img = (isset($editdata['file_name']) && !empty($editdata['file_name']))?"<img src='$img_url' class='file-preview-image' alt='Product Image' title='Product Image'>":""; 
 ?>

<script>

var prv_img = "<?php echo $prev_img; ?>";
var page = '';
var Id = 'product_upload_image';
var hover_id = '';
</script>




