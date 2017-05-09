<div id="order_item_view">
<?php if($shipment_count == 0):?>

<?php else:?>
	<div class="row oreder-details">
		
      <div class="sales-oder-details">
	  <form method="post" id="so_form">
	</form>
    <div>
            <div class="form-group"  >
              <label>Carrier</label>
              <select name="carrier" id="carrier" class="form-group">
                <option value="">Select Carrier</option>
                <?php if(count($carrier)>0){ foreach($carrier as $ckey => $cvalue){ ?>
                 <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('carrier',$cvalue['id'],(($so_details['carrier'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
                <?php }} ?>
              </select>
            </div>
    <div class="form-group"  >
      <label>Order Status</label>
      <select name="order_status" id="order_status" class="form-group" >
         <option value="">Select Status</option>
         <option value="NEW" <?php echo set_select('order_status',"NEW",(($so_details['order_status'] == "NEW")?true:false));?>>NEW</option>
         <option value="PROCESSING" <?php echo set_select('order_status',"PROCESSING",(($so_details['order_status'] == "PROCESSING")?true:false));?>>PROCESSING</option>
         <option value="PENDING" <?php echo set_select('order_status',"PENDING",(($so_details['order_status'] == "PENDING")?true:false));?>>PENDING</option>
         <option value="COMPLETED" <?php echo set_select('order_status',"COMPLETED",(($so_details['order_status'] == "COMPLETED")?true:false));?>>COMPLETED</option>
      </select>
    </div>
    <div >
     <button type="button" class="btn btn-success access-level" name="save_status" onclick="update_sales_status(<?php echo $so_id;?>, this);"><i class="fa fa fa-life-saver"></i>SAVE</button>
    </div>
   </div> 
	
    <div id="viewOrderitems">
	  <?php $this->load->view("frontend/sales/_partials/order_items",$this->data); ?>
    </div>

	</div>

	</div>
	

			

	
<?php endif;?>
</div>
