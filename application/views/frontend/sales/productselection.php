 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>
  <form name="inventorycolor" method="POST">
  <div class="row">
      <div class="form-grid col-md-4">
            <div class="form-group" >
              <label>Shipping Order</label>
              <input type="text" name="shipping_order" class="form-control" id="shipping_order" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>Product</label>
              <select class="form-control" name="product_id" id="product_id" multiple="multiple">
                   <?php foreach($products as $prod):
                     
                   ?>
                    <option value="<?php echo $prod['id'];?>"  > <?php echo $prod['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group">
              <label>Form</label>
              <select class="form-control" name="form_id" id="form_id" multiple="multiple">
                   <?php foreach($forms as $form):
                      
                   ?>
                    <option value="<?php echo $form['id'];?>"  > <?php echo $form['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label>Packaging</label>
              <select class="form-control" name="packaging" id="packaging" multiple="multiple">
                   <?php foreach($packages as $pack):
                     
                   ?>
                    <option value="<?php echo $pack['id'];?>" > <?php echo $pack['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
           
        </div>
        <div class="form-grid col-md-4">
            <div class="form-group" >
              <label>Customer Number</label>
              <input type="text" name="customer_number" class="form-control" id="customer_number" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>Customer Name</label>
              <input type="text" name="customer_name" class="form-control" id="customer_name" value="" placeholder="" />
            </div>
             <div class="form-group" >
              <label>Color</label>
              <select class="form-control" name="color_id" id="color_id" multiple="multiple">
                   <?php foreach($colors as $clr):
                      
                   ?>
                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label>Notes</label>
              <select class="form-control" name="notes[]" id="notes" multiple="multiple">
                   <?php foreach($address as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <input type="checkbox" name="customer_number" class="form-control" id="customer_number" value=""  /> Include Product On the way.
            </div>
            <div class="form-group" >
              <input type="checkbox" name="customer_number" class="form-control" id="customer_number" value="" /> Ordered But Not Shipped
            </div>
            <div class="form-group" >
              <input type="checkbox" name="customer_number" class="form-control" id="customer_number" value="" /> In Warehouse
            </div>
        </div>
        <div class="form-grid col-md-4">
            <div class="form-group" >
              <label>Type</label>
              <input type="text" name="type" class="form-control" id="type" value="" />
            </div>
            <div class="form-group" >
              <label>Equivalent</label>
              <input type="text" name="equivalent" class="form-control" id="equivalent" value="" />
            </div>
            
            <div class="form-group" >
              <label>Quantity</label>
              <input type="text" name="quantity" class="form-control" id="quantity" value="" />
            </div>
            
            <div class="form-group" >
              <label>Row</label>
              <input type="text" name="row" class="form-control" id="row" value="" />
            </div>
            <div class="form-group" >
              <label>Units</label>
              <input type="text" name="units" class="form-control" id="units" value="" />
            </div>
            <div class="form-group" >
              <label>Wholesale</label>
              <input type="text" name="wholesale" class="form-control" id="wholesale" value="" />
            </div>
            <div class="form-group" >
              <label>Reference</label>
              <input type="text" name="reference" class="form-control" id="reference" value="" />
            </div>
            <div class="form-group" >
              <label>Internal Lot #:</label>
              <input type="text" name="internal_lot_no" class="form-control" id="internal_lot_no" value="" />
            </div>
            <div class="form-group" >
              <label>Vendor Lot #:</label>
              <input type="text" name="vendor_lot_no" class="form-control" id="vendor_lot_no" value="" />
            </div>   
         </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-block">Who Holding</button>
            </div>
            <div class="col-md-2" style="text-align: right;">
                <button type="submit" class="btn btn-block">Search</button>
            </div>
        </div>
        </form>
     <br />
     <br />
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
          
      <br />
      <br />
      
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
          
      <br />
      <br />
            
       <div class="row">
          <div class="col-md-2">
            <button type="button" class="col-md-2 btn btn-block">Add Product to SO</button>
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