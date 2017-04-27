<div id="order_item_view">
<?php if($shipment_count == 0):?>
	<div class="row">
		<h2>Order Details</h2>
	</div>
	<div class="row m_bot_5">
        <a class="pull-right underline" href="javascript:void(0);" onclick="sales_update_cart('form',<?php echo $so_id;?>,this)">Edit</a>
		<table class="table table-bordered table-striped">
			<thead class="greenbg_title">
				<tr>
					<th>Product</th>
					<th>SKU</th>
					<th>QTY</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody class="white_bg">
				<?php foreach ($order as $pid=>$row): ?>
				<tr>
					<td><?php echo displayData($row['product_name'], 'product_name_link', array('id'=>$pid));?>
					</td>
					<td><?php echo $row['sku'];?>
					</td>
					<td><?php echo $row['quantity'];?>
					</td>
					<td><?php echo displayData( $row['unit_price'], 'money' );?>
					</td>
					<td><?php echo displayData( ($row['quantity']*$row['unit_price']), 'money' );?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
<?php else:?>
	<div class="row oreder-details">
		
      <div class="sales-oder-details">
	  <form method="post" id="so_form">

	<?php  foreach ($product_details as $vid => $order_detail):?>

	<?php $details = current($order_detail);?>

	<div class="row m_bot_5">
       
	
        <form name="update_status" id="update_sales_ord_status">
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
   </form> 
        </div>   
		<h2 class="pull-left">Order Details</h2> <a class="pull-left underline clr-orange" href="javascript:void(0);" onclick="sales_update_cart('form',<?php echo $so_id;?>,this)" style="margin:7px 0px 0 36px;">Edit</a>

		<div class="pull-right m_top_15">

          <!--
 <div class="btn-group">
				
    			<a class="btn btn-primary" onclick="issue_return_auth(<?php //echo $so_id;?>, this)" href="javascript:;" data-original-title="" title=""> Return </a>
            </div>
-->
		
	  </div>

    
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
					<!--
<td><input name="op_select[]" type="checkbox"
						value="<?php //echo $row['so_item_id']?>">
					</td>
-->
					<td><?php echo displayData($row['product_name'], 'product_name_link', array('id'=>$row['product_id']));?>
					</td>
					<td><?php echo $row['sku'];?>
					</td>
					<td><?php echo $row['qty'];?>
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
	</div>
	
	<?php endforeach;?>

	<div class="row m_bot_30">
		<div class="col-md-5 pull-right">

			<table width="100%" class="price_box pull-right  ash_gradiant_bg">

				<tr>
					<td width="50%" class="text-right">Purchases:</td>
					<td width="1%">&nbsp;</td>
					<?php $purchase = (float)($so_details['total_amount'] - $so_details['total_shipping'] - $so_details['total_tax']+ $so_details['total_discount']);?>
					<td width="49%" class="green"><?php echo displayData($purchase, 'money');?>
					</td>
				</tr>
				<tr>
					<td class="text-right">Shipping:</td>
					<td>&nbsp;</td>
					<td class="green"><?php echo displayData($so_details['total_shipping'], 'money');?>
					</td>
				</tr>
				<tr>
					<td class="text-right">Tax:</td>
					<td>&nbsp;</td>
					<td class="green"><?php echo displayData($so_details['total_tax'], 'money');?>
					</td>
				</tr>
				<tr>
					<td class="text-right">Discount:</td>
					<td>&nbsp;</td>
					<td class="green"><?php echo displayData($so_details['total_discount'], 'money');?>
					</td>
				</tr>
			
				<tr class="green_solid_bg">
					<td class="text-right"><b>Total:</b>
					</td>
					<td>&nbsp;</td>
					<td><b><?php echo displayData($order_total, 'money');?>
					</b>
					</td>
				</tr>

			</table>

			<?php if($so_details['payment_type']=="net"):?>
				<button type="button" class="btn m_top_10" onclick="addElement()">Add Extra Charges</button> 
			<?php endif;?>
		</div>
	</div>
	
	</form>
	</div>

	</div>
	

			

	
<?php endif;?>
</div>
