<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Vendor : <b><?=get_vendor_by_id($vendor_id)[0]['business_name'];?></b></label>
			<input type="hidden" name="po_vendor_id" class="po_vendor_id" value="<?=$vendor_id;?>">
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
		<thead>
			<th>Product Name</th><th>Form</th><th>Color</th><th>Type</th><th>Packaging</th><th>Wholesale Price</th>
			<th>Available Quantity</th><th>Needed Quantity</th><th>Action</th>
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
									<td><?=$value['form'];?></td>
									<td><?=$value['color'];?></td>
									<td><?=$value['type'];?></td>
									<td><?=$value['package'];?></td>
									<td><?=displayData($value['wholesale_price'],'money');?></td>
									<td><?=$value['quantity'];?></td>
									<td>
										<input type="number" name="qty" value="1" class="form-control qty_<?=$value['p_id'];?>" max="10" min="1">
									</td>
									<td>
										<a href="javascript:void(0);" class="btn btn-info add-po-cart" data-product-id="<?=$value['p_id'];?>"
										data-product-name="<?=$value['name'];?>" data-product-sku="<?=$value['sku'];?>" data-product-price="<?=$value['wholesale_price'];?>">
											<i class="fa fa-plus"></i> Add Cart
										</a>
									</td>
								</tr>
							<?php 
						}
					}
				?>
		</tbody>
		</table>
	</div>
	<div class="col-md-12 cart-table">
		<h4>Cart</h4>
		<table class="table table-bordered table-hover">
			<thead>
				<th>Product</th><th>SKU</th><th>Unit Price</th><th>Quantity</th><th>Total</th>
			</thead>
			<tbody>			
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(".add-po-cart").click(function(){
		p_id = $(this).attr("data-product-id");
		p_name = $(this).attr("data-product-name");
		sku = $(this).attr("data-product-sku");
		price = $(this).attr("data-product-price");
		qty = $(".qty_"+p_id).val();

		$.ajax({
			type:"POST",
			url:base_url+'dashboard/add_po_cart',
			data:{p_id:p_id,p_name:p_name,sku:sku,qty:qty,price:price},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".cart-table table").html(data.cart);
			}
		});
	});
</script>