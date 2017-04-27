<div id="order_item_view">
<?php if($shipment_count == 0):?>

<?php else:?>
	<div class="row oreder-details">
		
      <div class="sales-oder-details">
	  <form method="post" id="so_form">

	<?php  foreach ($product_details as $vid => $order_detail):?>

	<?php $details = current($order_detail);?>

	<div class="row m_bot_5">
 
       
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
     <button type="button" class="btn btn-default" name="save_status" onclick="update_sales_status(<?php echo $so_id;?>, this);">SAVE</button>
    </div>
   
        </div>   
		<h2 class="pull-left">Order Details</h2> 
        <button type="button" class="btn pull-right btn-warning" onclick="sales_update_cart('process',<?php echo $so_id;?>,this)"><i class="fa fa-edit edit"></i>UPDATE</button>
<!--        <button class="pull-left underline clr-orange" onclick="sales_update_cart('process',<?php //echo $so_id;?>,this)"  style="margin:7px 0px 0 36px;">UPDATE</button>-->
       <form name="sales_update_to_cart" id="sales_update_to_cart">
       <input type="hidden" name="item_type" id="item_type" value="sales" />
       <input type="hidden" name="form_access" id="form_access"  />
		<table class="table table-bordered table-striped">
			<thead class="greenbg_title">
				<tr>
					<th>Product</th>
					<th>SKU</th>
					<th>QTY</th>
					<th>Unit Price</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody class="white_bg">
				<?php  foreach ($order_detail as $row):?>
				
				<tr>
                    <input type="hidden" name="sales_order_item_id[]" value="<?php echo $row['soi_id']; ?>" />
					<td><?php echo displayData($row['product_name'], 'product_name_link', array('id'=>$row['product_id']));?>
					</td>
					<td><?php echo $row['sku'];?>
					</td>
					<td><input type="text" name="update_qty[]" value="<?php echo $row['qty'];?>" />
					</td>
					<td><?php echo displayData( $row['unit_price'], 'money' );?>
					</td>
					<td><?php echo displayData( ($row['qty']*$row['unit_price']), 'money' );?>
					</td>
					<td><?php echo $row['item_status'];?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
        </form>
	</div>
	
	<?php endforeach;?>

	
	
	</form>
	</div>

	</div>
	

			

	
<?php endif;?>
</div>
