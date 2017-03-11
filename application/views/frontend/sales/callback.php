 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>
  
  
  
  <form name="inventorycolor" method="post" class="call-back">
    <div class="container">

  <div class="row">
      <div class="form-grid col-md-4 panel panel-default panel-bor">
      <div class="panel-heading formcontrol-box">
        <div class="form-group"  >
           <label>Call Time</label>
          <select name="call_time" multiple="multiple" class="form-control">
            <option></option>
          </select>
        </div>
        
        </div>
        
        
        
    
      
        
      </div>
      <div class="form-grid col-md-4 panel panel-default panel-bor">
      
        
        <div class="panel-heading formcontrol-box">
        
        <div class="form-group" >
         <label>Date and Time</label>
          <input type="text" name="date_time" class="form-control" id="date_time" value=""/>
        </div>
         <div class="form-group" >
         
          <input type="checkbox" name="date_time" id="date_time" value=""/>
          <label>Repeat Same Day Every Year</label>
        </div>
        </div>
        
    
      
        
      </div>
      <div class="form-grid col-md-4 panel panel-default panel-bor">
       <div class="panel-heading formcontrol-box">
            <div class="form-group" >
          <label>Salesman to Notify</label>
          <select name="salesman_to_notify" multiple="multiple" class="form-control">
            <option></option>
          </select>
        </div>
        </div>
      
      </div>
      
         </div>
         <div class="row">
          <div class="form-grid col-md-12 panel panel-default panel-bor">
       <div class="panel-heading formcontrol-box">
      <div class="form-group" >
          <label>Call Back Message</label>
          <textarea name="callback_message" id="callback_message" class="form-control"></textarea>
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
