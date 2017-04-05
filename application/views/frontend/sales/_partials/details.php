<?php if($shipment_count == 0):?>
	<div class="row">
		<h2>Order Details</h2>
	</div>
	<div class="row m_bot_5">
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
				<?php 
				if($row['sales_channel_id'] == 7 || $row['sales_channel_id'] == 8)
				{
					$where = array('product_id' => $pid, 'amazon_sku' => $row['api_sku']);
					$details = get_product_details($where, $row['sales_channel_id']);
					if($details !== FALSE)
					{
						$row['product_name'] = $details['pro_name'];
					}
				}
				?>
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
		<h2 class="pull-left">Order Details</h2> 

		<div class="pull-right m_top_15">

           <div class="btn-group">
				
    			<a class="btn btn-primary"
    			onclick="issue_return_auth(<?php echo $so_id;?>, this)"
    			href="javascript:;" data-original-title="" title="">Issue Return
    			Auth</a>
            </div>
		
	  </div>

	</div>
	

			
	<form method="post" id="so_form">

	<?php  foreach ($product_details as $vid => $order_detail):?>

	<?php $details = current($order_detail);?>

	<div class="row m_bot_5">
		<table class="table table-bordered m_bot_10">
			<tbody class="light_green_bg green">
				<tr>
					<td width="33%" align="left">Vendor: <span class="black"><?php echo $details['vendor_name'];?>
					</span>
					</td>
					<td width="33%" class="text-center"><?php echo $details['shipment_method'];?>
					</td>
					<td width="33%" class="text-right">Shipment status: <?php echo $details['shipment_status'];?>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered table-striped">
			<thead class="greenbg_title">
				<tr>
					<th></th>
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
					<td><input name="op_select[]" type="checkbox"
						value="<?php echo $row['so_item_id']?>">
					</td>
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
		<div class="span4 pull-right">
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
	<?php if($so_details['payment_type']=="net"):?>
	<div class="row m_bot_30" id="div_charges" style="display:none;">
		<table id="pricelist" class="table table-bordered">
			<thead class="greenbg_title">
				<th>Charge Type</th>
				<th>Description</th>
				<th>Amount</th>
				<th>&nbsp;</th>
			</thead>
			<tbody class="white_bg">
				
			</tbody>
			<tfoot>
				<th colspan="4" align="center">
					<button type="button" class="btn-small" onclick="save_reconciled_salesorder_charges(<?php echo $so_id;?>, <?php echo $so_details['customer_id'];?>, this)" style="margin-left:400px;">Save</button>
				</th>
			</tfoot>
		</table>
		
	</div>

	<!-- Modal-->
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" class="modal hide fade" id="div_so_reconcile_charges">
	      <div class="modal-header">
		        <button aria-hidden="true" data-dismiss="modal" class="close" type="button" data-original-title="" title="">×</button>
		        <h3 id="myModalLabel">Reconcile Charges</h3>
		  </div>
	      <div class="modal-body">
		      <form method="post" id="edit_so_reconcile_charges">
			      	      
		      </form>
	      </div>
    </div>
	<?php endif;?>
	
<?php endif;?>
