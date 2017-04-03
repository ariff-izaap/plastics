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
              <input type="text" name="business_name" class="form-control col-md-8" id="business_name" value="" placeholder="" />
            </div>
            <div class="form-group">
              <label class="col-md-4">Amount</label>
              <input type="text" name="total_amount" class="form-control col-md-8" id="total_amount" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label class="col-md-4">Salesman</label>
              <select class="form-control col-md-8" name="salesman_id" id="salesman_id" >
                   <option>Select</option>
                   <?php $salesman = get_salesman();
                         foreach($salesman as $pack): ?>
                    <option value="<?php echo $pack['id'];?>"> <?php echo $pack['first_name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
             <div class="form-group" >
              <label class="col-md-4">Customer Location</label>
              <select class="form-control col-md-8" name="customer_location" id="customer_location" multiple="multiple">
                   <?php foreach($custlocation as $clr): ?>
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
              <input type="text" name="city" class="form-control" id="city" value="" placeholder="" />
            </div>
            <div class="form-group col-md-2" >
              <label>State</label>
              <select class="form-control" name="state" id="state" >
                   <?php $state = get_state();
                     foreach($state as $clr): ?>
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
              <select class="form-control" name="credit_type" id="credit_type" >
                   <?php  $terms = get_credit_type();
                       foreach($terms as $addr): ?>
                    <option value="<?php echo $addr['id'];?>" > <?php echo $addr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label class="col-md-4">Payment By</label>
              <select class="form-control" name="payment_by" id="payment_by" >
                   <?php $terms = get_credit_type();
                     foreach($terms as $addr): ?>
                    <option value="<?php echo $addr['id'];?>"> <?php echo $addr['name'];?> </option>
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
              <textarea name="so_instructions" id="so_instructions" class="form-control col-md-8"></textarea>
            </div>
            
          
         </div>
         </div>
            <div class="col-md-4 clear-btn">
                 <a href="javascript:void(0)" class="btn btn-sm active" onclick="$.fn.clear_advance_search();">Clear</a>
                <button type="button" class="btn btn-block" onclick="$.fn.submit_advance_search_form();">Search</button>
            </div>
         </div>
          
        </div>
          
        </form>
       