<?php
	if($products)
	{
		$tot = [];
		foreach ($products as $key => $value)
		{
			$tot[] = $value['unit_price'] * $value['qty'];
			?>
				<tr>
					<td>
						<a href="javascript:void(0);" class="btn btn-danger" 
							onclick="remove_po_product(<?=$value['po_id'];?>,<?=$value['rowid'];?>);">
							<i class="fa fa-trash"></i>
						</a>
					</td>
					<td><?=$value['p_name'];?></td>
					<td><?=$value['form'];?></td>
					<td><?=$value['color'];?></td>
					<td><?=$value['package'];?></td>
					<td><?=displayData($value['unit_price'],'money');?></td>
					<td>
						<input type="number" name="qty[<?=$value['rowid'];?>]" max="10" min="1" class="form-control" value="<?=$value['qty'];?>">
					</td>
					<td><?=displayData($value['unit_price'] * $value['qty'],'money');?></td>
				</tr>
			<?php 
		}
	}
?>
