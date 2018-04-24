 <div class="modal-dialog modal-lg">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Create SO</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="po_vendor_id" class="so_vendor_id" value="<?=$vendor_id;?>">
      <div class="row">
				<!--<div class="col-md-12 so-list">
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
															<input type="number" name="qty" value="1" class="form-control qty_<?=$value['product_id'];?>" max="10" min="1">
														</td>
														<td>
															<a href="javascript:void(0);" class="btn btn-info add-so-cart" data-product-id="<?=$value['product_id'];?>"
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
				</div>-->
				<div class="col-md-12 cart-table">
					<h2 class="col-md-8">Cart</h2>
					<a class="btn btn-warning update_so_cart pull-right"><i class="fa fa-edit"></i> Update Cart</a>
					<form id="CartSOForm" action="" method="post">
						<table class="table table-bordered table-hover">
							<thead>
								<th>Product</th><th>SKU</th><th>Unit Price</th><th>Quantity</th><th>Total</th>
							</thead>
							<tbody>			
							</tbody>
						</table>
					</form>
				</div>
			</div>
    </div>
    <div class="modal-footer">
      <div class="col-md-3 pull-right">
        <button class="btn close-so-create btn-danger pull-right">Close</button>
        <button class="btn btn-warning pull-left checkout-so" href=>Checkout</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(".add-so-cart").click(function(){
		p_id = $(this).attr("data-product-id");
		p_name = $(this).attr("data-product-name");
		sku = $(this).attr("data-product-sku");
		price = $(this).attr("data-product-price");
		qty = $(".qty_"+p_id).val();

		$.ajax({
			type:"POST",
			url:base_url+'dashboard/add_so_cart',
			data:{p_id:p_id,p_name:p_name,sku:sku,qty:qty,price:price},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".cart-table table").html(data.cart);
			}
		});
	});
	$(".close-so-create").click(function(){
			c_id = $(".customer_id").val();
			$.ajax({
					type:"POST",
					url:base_url+'dashboard/get_so_history',
					data:{c_id:c_id},
					dataType:'json',
					success:function(data)
					{
						console.log(data);
						$("#SOProcess").html(data.content);
					}
				});
	});

		$(".checkout-so").click(function(){
		 vendor_id = $(".so_vendor_id").val();
			$.ajax({
				type:"POST",
				url:base_url+'dashboard/checkout_so',
				data:{vendor_id:vendor_id},
				dataType:'json',
				success:function(data)
				{
					console.log(data);
				$("#SOProcess").html(data.content);
			}
		});
});


	$(".update_so_cart").click(function(){
		form = $("form#CartSOForm").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_so_cart',
			data:form,
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".cart-table table").html(data.cart);
			}
		});
	});


</script>