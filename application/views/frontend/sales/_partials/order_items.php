<?php //print_r($product_details); 
      //foreach ($product_details as $vid => $order_detail):?>

	<?php $details = current($order_detail);?>

	<div class="row m_bot_5">
		<h2 class="pull-left">Order Details</h2> 
        <form name="sales_update_to_cart_edit" id="sales_update_to_cart_edit">
        <button type="button" class="btn pull-right btn-warning" onclick="sales_update_cart('process',<?php echo $so_id;?>,'sales','#sales_update_to_cart_edit',this)"><i class="fa fa-edit edit"></i>UPDATE</button>
<!--    <button class="pull-left underline clr-orange" onclick="sales_update_cart('process',<?php //echo $so_id;?>,this)"  style="margin:7px 0px 0 36px;">UPDATE</button>-->
       
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
				<?php  foreach ($order_detail as $row): ?>
				<tr>
                    <input type="hidden" name="sales_order_item_id[]" value="<?php echo $row['so_item_id']; ?>" />
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
	
	<?php //endforeach;?>
