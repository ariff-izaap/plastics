 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="inventorycolor" method="POSt">
      <div class="form-grid col-md-6">
        <div class="form-group"  >
          <label>Customer Number</label>
          <input type="text"  name="customer_number" class="form-control" id="customer_number"  />
        </div>
        <div class="form-group " >
          <label>Customer Name</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
        <div class="form-group" >
          <label>Contact Name</label>
          <input type="text" name="contact_name" class="form-control" id="contact_name" value=""  />
        </div>
        <div class="form-group" >
          <label>Number</label>
          <input type="text" name="contact_number" class="form-control" id="contact_number" />
        </div>
        <div class="form-group">
          <label>Contact Email</label>
          <input type="text" name="contact_email" class="form-control" id="contact_number" />
        </div>
        <h4>Bill To</h4>.
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="bill_name" class="form-control" id="bill_name" />
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="bill_address" class="form-control" id="bill_address" />
        </div>
        <div class="form-group">
          <label>Address 2</label>
          <input type="text" name="bill_address2" class="form-control" id="bill_address2" />
        </div>
        <div class="form-group col-md-2">
          <label>City</label>
          <input type="text" name="city" class="form-control" id="city" />
        </div>
        <div class="form-group col-md-2">
          <label>State</label>
          <input type="text" name="state" class="form-control" id="state" />
        </div>
        <div class="form-group col-md-2">
          <label>Zip</label>
          <input type="text" name="zip" class="form-control" id="zip" />
        </div>
        <div class="form-group">
          <label>Website</label>
          <input type="text" name="website" class="form-control" id="website" />
        </div>
        <div class="form-group">
          <label>Active</label>
          <input type="checkbox" name="active" class="form-control" id="active" />
        </div>
        <div class="form-group">
          <label>Vendor</label>
          <input type="checkbox" name="vendor" class="form-control" id="vendor" />
        </div>
        <div class="form-group">
          <label>Customer</label>
          <input type="checkbox" name="customer" class="form-control" id="customer" />
        </div>
      </div>
      <div class="form-grid col-md-6">
        <div class="form-group"  >
          <label>Last Call Search</label>
          <input type="text"  name="customer_number" class="form-control" id="customer_number"  />
        </div>
        <div class="form-group " >
          <label>Call Back Search</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
        <div class="form-group " >
          <label>Call Person</label>
          <select name="call_person" multiple="multiple">
           <?php if(count($users)>0) {
                     foreach($users as $ukey => $uvalue){  
            ?>
                <option value="<?php echo $uvalue['id']; ?>"><?php echo $uvalue['business_name']; ?></option>
            <?php
           }} ?>
          </select>
        </div>
        <div class="form-group " >
          <label>Credit</label>
          <select name="call_person" multiple="multiple">
          <option value="none">None</option>
           <?php if(count($credit)>0) {
                     foreach($credit as $ckey => $cvalue){  
            ?>
                <option value="<?php echo $cvalue['id']; ?>"><?php echo $cvalue['name']; ?></option>
            <?php
           }} ?>
          </select>
        </div>
        <h4>Location</h4>
        <div class="form-group col-md-2" >
          <label>Start Time</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
        <div class="form-group col-md-2" >
          <label>End Time</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
         <div class="form-group col-md-2" >
          <label>Time Zone</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
         <div class="form-group col-md-6" >
          <label>Days of Week</label>
          <select name="days_of_week" multiple="multiple">
             <option value="monday">Monday</option>
             <option value="tuesday">Tuesday</option>
             <option value="wednesday">Wednesday</option>
             <option value="thursday">Thursday</option>
             <option value="friday">Friday</option>
             <option value="saturday">Saturday</option>
             <option value="sunday">Sunday</option>
          </select>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="loc_address" class="form-control" id="loc_address" />
        </div>
        <div class="form-group">
          <label>Address 2</label>
          <input type="text" name="loc_address2" class="form-control" id="loc_address2" />
        </div>
        <div class="form-group col-md-2">
          <label>City</label>
          <input type="text" name="loc_city" class="form-control" id="loc_city" />
        </div>
        <div class="form-group col-md-2">
          <label>State</label>
          <input type="text" name="loc_state" class="form-control" id="loc_state" />
        </div>
        <div class="form-group col-md-2">
          <label>Zip</label>
          <input type="text" name="loc_zip" class="form-control" id="loc_zip" />
        </div>
        <div class="form-group">
          <label>Use Times of Opereation</label>
          <input type="checkbox" name="use_times_of_operation" class="form-control" id="use_times_of_operation" />
        </div>
        <div class="form-group">
          <label>Use Address</label>
          <input type="checkbox" name="use_address" class="form-control" id="use_address" />
        </div>
      </div>  
     </div>
     
     <div class="row">   
        <div class="form-group col-md-2">
          <input type="reset" class="btn btn-block" name="reset" value="Clear Form" />
        </div> 
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Search</button>
        </div>
    </div>

  </form>

</div>  
