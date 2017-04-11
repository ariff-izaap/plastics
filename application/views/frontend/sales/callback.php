 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>
  
  <form name="inventorycolor" method="post" class="call-back">
    <div class="container custom-callback">

  <div class="row">
    <div class="form-grid panel panel-default panel-bor callback-box1">
      <div class="panel-heading formcontrol-box">
      <div class="col-md-4">
        <div class="form-group"  >
           <label class="col-md-4">Call Time</label>
          <select name="call_time" multiple="multiple" class="form-control col-md-8">
            <option></option>
          </select>
        </div>
        
      </div>
      <div class="col-md-4">
        <div class="form-group">
         <label class="col-md-4">Date and Time</label>
          <input type="text" name="date_time" class="form-control col-md-8" id="date_time" value=""/>
        </div>
         <div class="form-group callback-chckbx">
          <input type="checkbox" name="date_time" id="date_time" value=""/>
          <label>Repeat Same Day Every Year</label>
        </div> 
      </div>
      <div class="col-md-4">
            <div class="form-group" >
          <label class="col-md-4">Salesman to Notify</label>
          <select name="salesman_to_notify" multiple="multiple" class="form-control col-md-8">
            <option></option>
          </select>
        </div>
      
      </div>
      </div>
      </div>
         </div>
         <div class="row">
          <div class="form-grid panel panel-default panel-bor callback-box2">
       <div class="panel-heading formcontrol-box">
      <div class="form-group" >
          <label class="col-md-2">Call Back Message</label>
          <textarea name="callback_message" id="callback_message" class="form-control col-md-10"></textarea>
        </div>
        </div>
        </div>
        </div>
     </div>
   
     <div class="container">
     <div class="row">    
        <div class="form-group col-md-2">
          <input type="reset" class="btn btn-block" name="reset" value="Clear Form" />
        </div>
        <div class="form-group col-md-2">
          <button type="button" class="btn btn-block">Delete</button>
        </div>
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Save</button>
        </div>
    </div>
    </div>
  </form>

</div>  
