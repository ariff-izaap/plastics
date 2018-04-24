<table class="table table-bordered">
	<thead>
		<th></th><th>Product Name</th><th>Form</th><th>Color</th><th>Type</th><th>Equivalent</th>
		<th>Quantity</th><th>Wholesale Price</th><th>Row</th><th>Packaging</th>
	</thead>
	<tbody>
		<?php
			if($product)
			{
				foreach ($product as $key => $value)
				{
					?>
						<tr class="product_row">
							<td><input type="checkbox" name="product_onepage" onclick="onepage_product_add(this,<?=$value['product_id'];?>);" value="<?=$value['product_id'];?>"></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['name'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['form'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['color'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['type'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['equivalent'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['quantity'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=displayData($value['wholesale_price'],'money');?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['row'];?></td>
							<td onclick="get_product_details(<?=$value['product_id'];?>)"><?=$value['packaging'];?></td>
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
