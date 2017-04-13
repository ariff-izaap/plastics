<link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/bootstrap.min.css');?>">
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label><strong>Request : INCOTT</strong></label>
				<p><strong>SUMMARY OF COST of inventory in all warehouse</strong></p>
                <div class="col-md-3">
                    <p>Cross-Tab Sum of Inventory Total Cost for<br />Product by Form</p>
                </div>
				<div class="col-md-3">
					<p><b>Page 1</b></p>
				</div>
				<div class="col-md-5">
					<label class="col-md-2"><b>Filters:</b></label>
					<p class="col-md-10">
						Inventor Date Is On or Before  <?=date('m-d-Y',strtotime($date['start_date']));?>
					</p>
				</div>
			</div>
		</div>
	</div>
	
		<div class="row">
			<table class="table">
				<thead>
					<th width="40%">PRODUCT</th>
					<th width="20%">SUM</th>
                    <th>COMP</th>
                    <th>PARTS</th>
					<th>POWDER</th>
                    <th>REGRIND</th>
				</thead>
				<tbody>
					<?php
					if($shipping_order){
						foreach ($shipping_order as $skey => $svalue){
						   $total_qty += $svalue['qty'];
                           $total_prt += $svalue['Parts_count'];
                           $total_cmp += $svalue['Comp_count'];
                           $total_pow += $svalue['Powder_count'];
                           $total_reg += $svalue['Regrind_count'];
							?>
							<tr>
                                <td><?=$svalue['name'];?></td>
                                <td><?=$svalue['qty'];?></td>
								<td><?=$svalue['Comp_count'];?></td>
								<td class="text-center"><?=$svalue['Parts_count'];?></td>
								<td class="text-center"><?=$svalue['Powder_count'];?></td>
								<td class="text-center"><?=$svalue['Regrind_count'];?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
				<tfoot>
					<tr>
                        <td class="text-center">Sum</td>
                        <td class="text-center"><?=$total_qty;?></td>
                        <td class="text-center"><?=$total_prt;?></td>
						<td class="text-center"><?=$total_cmp;?></td>
						<td class="text-center"><?=$total_pow;?></td>
						<td class="text-center"><?=$total_reg;?></td>
					</tr>
				</tfoot>			
			</table>
		</div>
	<footer>
		
		<div class="row">
			<div class="col-md-12">
				<p><b><?=count($shipping_order);?> Records Selected</b></p>
			</div>
		</div>
	</footer>
</div>

<style type="text/css">
	@media print
	{
		.col-md-2 {width: 16.66666667%;}.col-md-3 {width: 25%;}.col-md-5 {width: 41.66666667%;}.col-md-12 {width: 100%;}
		.col-md-10 {width: 83.33333333%;}
		.col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12{float: left;}
		.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, 
		.col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, 
		.col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, 
		.col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, 
		.col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {position: relative;min-height: 1px;padding-right: 15px;padding-left: 15px;}
	}
	table {border:none !important;border-collapse: separate;border-spacing: 15px;font-size: 14px;font-weight: bold;}
	table thead th{border-bottom: 2px solid black !important;}
	table tfoot tr td{border-top: 2px solid black !important;}
	footer{position: fixed;bottom: 0;width: 85%;}
</style>