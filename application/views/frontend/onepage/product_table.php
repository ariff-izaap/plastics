<table class="table table-bordered">
	<thead>
		<th>Product Name</th><th>Form</th><th>Color</th><th>Type</th><th>Equivalent</th>
		<th>Quantity</th><th>Wholesale Price</th><th>Row</th><th>Packaging</th>
	</thead>
	<tbody>
		<?php
			if($product)
			{
				foreach ($product as $key => $value)
				{
					?>
						<tr class="product_row" onclick="get_product_details(<?=$value['product_id'];?>)">
							<td><?=$value['name'];?></td>
							<td><?=$value['form'];?></td>
							<td><?=$value['color'];?></td>
							<td><?=$value['type'];?></td>
							<td><?=$value['equivalent'];?></td>
							<td><?=$value['quantity'];?></td>
							<td><?=displayData($value['wholesale_price'],'money');?></td>
							<td><?=$value['row'];?></td>
							<td><?=$value['packaging'];?></td>
						</tr>
					<?php
				}
				?>
				<?php
			}
		?>
	</tbody>
</table>
<style type="text/css">
	table tbody tr{cursor: pointer;}
	table tbody tr:hover{background:#ddd;}
</style>
