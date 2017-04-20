<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><strong>Invoice - #<?=$invoices[0]['invoice_no'];?></strong></h4>
</div>
<div class="modal-body" style="max-height: 450px;overflow: auto;">
	<div class="row">
		<div class="col-md-3">
			<label>Invoice Status : <strong><?=displayData($invoices[0]['invoice_status'],'colorize');?></strong></label>
		</div>
		<div class="col-md-2">
			<label>Total : <strong><?=displayData($invoices[0]['total_amt'],'money');?></strong></label>
		</div>
		<div class="col-md-3">
			<label>Invoice Date : <strong><?=displayData($invoices[0]['invoice_date'],'date');?></strong></label>
		</div>
		<div class="col-md-4">
			<label>Due Date : <strong><?=displayData($invoices[0]['due_date'],'date');?></strong></label>
		</div>
		<div class="col-md-4 padding-zero">
		<label class="col-md-12 padding-zero">
					<p class="col-md-5"><strong>Ship Via :</strong></p>
					<p class="col-md-6 text-left"><b><?=$invoices[0]['carrier'];?></b></p>
				</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 padding-zero">
			<div class="col-md-6">
				<h4>Billing Information</h4>
				<p><?=$invoices[0]['b_name'];?><br>
						 <?=$invoices[0]['b_city'];?><br>
						 <?=$invoices[0]['b_state'];?>, <?=$invoices[0]['b_country'];?> <?=$invoices[0]['b_zipcode'];?></p>
			</div>
			<div class="col-md-6">
				<h4>Shipping Information</h4>
				<p><?=$invoices[0]['name'];?><br>
						 <?=$invoices[0]['city'];?><br>
						 <?=$invoices[0]['state'];?>, <?=$invoices[0]['country'];?> <?=$invoices[0]['zipcode'];?></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
				<table class="table">
					<thead>
						<th width="65%">Description</th>
						<th width="10%">Quantity</th>
						<th class="text-center" width="20%">Unit Price</th>
						<th width="5%">Net</th>
					</thead>
					<tbody>
						<?php
						if($invoices)
						{
							$total[] = '';$qty[]='';
							foreach ($invoices as $key => $value)
							{								
								$inv_id = $value['item_id'];
								$product = $this->db->query("select a.*,b.name from invoice_items a,product b where a.product_id = b.id and a.invoice_id='".$inv_id."'")->result_array();
								// print_r($product);
								foreach ($product as $key => $pvalue)
								{
									$total[] = $pvalue['quantity'] * $pvalue['unit_price'];
									$qty[]=$pvalue['quantity'];
									?>
										<tr>
											<td><?=$pvalue['name'];?></td>
											<td class="text-center"><?=$pvalue['quantity'];?></td>
											<td class="text-center"><?="$".number_format($pvalue['unit_price'],3);?></td>
											<td class="text-center"><?="$".number_format($pvalue['unit_price'] * $pvalue['quantity'],2);?></td>
										</tr>
									<?php
								}
							}
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="1" class="text-right">Total</td>
							<td class="text-center"><?=array_sum($qty);?></td>
							<td>&nbsp;</td>
							<td>$<?=number_format(array_sum($total),2);?></td>
						</tr>
					</tfoot>
				</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="form-group">
					<label>Change Invoice Status : </label>
					<select class="form-control" data-id="<?=$invoices[0]['id'];?>" name="invoice_status">
						<option <?=$invoices[0]['invoice_status']=="COMPLETED"? "selected":"";?> value="COMPLETED">COMPLETED</option>
						<option <?=$invoices[0]['invoice_status']=="PARTIALLY PAID"? "selected":"";?> value="PARTIALLY PAID">PARTIALLY PAID</option>
					</select>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label>Comments : </label>
					<textarea class="form-control" name="inv_comments"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3><b>Log History</b></h3>
			<table class="table table-hover table-bordered">
				<thead>
					<th>Description</th><th>Created Time</th><th>Created By</th>
				</thead>
				<tbody>
					<?php
						$log = $this->db->query("select a.*,b.first_name as created_name from log a,admin_users b where a.action_id='".$inv_id."' and (a.line='invoice' or a.line='invoice_comments') and a.created_id=b.id order by a.created_date desc")->result_array();
						foreach ($log as $key => $value)
						{
							?>
								<tr>
									<td><?=$value['action'];?></td>
									<td><?=$value['created_date'];?></td>
									<td><?=$value['created_name'];?></td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
