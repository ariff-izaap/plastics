<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/bootstrap.min.css');?>">
<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/print_style.css');?>">
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><strong>Request : FRNKA</strong></label>
				<p><strong>SALES TO INDIVIDUAL CUSTOMER BY MATERIAL</strong></p>
				<p><strong>FRNKA</strong></p>
				<div class="col-md-3">
					<p><b>Page 1</b></p>
				</div>
				<div class="col-md-5">
					<label class="col-md-2"><b>Filters:</b></label>
					<p class="col-md-10">
						SO Date is between <b><?=date('m-d-Y',strtotime($date['start_date']));?>, <?=date('m-d-Y',strtotime($date['end_date']));?></b>
						<br>SO Customer is Like <b><?=get_vendor_by_id($date['customer'])[0]['business_name'];?></b><br>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<table class="table">
			<thead>
				<th width="10%">Date</th>
				<th width="17%">Product</th><th width="30%">Description</th><th width="8%">Type</th><th width="8%">Color</th>
				<th width="3%">Quantity Shipped</th><th>Ship From</th><th>Total Price</th>
			</thead>
			<tbody>
				<?php
				if($frnka)
				{
					foreach ($frnka as $key => $value)
					{
						$total_cost[] = $value['total_cost'];
						$qty[] = $value['qty'];
						?>
						<tr>
							<td><?=date("m-d-Y",strtotime($value['ship_date']));?></td>
							<td><?=$value['sku'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['type'];?></td>
							<td><?=$value['color'];?></td>
							<td class="text-center"><?=$value['qty'];?></td>
							<td class="text-center">N</td>
							<td class="text-center">$<?=number_format($value['total_cost'],2);?></td>
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
						<td width="73%"><b>Grand Totals</b></td>
						<td class="text-center" width="7%"><?=array_sum($qty);?></td>
						<td class="no-border text-center" width="10%">&nbsp;</td>
						<td class="text-center" width="10%">$<?=number_format(array_sum($total_cost),2);?></td>	
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><b><?=count($frnka);?> Groups Selected</b></p>
			</div>
		</div>
		<div class="row">
			<button class="col-md-offset-5 no-btn btn btn-primary" onclick="javascript:window.print();" type="button">Print</button>
			<a class="no-btn btn btn-danger" href="<?=site_url('reports');?>"  type="button">Back</a>
		</div>
		<br>
	</footer>
</div>