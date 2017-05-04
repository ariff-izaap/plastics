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
						<tr class="product_row" data-id="<?=$value['product_id'];?>">
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
<script>
	
$("table tbody tr.product_row").click(function(){
	id = $(this).attr("data-id");
	$(".purchase-loader").show();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/get_product_by_id',
		data:{id:id},
		dataType:'json',
		success:function(data)
		{
			$(".purchase-loader").hide();
			console.log(data);
			msg = data.message;
			$(".product_sku").val(msg.sku);
			$(".product_name").val(msg.product_name);
			$(".product_qty").val(msg.quantity);
			$(".product_form").val(msg.form);
			$(".product_color").val(msg.color);
			$(".product_row").val(msg.row);
			$(".product_type").val(msg.type);
			$(".product_eq").val(msg.equivalent);
			$(".product_units").val(msg.units);
			$(".product_package").val(msg.packaging);
			$(".product_wholeprice").val(msg.wholesale_price);
			$(".product_retailprice").val(msg.retail_price);
			$(".product_ref").val(msg.ref_no);
			$(".product_notes").val(msg.notes);
		}
	});
});
</script>