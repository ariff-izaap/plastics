<?php $this->layout->add_javascripts(array('fileinput.min','fileinput','product'));
     $this->layout->add_stylesheets(array('fileinput.min','fileinput'));
      ?>
  <div id="inventory_add_section">
   <div class="row">
      <div class="breadcrumbs">
        <?php echo set_breadcrumb(); ?>
          <!--
<a href="<?php //echo site_url('inventory');?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
-->
      </div>
    </div>
   <div class="container">
    <div class="row">
    
        <div class="col-md-12">
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                    <ul id="ProductTabs" class="nav nav-tabs">
                        <li><a href="#tab1primary" class="tablinks" data-toggle="tab">GENERAL</a></li>
                        <li><a href="#tab2primary" class="tablinks"  onclick="open_tab('tab2primary');" >IMAGES</a></li>
                        <li><a href="#tab3primary" class="tablinks"  onclick="open_tab('tab3primary');" >VENDORS</a></li>
                    </ul>
                </div>
                
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active tabcontent" id="tab1primary">
                        <form name="inventory" id="inventory_sub_form" method="POST" enctype="multipart/form-data">
                           <input type="hidden" name="type" id="form_type" value="" />
                           <div class="form-grid col-md-6 panel panel-default panel-bor">
                           <div class="panel-heading formcontrol-box">
                                <div class="form-group  <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? form_error('name'):'';?>">
                                  <label required class="col-md-4">Inventory Name</label>
                                  <input type="text" name="name" class="form-control col-md-8" id="name" value="<?php echo set_value('name', $editdata['name']);?>" placeholder="Product Name" />
                                </div>
                        
                                <div class="form-group <?php echo (form_error('sku'))?'error':'';?>" data-error="<?php echo (form_error('sku'))? form_error('sku'):'';?>">
                                  <label required class="col-md-4">SKU</label>
                                  <input type="text" name="sku" class="form-control col-md-8" id="sku" value="<?php echo set_value('sku', $editdata['sku']);?>" placeholder="Sku">
                                </div>
                                <div class="form-group <?php echo (form_error('category_id'))?'error':'';?>" data-error="<?php echo (form_error('category_id'))? form_error('category_id'):'';?>">
                              <label required class="col-md-4">Categories</label>
                              <select class="form-control col-md-8" name="category_id" id="category_id">
                                <option value="">---Select---</option>
                                    <?php foreach($categories as $category):
                                      $sel = ($category['id'] == set_value('category_id', $editdata['category_id']))?'selected':'';
                                    ?>
                                    <option value="<?php echo $category['id'];?>" <?php echo $sel;?> > <?php echo $category['name'];?> </option>
                                  <?php endforeach;?>
                              </select>
                            </div>
                                <div class="form-group <?php echo (form_error('color_id'))?'error':'';?>" data-error="<?php echo (form_error('color_id'))? form_error('color_id'):'';?>">
                                  <label required class="col-md-4">Inventory Colors</label>
                                  <select class="form-control col-md-8" name="color_id" id="color_id">
                                    <option value="">---Select---</option>
                                      <?php foreach($colors as $type):
                        
                                          $sel = ($type['id'] == set_value('color_id', $editdata['color_id']))?'selected':'';
                                      ?>
                                        <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
                                      <?php endforeach;?>
                                  </select>
                                </div>
                                
                                <div class="form-group <?php echo (form_error('form_id'))?'error':'';?>" data-error="<?php echo (form_error('form_id'))? form_error('form_id'):'';?>">
                                  <label required class="col-md-4">Inventory Forms</label>
                                  <select class="form-control col-md-8" name="form_id" id="form_id">
                                    <option value="">---Select---</option>
                                      <?php foreach($forms as $type):
                        
                                          $sel = ($type['id'] == set_value('form_id', $editdata['form_id']))?'selected':'';
                                      ?>
                                        <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
                                      <?php endforeach;?>
                                  </select>
                                </div>
                                
                                <div class="form-group <?php echo (form_error('package_id'))?'error':'';?>" data-error="<?php echo (form_error('package_id'))? form_error('package_id'):'';?>">
                                  <label required class="col-md-4">Inventory Packages</label>
                                  <select class="form-control col-md-8" name="package_id" id="package_id">
                                    <option value="">---Select---</option>
                                      <?php foreach($packages as $type):
                        
                                          $sel = ($type['id'] == set_value('package_id', $editdata['package_id']))?'selected':'';
                                      ?>
                                        <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
                                      <?php endforeach;?>
                                  </select>
                                </div>
                                <br />
                                <div class="form-group  <?php echo (form_error('product'))?'error':'';?>" data-error="<?php echo (form_error('product'))? form_error('product'):'';?>">
                                  <label class="col-md-4">Product:</label>
                                   <select name="product" class="form-control col-md-8" >
                                    <option value="">--Select--</option>
                                    <?php
                                    if(get_prodcut_type())
                                    {
                                      foreach (get_prodcut_type() as $key => $value)
                                      {
                                        ?>
                                        <option <?php if($value['id']==$editdata['product']){?> selected <?php }?>
                                          value="<?=$value['id'];?>"><?=$value['name'];?></option>
                                        <?php
                                      }
                                    }
                                    ?>
                                  </select>
                                  <!-- <input type="text" name="product" class="form-control" id="product" value="<?php echo set_value('product', $editdata['product']);?>" placeholder="Product" /> -->
                                </div>
                                <br />
                                <div class="form-group  <?php //echo (form_error('notes'))?'error':'';?>" data-error="<?php //echo (form_error('notes'))? form_error('notes'):'';?>">
                                  <label required class="col-md-4">Notes:</label>
                                  <textarea name="notes" class="form-control col-md-8" id="notes"><?php echo set_value('notes', $editdata['notes']); ?> </textarea>
                                </div>
                                <br />
                                <div class="form-group  <?php //echo (form_error('item_type'))?'error':'';?>" data-error="<?php //echo (form_error('item_type'))? form_error('item_type'):'';?>">
                                  <label required class="col-md-4">Type:</label>
                                   <textarea name="item_type" class="form-control col-md-8" id="type"><?php echo set_value('item_type', $editdata['item_type']); ?> </textarea> 
                                </div>
                                <br />
                                <div class="form-group  <?php //echo (form_error('equivalent'))?'error':'';?>" data-error="<?php //echo (form_error('equivalent'))? form_error('equivalent'):'';?>">
                                  <label required class="col-md-4">Equivalent:</label>
                                  <textarea name="equivalent" class="form-control col-md-8" id="equivalent"><?php echo set_value('equivalent', $editdata['equivalent']); ?> </textarea>
                                </div>
                                <br />
                                <div class="form-group  <?php echo (form_error('row'))?'error':'';?>" data-error="<?php echo (form_error('row'))? form_error('row'):'';?>">
                                  <label class="col-md-4">Row</label>
                                  <input type="text" name="row" class="form-control col-md-8" id="row" value="<?php echo set_value('row', $editdata['row']);?>" placeholder="Row">
                                </div>
                                <br />
                                <div class="form-group  <?php echo (form_error('units'))?'error':'';?>" data-error="<?php echo (form_error('units'))? form_error('units'):'';?>">
                                  <label class="col-md-4">Units:</label>
                                  <input type="text" name="units" class="form-control col-md-8" id="units" value="<?php echo set_value('units', $editdata['units']);?>" placeholder="Units" />
                                </div>
                                <br />
                                
                                <div class="form-group  <?php echo (form_error('quantity'))?'error':'';?>" data-error="<?php echo (form_error('quantity'))? form_error('quantity'):'';?>">
                                  <label class="col-md-4">Quantity</label>
                                  <input type="text" name="quantity" class="form-control col-md-8" id="quantity" value="<?php echo set_value('quantity', $editdata['quantity']);?>" placeholder="Quantity">
                                </div>
                            
                                <div class="form-group  <?php echo (form_error('retail_price'))?'error':'';?>" data-error="<?php echo (form_error('retail_price'))? form_error('retail_price'):'';?>">
                                  <label required class="col-md-4">Retail Price</label>
                                  <input type="text" name="retail_price" class="form-control col-md-8" id="retail_price" value="<?php echo set_value('retail_price', $editdata['retail_price']);?>" placeholder="Retail Price" />
                                </div>
                                
                                <div class="form-group  <?php echo (form_error('wholesale_price'))?'error':'';?>" data-error="<?php echo (form_error('wholesale_price'))? form_error('wholesale_price'):'';?>">
                                  <label required class="col-md-4">Wholesale Price</label>
                                  <input type="text" name="wholesale_price" class="form-control col-md-8" id="wholesale_price" value="<?php echo set_value('wholesale_price', $editdata['wholesale_price']);?>" placeholder="Wholesale Price" />
                                </div>
                                
                                <div class="form-group <?php echo (form_error('ref_no'))?'error':'';?>" data-error="<?php echo (form_error('ref_no'))? form_error('ref_no'):'';?>">
                                  <label required class="col-md-4">Ref No</label> 	
                                  <input type="text" name="ref_no" class="form-control col-md-8" id="ref_no" value="<?php echo set_value('ref_no', $editdata['ref_no']);?>" placeholder="Ref No" />
                                </div>
                                
                                <!--
<div class="form-group  <?php //echo (form_error('shipping_cost'))?'error':'';?>" data-error="<?php //echo (form_error('shipping_cost'))? form_error('shipping_cost'):'';?>">
                                  <label>Shipping Cost</label>
                                  <input type="text" name="shipping_cost" class="form-control" id="shipping_cost" value="<?php //echo set_value('shipping_cost', $editdata['shipping_cost']);?>" placeholder="Shipping Cost" />
                                </div>
-->
                        
                                <div class="form-group  <?php echo (form_error('internal_lot_no'))?'error':'';?>" data-error="<?php echo (form_error('internal_lot_no'))? form_error('internal_lot_no'):'';?>">
                                  <label class="col-md-4">Internal Lot Number</label>
                                  <input type="text" name="internal_lot_no" class="form-control col-md-8" id="internal_lot_no" value="<?php echo set_value('internal_lot_no', $editdata['internal_lot_no']);?>" placeholder="Internal lot No" />
                                </div>
                                <div class="form-group  <?php echo (form_error('vendor_lot_no'))?'error':'';?>" data-error="<?php echo (form_error('vendor_lot_no'))? form_error('vendor_lot_no'):'';?>">
                                  <label class="col-md-4">Vendor Lot Number</label>
                                  <input type="text" name="vendor_lot_no" class="form-control col-md-8" id="vendor_lot_no" value="<?php echo set_value('vendor_lot_no', $editdata['vendor_lot_no']);?>" placeholder="Vendor lot No" />
                                </div>
                                </div>
                                </div>
                                
                                <div class="form-grid col-md-6 panel panel-default panel-bor">
                                <div class="panel-heading formcontrol-box">
                                <label class="">Certificate Documents:</label>
                                <div class="form-group">
                    				<input id="certificate_file_name" name="certificate_file_name" class="file" type="file" />
                                    <input id="certification_files" name="certification_files" type="hidden" value="<?php echo set_value('certification_files',$editdata['certification_files']); ?>" />
                                    <?php if(!empty($editdata['certification_files'])){ $image = BASEPATH_CUSTOM.'assets/uploads/product/certificate/'.$editdata['certification_files']; if(file_exists($image)) { ?>
                                    <a href="<?php echo site_url().'assets/uploads/product/certificate/'.$editdata['certification_files']; ?>" target="_blank" title="You can see already uploaded file" >Certifiacate(<?php echo $editdata['certification_files']; ?>)</a>
                                    <?php }} ?>
                                    <br />
                    				<span class="vstar" ><?php echo form_error('certification_files', '<span class="">', '</span>'); ?></span>
                    			</div>
                                
                                <div class="form-group  <?php echo (form_error('purchase_order_number'))?'error':'';?>" data-error="<?php echo (form_error('purchase_order_number'))? form_error('purchase_order_number'):'';?>">
                                  <label class="col-md-4">Purchase Order Number</label>
                                  <input type="text" name="purchase_order_number" class="form-control col-md-8" id="purchase_order_number" value="<?php echo set_value('purchase_order_number', $editdata['purchase_order_number']);?>" placeholder="Purchase Order Number" />
                                </div>
                                
                                <div class="form-group  <?php echo (form_error('purchase_transportation_identifier'))?'error':'';?>" data-error="<?php echo (form_error('purchase_transportation_identifier'))? form_error('purchase_transportation_identifier'):'';?>">
                                  <label class="col-md-4">Purchase Transportation Identifier</label>
                                  <input type="text" name="purchase_transportation_identifier" class="form-control col-md-8" id="purchase_transportation_identifier" value="<?php echo set_value('purchase_transportation_identifier', $editdata['purchase_transportation_identifier']);?>" placeholder="Purchase Transportation Identifier" />
                                </div>
                                
                                <div class="form-group  <?php echo (form_error('sales_transportation_identifier'))?'error':'';?>" data-error="<?php echo (form_error('sales_transportation_identifier'))? form_error('sales_transportation_identifier'):'';?>">
                                  <label class="col-md-4">Sale Transportation Identifier(s)</label>
                                  <input type="text" name="sales_transportation_identifier" class="form-control col-md-8" id="sales_transportation_identifier" value="<?php echo set_value('sales_transportation_identifier', $editdata['sales_transportation_identifier']);?>" placeholder="Sales Transportation Identifier" />
                                </div>
                                <div class="form-group <?php echo (form_error('warehouse_id'))?'error':'';?>" data-error="<?php echo (form_error('warehouse_id'))? form_error('warehouse_id'):'';?>">
                                  <label required class="col-md-4">Warehouse</label>
                                  <select class="form-control col-md-8" name="warehouse_id" id="warehouse_id">
                                    <option value="">---Select---</option>
                                      <?php foreach($warehouse as $type):
                                          $sel = ($type['id'] == set_value('warehouse_id', $editdata['warehouse_id']))?'selected':'';
                                      ?>
                                        <option value="<?php echo $type['id'];?>" <?php echo $sel;?> > <?php echo $type['name'];?> </option>
                                      <?php endforeach;?>
                                  </select>
                                </div>
                                
                                <div class="form-group <?php echo (form_error('intransit_to_warehouse'))?'error':'';?>" data-error="<?php echo (form_error('intransit_to_warehouse'))? form_error('intransit_to_warehouse'):'';?>">
                                  <label>In Transit To Warehouse</label>
                                  <input type="radio" name="intransit_to_warehouse" value="Yes" <?php echo set_radio('intransit_to_warehouse', '1', ($editdata['intransit_to_warehouse']=='Yes' || $editdata['intransit_to_warehouse']=='')?TRUE:""); ?> /> Yes
                                  <input type="radio" name="intransit_to_warehouse" value="No" <?php echo set_radio('intransit_to_warehouse', '1', ($editdata['intransit_to_warehouse']=='No' || $editdata['intransit_to_warehouse']=='')?TRUE:""); ?> /> No
                                </div>
                                <div class="form-group <?php echo (form_error('intransit_to_customer'))?'error':'';?>" data-error="<?php echo (form_error('intransit_to_customer'))? form_error('intransit_to_customer'):'';?>">
                                  <label>In Transit to Customer</label>
                                  <input type="radio" name="intransit_to_customer" value="Yes" <?php echo set_radio('intransit_to_customer', '1', ($editdata['intransit_to_customer']=='Yes' || $editdata['intransit_to_customer']=='')?TRUE:""); ?> /> Yes
                                  <input type="radio" name="intransit_to_customer" value="No" <?php echo set_radio('intransit_to_customer', '1', ($editdata['intransit_to_customer']=='No' || $editdata['intransit_to_customer']=='')?TRUE:""); ?> /> No
                                </div>
                                
                                 <div class="form-group <?php echo (form_error('received_at_customer'))?'error':'';?>" data-error="<?php echo (form_error('received_at_customer'))? form_error('received_at_customer'):'';?>">
                                  <label>Received At Customer</label>
                                  <input type="radio" name="received_at_customer" value="Yes" <?php echo set_radio('received_at_customer', '1', ($editdata['received_at_customer']=="Yes" || $editdata['received_at_customer']=="")?TRUE:""); ?> /> Yes
                                  <input type="radio" name="received_at_customer" value="No" <?php echo set_radio('received_at_customer', '1', ($editdata['received_at_customer']=='No' || $editdata['received_at_customer']=="")?TRUE:""); ?> /> No
                                </div>
                                
                                 <div class="form-group <?php echo (form_error('received_in_warehouse'))?'error':'';?>" data-error="<?php echo (form_error('received_in_warehouse'))? form_error('received_in_warehouse'):'';?>">
                                  <label>Received At Warehouse</label>
                                  <input type="radio" name="received_in_warehouse" value="Yes" <?php echo set_radio('received_in_warehouse', '1', ($editdata['received_in_warehouse']=='Yes' || $editdata['received_in_warehouse']=='')?TRUE:""); ?> /> Yes
                                  <input type="radio" name="received_in_warehouse" value="No" <?php echo set_radio('received_in_warehouse', '1', ($editdata['received_in_warehouse']=='No' || $editdata['received_in_warehouse']=='')?TRUE:""); ?> /> No
                                </div>
                                
                              <!--  <div class="form-group  <?php //echo (form_error('length'))?'error':'';?>" data-error="<?php //echo (form_error('length'))? form_error('length'):'';?>">
                                  <label>Length</label>
                                  <input type="text" name="length" class="form-control" id="length" value="<?php //echo set_value('length', $editdata['length']);?>" placeholder="Length" />
                                </div>
                                <div class="form-group  <?php //echo (form_error('width'))?'error':'';?>" data-error="<?php //echo (form_error('width'))? form_error('width'):'';?>">
                                  <label>Width</label>
                                  <input type="text" name="width" class="form-control" id="width" value="<?php //echo set_value('width', $editdata['width']);?>" placeholder="Width" />
                                </div>
                                <div class="form-group  <?php //echo (form_error('height'))?'error':'';?>" data-error="<?php //echo (form_error('height'))? form_error('height'):'';?>">
                                  <label>Height</label>
                                  <input type="text" name="height" class="form-control" id="height" value="<?php //echo set_value('height', $editdata['height']);?>" placeholder="Height" />
                                </div>-->
                                <div class="form-group  <?php echo (form_error('weight'))?'error':'';?>" data-error="<?php echo (form_error('weight'))? form_error('weight'):'';?>">
                                  <label class="col-md-4">Weight</label>
                                  <input type="text" name="weight" class="form-control col-md-8" id="weight" value="<?php echo set_value('weight', $editdata['weight']);?>" placeholder="Weight" />
                                </div>
                                <div class="form-group  <?php echo (form_error('in_stock'))?'error':'';?>" data-error="<?php echo (form_error('in_stock'))? form_error('in_stock'):'';?>">
                                  <label class="col-md-4">In Stock</label>
                                  <input type="radio" name="in_stock" value="1" <?php echo set_radio('in_stock', '1', ($editdata['in_stock']==1)?TRUE:""); ?> /> Yes
                                  <input type="radio" name="in_stock" value="0" <?php echo set_radio('in_stock', '1', ($editdata['in_stock']==0)?TRUE:""); ?> /> No
                                </div>
                                <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?php echo $editdata['id'];?>">
                        
                                </div>
                                </div>
                                <div class="form-group col-md-2 col-md-offset-8">   
                                  <button type="button" class="btn btn-block" id="inventory_submit" onclick="return inventory_sub('submit');">Submit</button>
                                </div>
                                <div class="form-group col-md-2">   
                                   <input type="reset" name="reset" value="Reset" class="btn btn-block active text-center" />
                                </div>
                                <!--
<div class="form-group col-md-2 col-md-offset-8">   
                                  <a href="<?php //echo site_url('inventory');?>" class="btn btn-block active text-center">Back</a>
                                </div>
                                <div class="form-group col-md-2">   
                                  <button type="button" class="btn btn-block" id="inventory_submit" onclick="return inventory_sub();">Next</button>
                                </div>
-->
                               </form>                                
                        </div>
                        <div class="tab-pane fade tabcontent" id="tab2primary">
                            <div class="col-md-12 text-right" style="padding-bottom: 20px;">
                              <button type="button" class="btn btn-info btn-lg" id="load_image_popup" data-target="#myModal" data-toggle="modal">Upload Images</button>
                            </div>     
                         
                              <table class="table table-striped table-hover tableSite table-bordered">
                                 <thead>
                                    <th width="300px">Title</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                 </thead>
                                 <tbody>
                                   <?php 
                                       if(count($editdata['images'])>0) { 
                                         foreach($editdata['images'] as $ekey => $evalue) {
                                     ?>
                                        <tr>
                                            <td><?php echo $evalue['image_title']; ?></td>
                                            <td>
                                            <img src="<?php echo base_url(); ?>assets/images/product/<?php echo $evalue['file_name']; ?>" style="width:15%;height:10%;" />
                                            </td>
                                            <td><i class="fa fa-trash-o trash" onclick="product_image_delete('<?php echo $evalue['id'];?>','product_images');"></i></td>
                                        </tr>
                                 <?php }} 
                                      else { ?>
                                   <tr>
                                        <td colspan="3"><?php echo "No Images Found!"; ?></td>
                                   </tr>
                                  <?php
                                    
                                 }?>
                                 </tbody>
                              </table>
                        </div>
                        <div class="tab-pane fade tabcontent" id="tab3primary">
                            <div class="form-group col-md-12">
                               
                               <div class="col-md-12 text-right" style="padding-bottom: 20px;">
                                 <button type="button" class="btn btn-info btn-lg" onclick="get_form('inventory/vendor_add/<?=$this->uri->segment(3)?>','addVendorForm','Add Vendor',this,true);">Add New Vendor Price List</button>
                              </div> 
                                <div id="addVendorForm" class="modal fade"  role="dialog">
                                    <div class="modal-dialog"> 
                                            <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                            <h3 id="myModalLabel"></h3>
                                        </div>
                                        <div class="modal-body" style="height:60%;overflow:auto"></div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                            <button class="btn btn-primary" onclick="add_vendor_price_lists('inventory/vendor_add/<?=$this->uri->segment(3)?>','addVendorForm');">Submit</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <table class="table table-striped table-hover tableSite table-bordered">
                                 <tr>
                                    <td>SKU</td>
                                    <td>COST</td>
                                    <td>IN STOCK</td>
                                    <td>SHIPPING COST</td>
                                    <td>SHIPPING SERVICE</td>
                                    <td>ACTION</td>
                                 </tr>
                                   <?php 
                                       if(count($editdata['pricelts'])>0) { 
                                         foreach($editdata['pricelts'] as $ekey => $evalue) {
                                     ?>
                                        <tr>
                                            <td><?php echo $evalue['sku']; ?></td>
                                            <td><?php echo $evalue['cost']; ?></td>
                                            <td><?php echo $evalue['in_stock']; ?></td>
                                            <td><?php echo $evalue['shipping_cost']; ?></td>
                                            <td><?php echo $evalue['shipping_service']; ?></td>
                                            <td><i class="fa fa-trash-o trash" onclick="product_image_delete('<?php echo $evalue['id']; ?>','vendor_price_list');"></i></td>
                                        </tr>
                                 <?php }} 
                                      else { ?>
                                   <tr>
                                    <td colspan="3"><?php echo "No Price lists Found!"; ?></td>
                                   </tr>
                                  <?php
                                  }
                                 ?>
                              </table>
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
      $cert_url = site_url()."assets/uploads/product/certificate/".$editdata['certification_files'];
      $preview_certificate = (isset($editdata['certification_files']) && !empty($editdata['certification_files']))?"<a href='$cert_url' class='file-preview-image' alt='Product Certificate' title='Product Certificate'>":"";
      $prev_img = (isset($editdata['file_name']) && !empty($editdata['file_name']))?"<img src='$img_url' class='file-preview-image' alt='Product Image' title='Product Image'>":""; 
 ?>

<script>
var prv_certificate = "<?php echo $preview_certificate; ?>";
var prv_img = "<?php echo $prev_img; ?>";
var page = '';
var Id = 'product_upload_image';
var hover_id = '';

$(function(){
    //alert(namespace);
    if(namespace == 'inventory_add'){
        
        $('#ProductTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    
      var product_id = $("#edit_id").val();
      if(product_id==''){
        if(namespace == 'inventory_add'){
            $('#ProductTabs a').not(":first").unbind("click");
            $('#ProductTabs li').not(":first").click(function(){
                bootbox.alert("Please Enter General Info");
            });
        } 
      }
      else
      {
        //$("#ProductTabs a:first").trigger("click");
        //$('#ProductTabs a').attr("data-toggle",'tab').trigger('click');
      }
        $("#ProductTabs a:first").trigger("click");
    }
    
    if(namespace=='upload_inventory_index'){
        $("#upload_variations li a:first").trigger('click'); 
    }
});

</script>







