<form id="AjaxProductForm" action="" method="post">
	<table class="table table-hover table-bordered"> 
		<thead>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Wholesale Price</th>
			<th>Quantity Needed</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php
			if($products)
			{
				foreach ($products as $key => $value)
				{
					?>
						<tr>
							<td><?=$value['name'];?></td>
							<td><?=$value['quantity'];?></td>
							<td><?=displayData($value['wholesale_price'],'money');?></td>
							<td>
								<input type="number" max="100" min="1" class="product_id_<?=$value['id'];?>" name="qty" value="1">
							</td>
							<td><a href="#" class="btn btn-info add_product_modal" onclick="add_to_order(<?=$value['id'];?>,<?=$po_id;?>,<?=$value['vendor_id'];?>);">Add to Order</a></td>
						</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
</form>
<script type="text/javascript">
	function add_to_order(product_id,po_id,vendor_id)
	{
  	qty = $(".product_id_"+product_id).val();
  	$.ajax({
  		type:"POST",
  		url:base_url+"purchase/add_product_modal_ajax",
  		data:{po_id:po_id,vendor_id:vendor_id,product_id:product_id,qty:qty},
  		dataType:'json',
  		success:function(data)
  		{
  			console.log(data);
  			if(data.status=="success")
  				bootbox.alert(data.message);

  			$(".done-product-modal").attr("data-po-id",po_id);
  		}
  	});

	}
</script>