 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
      
    </div>
  </div>

  <div class="row">

  <form name="inventorycolor" method="POSt">
      <div class="form-grid col-md-6">
        <div class="form-group col-md-4"  >
          <label>Call Time</label>
          <select name="call_time" multiple="multiple">
            <option></option>
          </select>
        </div>
        <div class="form-group col-md-4" >
          <label>Call Time</label>
          <input type="text" name="call_time" class="form-control" id="call_time" value=""/>
        </div>
        <div class="form-group col-md-4" >
          <label>Call Type</label>
          <select name="call_type" multiple="multiple">
            <option></option>
          </select>
        </div>
        <br />
        <div class="form-group" >
          <label>Call Log</label>
          <textarea name="call_log" id="call_log"></textarea>
        </div>
      </div>
      </form>
     </div>
     
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

  </form>

</div>  
