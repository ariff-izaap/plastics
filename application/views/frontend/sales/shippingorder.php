 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>
  <form name="inventorycolor" method="POST">
  <div class="row">
      <div class="form-grid col-md-6">
            <div class="form-group" >
              <label>Shipping Order</label>
              <input type="text" name="shipping_order" class="form-control" id="shipping_order" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>Customer Name</label>
              <input type="text" name="customer_name" class="form-control" id="customer_name" value="" placeholder="" />
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="text" name="amount" class="form-control" id="amount" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>Salesman</label>
              <select class="form-control" name="packaging" id="packaging" >
                   <?php foreach($salesman as $pack):
                     
                   ?>
                    <option value="<?php echo $pack['id'];?>" > <?php echo $pack['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
             <div class="form-group" >
              <label>Customer Location</label>
              <select class="form-control" name="customer_location" id="customer_location" multiple="multiple">
                   <?php foreach($custlocation as $clr):
                      
                   ?>
                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label>Address</label>
              <input type="text" name="address" class="form-control" id="address" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>Address 2</label>
              <input type="text" name="address_2" class="form-control" id="address_2" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>City</label>
              <input type="text" name="address_2" class="form-control" id="address_2" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label>State</label>
              <select class="form-control" name="state" id="state" multiple="multiple">
                   <?php foreach($state as $clr):
                      
                   ?>
                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label>Zipcode</label>
              <input type="text" name="zipcode" class="form-control" id="zipcode" />
            </div>
        </div>
        <div class="form-grid col-md-6">
            <div class="form-group" >
              
              <input type="checkbox" name="pending" class="form-control" id="pending" /> Pending
            </div>
            <div class="form-group" >
              <label>Customer Name</label>
              <input type="text" name="customer_name" class="form-control" id="customer_name" value="" placeholder="" />
            </div>
            
            <div class="form-group" >
              <label>Terms</label>
              <select class="form-control" name="notes[]" id="notes" multiple="multiple">
                   <?php foreach($terms as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label>Payment By</label>
              <select class="form-control" name="notes[]" id="notes" >
                   <?php foreach($paymentby as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label>COD Fee:</label>
              <input type="text" name="cod_fee" class="form-control" id="cod_fee" />
            </div>
            <div class="form-group" >
              <label>Freight Fee:</label>
              <select class="form-control" name="freight_fee" id="notes" >
                   <?php foreach($freight_fee as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            
            <div class="form-group" >
              <label>Preferred Carrier:</label>
              <select class="form-control" name="freight_fee" id="notes" >
                   <?php foreach($pre_carrier as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            
            <div class="form-group" >
              <label>Ship Date</label>
              <input type="text" name="row" class="form-control" id="row" value="" />
            </div>
            <div class="form-group" >
              <label>Total Weights:</label>
              <input type="text" name="units" class="form-control" id="units" value="" />
            </div>
            <div class="form-group" >
              <label>BOL Instructions: </label>
              <textarea name="bol_instructions" id="bol_instructions" class="form-control"></textarea>
            </div>
            <div class="form-group" >
              <label>Shipping Instructions :</label>
              <textarea name="shipping_instructions" id="shipping_instructions" class="form-control"></textarea>
            </div>
           
         </div>
        </div>
      
        </form>
     <br />
     <br />
       <div class="row">
            <div class="col-md-12">
             <h2>Products</h2>
                 <table class="table table-striped table-hover tableSite table-bordered">
                     <tr>
                        <td>Control Number</td>
                        <td>Product</td>
                        <td>Form</td>
                        <td>Color</td>
                        <td>Type</td>
                        <td>Rename</td>
                        <td>From Location</td>
                        <td>Quantity</td>
                        <td>Cost</td>
                        <td>Inbound Freight</td>
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
          <div class="col-md-3">
            <button type="button" class="col-md-2 btn btn-block">Create Shipment Email</button>
          </div>
          <div class="col-md-3"> 
            <button type="button" class="col-md-2 btn btn-block">Product Selection</button>
         </div>
         <div class="col-md-3">   
            <button type="button" class="col-md-2 btn btn-block">Delete Shipping Order</button>
         </div>
         <div class="col-md-3">   
            <button type="button" class="col-md-2 btn btn-block">Save Shipping Order</button>
         </div>
         
       </div>
  

</div>  
