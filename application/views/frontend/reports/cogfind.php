<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/bootstrap.min.css');?>">
<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/print_style.css');?>">
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><strong>Request : COGFIND</strong></label>
				<p><strong>find who was shipped max to</strong></p>
				<p><strong>COGFIND</strong></p>
				<div class="col-md-3">
					<p><b>Page 1</b></p>
				</div>
				<div class="col-md-5">
					<label class="col-md-2"><b>Filters:</b></label>
					<p class="col-md-10">
						SO Date is between <b><?=date('m-d-Y',strtotime($date['start_date']));?>, <?=date('m-d-Y',strtotime($date['end_date']));?></b>
						<br>Inventory ID is Like <b><?=get_product_name($date['inventory'])['sku'];?></b><br>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<thead>
				<th width="10%">Ship Date</th><th width="8%">SO ID</th><th width="5%">Quantity Shipped</th><th>Price</th><th>Cost</th>
				<th>Freight In</th><th>Total Cost</th><th>Total Price</th><th width="20%">Customer</th><th width="20%">Salesman</th>
			</thead>
			<tbody>
			<?php
				if($cogfind)
				{
					foreach ($cogfind as $key => $value)
					{
						$total_price[] = $value['qty'] * $value['unit_price'];
						$price[] = $value['unit_price'];
						$qty[] = $value['qty'];
						$total_cost[] = ($value['qty'] * $value['total_items']) + $value['qty'];
						?>
							<tr>
								<td><?=date("m-d-Y",strtotime($value['ship_date']));?></td>
								<td class="text-center"><?=$value['so_id'];?></td>
								<td class="text-center"><?=$value['qty'];?></td>
								<td>$<?=number_format($value['unit_price'],2);?></td>
								<td><?=$value['total_items'];?></td>
								<td><?=$value['total_items'];?></td>
								<td>$<?=number_format(($value['qty'] * $value['total_items']) + $value['qty'],2);?></td>
								<td>$<?=number_format($value['qty'] * $value['unit_price'],2);?></td>
								<td><?=$value['business_name'];?></td>
								<td><?=$value['salesman_name'];?></td>
							</tr>
						<?php
					}
				}
			?>
			</tbody>
		</table>
	</div>
	<footer>
		<div class="row">
			<table class="table">
				<tfoot>
					<tr>
						<td width="18%"><b>Grand Totals</b></td>
						<td class="text-center" width="8%"><?=array_sum($qty);?></td>
						<td class="text-center" width="5%">$<?=number_format(array_sum($price),2);?></td>
						<td class="text-center" width="5%"><?=array_sum($items);?></td>
						<td class="text-center no-border"  width="7%">&nbsp;</td>
						<td class="text-center" width="7%">$<?=number_format(array_sum($total_cost),2);?></td>
						<td class="text-center" width="9%">$<?=number_format(array_sum($total_price),2);?></td>	
						<td class="text-center no-border">&nbsp;</td>
						<td class="text-center no-border">&nbsp;</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><b><?=count($cogfind);?> Groups Selected</b></p>
			</div>
		</div>
		<div class="row">
			<button class="col-md-offset-5 no-btn btn btn-primary" onclick="javascript:window.print();" type="button">Print</button>
			<a class="no-btn btn btn-danger" href="<?=site_url('reports');?>"  type="button">Back</a>
		</div>
		<br>
	</footer>
</div>
