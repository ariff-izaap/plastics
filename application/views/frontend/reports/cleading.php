<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/bootstrap.min.css');?>">
<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/print_style.css');?>">
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><strong>Request : LEADING</strong></label>
				<p><strong>LEADING CUSTOMERS BY SALES VOLUME</strong></p>
				<p><strong>Leading Sales</strong></p>
				<div class="col-md-3">
					<p><b>Page 1</b></p>
				</div>
				<div class="col-md-5">
					<label class="col-md-2"><b>Filters:</b></label>
					<p class="col-md-10">
						SO Date is between <?=date('m-d-Y',strtotime($date['start_date']));?>,<?=date('m-d-Y',strtotime($date['end_date']));?>
						<br>
						SO Total Price is more than 0<br>
						SO Salesman is like TED
					</p>
				</div>
			</div>
		</div>
	</div>
	
		<div class="row">
			<table class="table">
				<thead>
					<th width="40%">Customer</th>
					<th width="20%">Salesman</th><th>Sum of Total Price</th><th>Sum of Total Cost</th>
					<th>Sum of Quantity Shipped</th>
				</thead>
				<tbody>
					<?php
					if($cleading)
					{
						$price=[];
                        $wprice=[];
                        $items=[];
						foreach ($cleading as $key => $value)
						{
							$price[]  = $value['price'];
							$wprice[] = $value['w_price'];
							$items[]  = $value['total_items'];
							?>
							<tr>
								<td><?=$value['business_name'];?></td>
								<td><?=$value['business_name'];?></td>
								<td class="text-center">$<?=number_format($value['price'],2);?></td>
								<td class="text-center">$<?=number_format($value['w_price'],2);?></td>
								<td class="text-center"><?=$value['total_items'];?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2"><b>Totals</b></td>
						<td class="text-center">$<?=number_format(array_sum($price),2);?></td>
						<td class="text-center">$<?=number_format(array_sum($wprice),2);?></td>
						<td class="text-center"><?=array_sum($items);?></td>
					</tr>
				</tfoot>			
			</table>
		</div>
	<footer>
		<div class="row">
			<table class="table">
				<tfoot>
					<tr>
						<td width="60%"><b>Grand Totals</b></td>
						<td width="12%" class="text-center">$<?=number_format(array_sum($price),2);?></td>
						<td width="12%" class="text-center">$<?=number_format(array_sum($wprice),2);?></td>
						<td class="text-center"><?=array_sum($items);?></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><b><?=count($cleading);?> Groups Selected</b></p>
			</div>
		</div>
		<div class="row">
			<button class="col-md-offset-5 no-btn btn btn-primary" onclick="javascript:window.print();" type="button">Print</button>
			<a class="no-btn btn btn-danger" href="<?=site_url('reports');?>"  type="button">Back</a>
		</div>
		<br>
	</footer>
</div>
<?php
if($btn=="print"){
?>
<script type="text/javascript">
	window.print();
</script>
<?php 
}?>
