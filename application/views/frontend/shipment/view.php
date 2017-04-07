<div class="container ma-top shipmend-sec">
<div class="row">
  <div class="col-md-12">
  <form name="update_ship_status" method="POST" >
        <h3>Shipping Type <?php echo $ship_data['shipping_type']; ?></h3>
    <div class="form-group ">
      <label>Carrier</label>
      <select name="carrier" class="form-group">
        <option value="">Select Carrier</option>
        <?php if(count($carrier)>0){ foreach($carrier as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id'];?>" <?php echo set_select('carrier',$cvalue['id'],(($ship_data['ship_company'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group ">
      <label>Status</label>
      <select name="status" class="form-group">
        <option value="">Select Status</option>
        <?php if(count($status)>0){ foreach($status as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('status',$cvalue['id'],(($ship_data['order_status'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
     <div class="form-group ">
      <label>Status</label>
      <select name="status" class="form-group">
        <option value="">Select Status</option>
        <?php if(count($status)>0){ foreach($status as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('status',$cvalue['id'],(($ship_data['order_status'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
 <div class="form-group ">
      <label>Status</label>
      <select name="status" class="form-group">
        <option value="">Select Status</option>
        <?php if(count($status)>0){ foreach($status as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('status',$cvalue['id'],(($ship_data['order_status'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>

    <div class="form-group">
        <input type="submit" name="update_shp_type" class="btn btn-default" value="SAVE" />
    </div>
  </form>  
</div>
</div>
</div>