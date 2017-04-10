 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="container search-form">
  <div class="row">

  <form name="inventorycolor" method="POSt">
      <div class="form-grid col-md-6 panel panel-default panel-bor">
      <div class="panel-heading formcontrol-box search-f1">

        <div class="form-group col-md-6">
          <label class="col-md-3">Customer Number</label>
          <input type="text"  name="customer_number" class="form-control" id="customer_number"  />
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-3">Customer Name</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>

        </div>
        
        <!-- panel one-->
        
        <div class="panel-heading formcontrol-box">
        <div class="form-group" >
          <label class="col-md-4">Contact Name</label>
          <input type="text" name="contact_name" class="form-control col-md-8" id="contact_name" value=""  />
        </div>
        <div class="form-group" >
          <label class="col-md-4">Number</label>
          <input type="text" name="contact_number" class="form-control col-md-8" id="contact_number" />
        </div>
        <div class="form-group">
          <label class="col-md-4">Contact Email</label>
          <input type="text" name="contact_email" class="form-control col-md-8" id="contact_number" />
        </div>
        </div>
        <!-- panel two-->
         <div class="panel-heading formcontrol-box second-box">
        <h2>Bill To</h2>
        <div class="form-group">
          <label class="col-md-4">Name</label>
          <input type="text" name="bill_name" class="form-control col-md-8" id="bill_name" />
        </div>
        <div class="form-group">
          <label class="col-md-4">Address</label>
          <input type="text" name="bill_address" class="form-control col-md-8" id="bill_address" />
        </div>
        <div class="form-group">
          <label class="col-md-4">Address 2</label>
          <input type="text" name="bill_address2" class="form-control col-md-8" id="bill_address2" />
        </div>
        <div class="form-group clearfix postal">
        <div class="form-group col-md-2 city">
          <label>City</label>
          <input type="text" name="city" class="form-control" id="city" />
        </div>
        
        <div class="form-group col-md-2">
          <label>State</label>
          <input type="text" name="state" class="form-control" id="state" />
        </div>
        <div class="form-group col-md-2 zip">
          <label>Zip</label>
          <input type="text" name="zip" class="form-control" id="zip" />
        </div>
        </div>
        <div class="form-group ">
          <label class="col-md-4">Website</label>
          <input type="text" name="website" class="form-control col-md-8" id="website" />
        </div>
        <div class="row active-css">
        <div class="col-md-6">
        <div class="form-group">
          <input type="checkbox" name="active" class="" id="active" />
           <label>Active</label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="vendor" class="" id="vendor" />
           <label>Vendor</label>
        </div>
        <div class="form-group">
          <input type="checkbox" name="customer" class="" id="customer" />
          <label>Customer</label>
        </div>
      </div>
      <div class="col-md-6">
        
        <div class="form-group ">
          <label>UPS</label>
          <input type="text" name="ups" class="form-control" id="ups" />
        </div>
        </div>
        </div>
        
        
        </div>
      </div>
      <div class="form-grid col-md-6 panel panel-default panel-bor">
      <div class="panel-heading">
      <div class="call-group">
        <div class="form-group call">
          <label>Last Call Search</label>
          <input type="text"  name="customer_number" class="form-control" id="customer_number"  />
        </div>
        <div class="form-group time">
          <label>&nbsp;</label>
          <input type="text" class="form-control"  name="time" id="time"  />
        </div>
        <div class="form-group time-choose">
            <br />
            <select class="form-control">
            <option value="volvo"> < </option>
            <option value="saab"> > </option>
            </select> 
        </div>
        <div class="form-group use">
        <br />
          <input type="checkbox"  name="customer_number" id="customer_number"  />
          <label>Use ?</label>
        </div>
        </div>
        <div class="call-group">
        <div class="form-group call">
          <label>Call Back Search</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
        <div class="form-group time">
          <label>&nbsp;</label>
          <input type="text"  name="time" class="form-control" id="time"  />
        </div>
        <div class="form-group time-choose">
            <br />
            <select class="form-control">
            <option value="volvo"> < </option>
            <option value="saab"> > </option>
            </select> 
        </div>
        <div class="form-group use">
        <br />
          <input type="checkbox"  name="customer_number" id="customer_number"  />
          <label>Use ?</label>
        </div>
        </div>
        
        <div class="form-group" >
          <label>Call Person</label>
          <select name="call_person" multiple="multiple" class="form-control select-box">
           <?php if(count($users)>0) {
                     foreach($users as $ukey => $uvalue){  
            ?>
                <option value="<?php echo $uvalue['id']; ?>"><?php echo $uvalue['business_name']; ?></option>
            <?php
           }} ?>
          </select>
        </div>
        </div>
        <div class="panel-heading">
        <div class="form-group " >
          <label>Credit</label>
          <select name="call_person" multiple="multiple"  class="form-control select-box">
          <option value="none">None</option>
           <?php if(count($credit)>0) {
                     foreach($credit as $ckey => $cvalue){  
            ?>
                <option value="<?php echo $cvalue['id']; ?>"><?php echo $cvalue['name']; ?></option>
            <?php
           }} ?>
          </select>
        </div>
        </div>
        
        <div class="panel-heading">
        <h2>Location</h2>
        <div class="row">
        <div class="form-group col-md-3" >
          <label>Start Time</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
        <div class="form-group col-md-3" >
          <label>End Time</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
         <div class="form-group col-md-3" >
          <label>Time Zone</label>
          <input type="text" name="customer_name" class="form-control" id="customer_name" value=""/>
        </div>
         <div class="form-group col-md-3" >
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
        </div>
        <div class="formcontrol-box">
        <div class="form-group">
          <label class="col-md-4">Address</label>
          <input type="text" name="loc_address" class="form-control col-md-8" id="loc_address" />
        </div>
        <div class="form-group">
          <label class="col-md-4">Address 2</label>
          <input type="text" name="loc_address2" class="form-control col-md-8" id="loc_address2" />
        </div>
        </div>
        <div class="row">
        <div class="form-group col-md-4">
          <label>City</label>
          <input type="text" name="loc_city" class="form-control" id="loc_city" />
        </div>
        <div class="form-group col-md-4">
          <label>State</label>
          <input type="text" name="loc_state" class="form-control" id="loc_state" />
        </div>
        <div class="form-group col-md-4">
          <label>Zip</label>
          <input type="text" name="loc_zip" class="form-control" id="loc_zip" />
        </div>
        </div>
        <div class="form-group">
          
          <input type="checkbox" name="use_times_of_operation" id="use_times_of_operation" />
          <label>Use Times of Opereation</label>
        </div>
        <div class="form-group">
          
          <input type="checkbox" name="use_address" id="use_address" />
          <label>Use Address</label>
        </div>
        </div>
      </div>  
    
     <div class="container sales-cntrl-btn">
     <div class="row">   
        <div class="form-group col-md-2">
          <input type="reset" class="btn btn-block" name="reset" value="Clear Form" />
        </div> 
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Search</button>
        </div>
    </div>
    </div>

  </form>
</div>
</div>  
