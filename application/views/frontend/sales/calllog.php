 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>


  <form name="inventorycolor" method="POSt" class="call-log">
    <div class="container">

  <div class="row">
      <div class="form-grid panel panel-default panel-bor custom-form-log">

      <div class="panel-heading formcontrol-box">
        <div class="form-group col-md-4">
          <label class="col-md-3">Call Time</label>
          <select name="call_time" multiple="multiple" class="col-md-9">
            <option></option>
          </select>
        </div>        
              
        <div class="form-group col-md-4" >
          <label class="col-md-3">Call Time</label>
          <input type="text" name="call_time" class="form-control col-md-9" id="call_time" value=""/>
        </div>

        <div class="form-group col-md-4" >
          <label class="col-md-3">Call Type</label>
          <select name="call_type" multiple="multiple" class="col-md-9">
            <option></option>
          </select>
        </div>
    </div>
    </div>
     </div>

      <div class="row">
          <div class="form-grid panel panel-default panel-bor custom-form-log1">
       <div class="panel-heading formcontrol-box">
      <div class="form-group" >
          <label class="col-md-1">Call Log</label>
          <textarea name="call_log" id="call_log" class="col-md-11 call-log"></textarea>
        </div>
        </div>
        </div>
        </div>
      </form>
    
     <div class="container calllog-control custom-form-log2">
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
