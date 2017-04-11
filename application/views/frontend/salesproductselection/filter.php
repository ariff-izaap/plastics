<form name="advance_search_form" id="advance_search_form" method="POST" class="product-sel">
  <div class="container custom-product-selctn">
  <div class="row">
      <div class="form-grid col-md-3 panel panel-default panel-bor">
       <div class="panel-heading formcontrol-box prod-sel">
            <div class="form-group" >
              <label class="col-md-6">Shipping Order</label>
              <input type="text" name="shipping_order" class="form-control col-md-6" id="shipping_order" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label class="col-md-6">Product</label>
              <select class="form-control col-md-6" name="name" id="name" multiple="multiple" >
                   <?php $products = get_products(); 
                  
                         foreach($products as $prod): ?>
                    <option value="<?php echo $prod['name'];?>"  > <?php echo $prod['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group">
              <label class="col-md-6">Form</label>
              <select class="form-control productform col-md-6" name="form_id" id="form_id" multiple="multiple">
                   <?php $forms = get_forms(); 
                     foreach($forms as $form): ?>
                    <option value="<?php echo $form['id'];?>"  > <?php echo $form['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label class="col-md-6">Packaging</label>
              <select class="form-control productpackage col-md-6" name="package_id" id="package_id" multiple="multiple">
                   <?php $packages = get_packages(); 
                       foreach($packages as $pack):
                     
                   ?>
                    <option value="<?php echo $pack['id'];?>" > <?php echo $pack['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
          </div> 
        </div>


        <div class="form-grid col-md-3 panel panel-default panel-bor">
         <div class="panel-heading formcontrol-box prod-sel">
            <div class="form-group" >
              <label class="col-md-6">Customer Number</label>
              <input type="text" name="customer_number" class="form-control col-md-6" id="customer_number" value="" placeholder="" />
            </div>
            <div class="form-group" >
              <label class="col-md-6">Customer Name</label>
              <input type="text" name="customer_name" class="form-control col-md-6" id="customer_name" value="" placeholder="" />
            </div>
             <div class="form-group" >
              <label class="col-md-6">Color</label>
              <select class="form-control productcolor col-md-6" name="color_id" id="color_id" multiple="multiple">
                   <?php $colors = get_colors();
                    foreach($colors as $clr):
                      
                   ?>
                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group" >
              <label class="col-md-6">Notes</label>
              <select class="form-control productnotes col-md-6" name="notes" id="notes" multiple="multiple">
                   <?php foreach($address as $addr):
                      $sel = ($addr['id'] == set_value('address_id', $editdata['address_id']))?'selected':'';
                   ?>
                    <option value="<?php echo $addr['id'];?>" <?php echo $sel;?> > <?php echo $addr['address1'];?> </option>
                  <?php endforeach;?>
              </select>
            </div>
            <div class="form-group p-s-checbx">
              <input type="checkbox" name="include_product_on_the_way" class="" id="include_product_on_the_way" value=""  /> Include Product On the way.
            </div>
            <div class="form-group p-s-checbx">
              <input type="checkbox" name="ordered_but_not_shipped" class="" id="ordered_but_not_shipped" value="" /> Ordered But Not Shipped
            </div>
            <div class="form-group p-s-checbx">
              <input type="checkbox" name="received_in_warehouse" class="" id="received_in_warehouse" value="Yes" /> In Warehouse
            </div>
            </div>
        </div>


        <div class="form-grid col-md-3 panel panel-default panel-bor">
         <div class="panel-heading formcontrol-box">
            <div class="form-group" >
              <label class="col-md-6">Type</label>
              <input type="text" name="type" class="form-control col-me-6" id="type" value="" />
            </div>
            <div class="form-group" >
              <label class="col-md-6">Equivalent</label>
              <input type="text" name="equivalent" class="form-control col-md-6" id="equivalent" value="" />
            </div>
            
            <div class="call-group2 s-p-quantity">

            <div class="form-group col-md-6">
              <label class="col-md-6">Quantity</label>
              <input type="text" name="quantity" class="form-control col-md-6" id="quantity" value="" />
            </div>

             <div class="form-group col-md-1">              
             <select class="form-control" name="quantity_uses">
                <option value="lessthan"> < </option>
                <option value="greaterthan"> > </option>
            </select>
            </div>

             <div class="form-group col-md-5">              
              <input type="checkbox" name="quantity_uses_check" class="col-md-5" id="row"  />
              <label class="col-md-7">Uses ?</label>
            </div>

            </div>
            
            <div class="call-group1 s-p-quantity1">
            <div class="form-group col-md-6">
              <label class="col-md-6">Row</label>
              <input type="text" name="row" class="form-control col-md-6" id="row"  />
            </div>
             <div class="form-group col-md-6">
              <input type="checkbox" name="row_uses_check" class="col-md-6" id="row_uses_check" value="" />
              <label class="col-md-6">Uses ?</label>
            </div>
            </div>
           </div>
         </div>


         <div class="form-grid col-md-3 panel panel-default panel-bor">
         <div class="panel-heading formcontrol-box">
            <div class="call-group1">
            <div class="form-group" >
               <label>Units</label>
              <input type="text" name="units" class="form-control" id="units" value="" />
            </div>
             <div class="form-group" >
              
              <input type="checkbox" name="units_uses_check" class="" id="units_uses_check" value="" />
              <label>Uses ?</label>
            </div>
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


        </div>
        <div class="row button-sec">
            <div class="col-md-8"></div>
            <div class="col-md-4 clear-btn">
                <button type="submit" class="btn btn-block">Who Holding</button>
                 <a href="javascript:void(0)" class="btn btn-sm active" onclick="$.fn.clear_advance_search();">Clear</a>
                <button type="button" class="btn btn-block" onclick="$.fn.submit_advance_search_form();">Search</button>
            </div>
           
               
              <!--
  <input type="button" id="salesorder_product_search" onclick="sales_product_search();" class="btn btn-block" value="Search" />
-->
            </div>
        </div>
        </div>
        </form>