 <div class="row" id="sales_prod_select">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>
  
     <br />
     <br />
     <div class="container">
       <div class="row">
            <div class="col-md-12">
             <h2>Products to Select</h2>
                 <table class="table table-striped table-hover tableSite table-bordered">
                     <tr>
                        <td>Product Number</td>
                        <td>Product</td>
                        <td>Form</td>
                        <td>Color</td>
                        <td>Type</td>
                        <td>Equivalent</td>
                        <td>Quantity</td>
                        <td>Available</td>
                        <td>Wholesale Price</td>
                        <td>Package</td>
                        <td>Row</td>
                      </tr>
                       <?php //print_r($product_data); 
                           if(count($product_data)>0) { 
                             foreach($product_data as $ekey => $evalue) {
                         ?>
                            <tr>
                                <td> <input type="checkbox" name="product_to_ship" class="product_to_ship" value="<?php echo $evalue['id']; ?>" /> <?php echo " ".$evalue['id']; ?></td>
                                <td><?php echo $evalue['name']; ?></td>
                                <td><?php echo $evalue['formname']; ?></td>
                                <td><?php echo $evalue['colorname']; ?></td>
                                <td><?php echo $evalue['item_type']; ?></td>
                                <td><?php echo $evalue['equivalent']; ?></td>
                                <td><?php echo $evalue['quantity']; ?></td>
                                <td><?php echo $evalue['quantity']; ?></td>
                                <td><?php echo $evalue['wholesale_price']; ?></td>
                                <td><?php echo $evalue['packagename']; ?></td>
                                <td><?php echo $evalue['row']; ?></td>
                            </tr>
                     <?php }} 
                          else { ?>
                       <tr>
                        <td colspan="11"><?php echo "No Products Found!"; ?></td>
                       </tr>
                      <?php
                        
                     }?>
                  </table>
            </div>
       </div>
       </div>
          
      <br />
      <br />
      <div class="container">
      <div class="row">
            <div class="col-md-12">
             <h2>Products in Shipping Order</h2>
                 <table class="table table-striped table-hover tableSite table-bordered">
                     <tr>
                        <td>Product Number</td>
                        <td>Product</td>
                        <td>Form</td>
                        <td>Color</td>
                        <td>Type</td>
                        <td>Equivalent</td>
                        <td>Quantity</td>
                        <td>Available</td>
                        <td>Wholesale Price</td>
                        <td>Package</td>
                        <td>Row</td>
                      </tr>
                       <?php //print_r($editdata['images']); 
                           if(count($editdata['images'])>0) { 
                             foreach($editdata['images'] as $ekey => $evalue) {
                         ?>
                            <tr>
                                <td><?php echo $evalue['image_title']; ?></td>
                                <td><img src="<?php echo base_url(); ?>assets/images/product/<?php echo $evalue['file_name']; ?>" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                     <?php }} 
                          else { ?>
                       <tr>
                        <td colspan="11"><?php echo "No Products Found!"; ?></td>
                       </tr>
                      <?php
                        
                     }?>
                  </table>
            </div>
       </div>
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
            <button type="button" class="col-md-2 btn btn-block">Save SO</button>
         </div>
         <div class="col-md-2">   
            <button type="button" class="col-md-2 btn btn-block">Create New SO</button>
         </div>
       </div>
       </div>
  
    <!-- Modal -->
<div id="product_ship" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
       <input type="hidden" name="product_ids" id="product_ids" />
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
  Warehouse<input type="radio" name="product_from" value="warehouse" /> 
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
            <input type="text" name="quantity_available" id="quantity_available"/>
        </div>
        <div class="form-group col-md-4">
            <label>Quantity to Order</label>
            <input type="text" name="quantity_to_order" id="quantity_to_order"/>
        </div>
        <div class="form-group col-md-4">
            <label>Price</label>
            <input type="text" name="price" id="price"/>
        </div>
       </div>
     </div>  
     <div class="row">
        <div class="form-group col-md-4">
            
            <input type="button" name="cancel" data-dismiss="modal" class="btn btn-block" id="cancel" value="Cancel" />
        </div>
        <div class="form-group col-md-4">
            
            <input type="button" name="confirm" id="confirm" class="btn btn-block" value="Confirm"/>
        </div>
     </div>
      <!--
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
-->
    </div>

  </div>
</div>  
</div>  
