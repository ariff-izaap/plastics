<thead>
	<th>Product</th><th>SKU</th><th>Unit Price</th><th>Quantity</th><th>Total</th><th width="80">Action</th>
</thead>
<tbody>
	<?php
		if($cart)
		{
			foreach ($cart as $key => $value)
			{
				$rand = rand();
				?>
					<tr>
						<td><?=$value['name'];?></td>
						<td><?=$value['id'];?></td>
						<td><?=displayData($value['price'],'money');?></td>
						<td>
							<input type="number" name="qty[<?=$value['rowid'];?>]" max="10" min="1" value="<?=$value['qty'];?>">
						</td>
						<td><?=displayData($value['subtotal'],'money');?></td>
						<td>
							<a href="javascript:void(0);" class="btn btn-danger remove_po_cart" data-id="<?=$value['rowid'];?>">
							<i class="fa fa-remove"></i></a>
						</td>
					</tr>
				<?php
			}
		}
		else
		{
			?>
				<tr>
					<td colspan="6" class="text-center">No Records Found.</td>
				</tr>
			<?php
		}
	?>
</tbody>
<?php
	if($cart)
	{
		?>
		<tfoot>
			<tr>
				<td colspan="4" class="text-right">Total</td>
				<td><?=displayData($total,'money');?></td>
			</tr>
		</tfoot>
		<?php
	}
	?>

<script type="text/javascript">
	$(".remove_po_cart").click(function(){
		rowid = $(this).attr("data-id");
		con = confirm("Are you sure want to remove?");
		if(con)
		{
			$.ajax({
				type:"POST",
				url:base_url+'dashboard/remove_po_cart',
				data:{rowid:rowid},
				dataType:'json',
				success:function(data)
				{
					$(".cart-table table").html(data.cart);
				}
			});
		}
	});	
</script>