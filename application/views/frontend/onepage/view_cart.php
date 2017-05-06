<?php
	if($products)
	{
		$tot = [];
		foreach ($products as $key => $value)
		{
			$tot[] = $value['unit_price'] * $value['qty'];
			?>
				<tr>
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
