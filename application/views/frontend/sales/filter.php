<form name="advance_search_form" id="advance_search_form" method="POST" class="product-sel">
  <div class="container ship-order">
  <div class="row">
      <div class="form-grid col-md-6 panel panel-default panel-bor">
      <div class="panel-heading formcontrol-box">
            <div class="form-group" >
              <label class="col-md-4">Shipping Order</label>
              <input type="text" name="shipping_order" class="form-control col-md-8" id="shipping_order" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">Customer Name</label>
              <input type="text" name="customer_name" class="form-control col-md-8" id="customer_name" value="" placeholder="" />
            </div>
            <div class="form-group">
              <label class="col-md-4">Amount</label>
              <input type="text" name="amount" class="form-control col-md-8" id="amount" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">Salesman</label>
              <select class="form-control col-md-8" name="packaging" id="packaging" >
                   <?php foreach($salesman as $pack):
                     
                   ?>
                    <option value="<?php echo $pack['id'];?>" > <?php echo $pack['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
             <div class="form-group" >
              <label class="col-md-4">Customer Location</label>
              <select class="form-control col-md-8" name="customer_location" id="customer_location" multiple="multiple">
                   <?php foreach($custlocation as $clr):
                      
                   ?>
                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label class="col-md-4">Address</label>
              <input type="text" name="address" class="form-control col-md-8" id="address" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">Address 2</label>
              <input type="text" name="address_2" class="form-control col-md-8" id="address_2" value="" placeholder="" />
            </div>
             <div class="form-group clearfix postal">
            <div class="form-group col-md-2 city" >
              <label>City</label>
              <input type="text" name="address_2" class="form-control" id="address_2" value="" placeholder="" />
            </div>
            <div class="form-group col-md-2" >
              <label>State</label>
              <select class="form-control" name="state" id="state" multiple="multiple">
                   <?php foreach($state as $clr):
                      
                   ?>
                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group col-md-2 zip" >
              <label>Zipcode</label>
              <input type="text" name="zipcode" class="form-control" id="zipcode" />
            </div>
            </div>
            <div class="form-group active-css" >
              
              <input type="checkbox" name="pending" class="" id="pending" /> 
              <label>Pending</label>
            </div>
        </div>
        </div>
        <div class="form-grid col-md-6 panel panel-default panel-bor">
        <div class="panel-heading formcontrol-box ship-box">
            
            
            
            <div class="form-group" >
              <label class="col-md-4">Terms</label>
              <select class="form-control col-md-8" name="notes[]" id="notes" multiple="multiple">
                   <?php foreach($terms as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label class="col-md-4">Payment By</label>
              <select class="form-control col-md-8" name="notes[]" id="notes" >
                   <?php foreach($paymentby as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label class="col-md-4">COD Fee:</label>
              <input type="text" name="cod_fee" class="form-control col-md-8" id="cod_fee" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">Freight Fee:</label>
              <select class="form-control col-md-8" name="freight_fee" id="notes" >
                   <?php foreach($freight_fee as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            
            <div class="form-group" >
              <label class="col-md-4">Preferred Carrier:</label>
              <select class="form-control col-md-8" name="freight_fee" id="notes" >
                   <?php foreach($pre_carrier as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            
            <div class="form-group" >
              <label class="col-md-4">Ship Date</label>
              <input type="text" name="row" class="form-control col-md-8" id="row" value="" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">Total Weights:</label>
              <input type="text" name="units" class="form-control col-md-8" id="units" value="" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">BOL Instructions: </label>
              <textarea name="bol_instructions" id="bol_instructions" class="form-control col-md-8"></textarea>
            </div>
            <div class="form-group" >
              <label class="col-md-4">Shipping Instructions :</label>
              <textarea name="shipping_instructions" id="shipping_instructions" class="form-control col-md-8"></textarea>
            </div>
           
         </div>
         </div>
         </div>
        </div>
      
        </form>
       