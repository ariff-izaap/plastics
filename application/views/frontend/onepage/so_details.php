<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close close_so_details" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">SO - #</h4>
    </div>
    <div class="modal-body" style="max-height: 400px;overflow: auto;">
      <div class="row">
				<div class="col-md-2 span-border">
			    SO Status : <b><?=$so['order_status'];?></b>
			  </div>
			  <div class="col-md-2 span-border ps_sec_blue">
			    Total : <b><?=displayData($so['total_amount'],'money');?></b>
			  </div>
			  <div class="col-md-3 span-border nd_sec_yellow">
			    Payment Term: <b><?=$so['credit'];?></b>
			  </div>
			  <div class="col-md-3">
					<div class="form-group">
						<label class="col-md-12 control-label">Shipment Service : <b><?=$so['carrier'];?></b></label>						
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12 padding-zero">
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">Total Items :<?=$so['total_items'];?></label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Delivery :<?=$so['ship_type'];?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Salesman :<b><?=$so['salesman'];?></b>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Ordered Date :<b><?=$so['created_date'];?></b>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<table class="table table-bordered">
					<thead class="greenbg_title txt_13">
						<tr>
							<th width="10%">Billing Information</th>
						</tr>
					</thead>
					<tbody class="white_bg gray_bg">
						<tr>
							<td id="shipping_address" data-title="Billing Information Edit">
								<address><strong><?=$so['name'];?></strong> <br><?=$so['address1'];?><br><?=$so['address2'];?>
			            <br><?=$so['city'].",<br>".$so['state'];?><br>
			            <?=$so['country']." - ".$so['zipcode'];?><br>
			            <abbr title="Phone">P:</abbr> <?=$so['phone'];?><br>
			          </address>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table table-bordered">
						<thead class="greenbg_title txt_13">
							<tr>
								<th width="10%">Shipping Information</th>
							</tr>
						</thead>
						<tbody class="white_bg gray_bg">
							<tr>
								<td id="shipping_address" data-title="Billing Information Edit">
									<address><strong><?=$so['s_name'];?></strong> <br><?=$so['s_address1'];?><br><?=$so['s_address2'];?>
			                <br><?=$so['s_city'].",<br>".$so['s_state'];?><br>
			                <?=$so['s_country']." - ".$so['s_zipcode'];?><br>
			                <abbr title="Phone">P:</abbr> <?=$so['s_phone'];?><br>
			              </address>
			          </td>									
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 pull-right">
					<a href="javascript:void(0);" class="btn btn-warning update_so_qty pull-right">Update Quantity</a>
					<a href="#AddSOProduct" data-toggle="modal" data-id="<?=$so_details[0]['customer_id'];?>" data-so-id="<?=$so_details[0]['so_id'];?>" class="btn btn-warning add-so-product pull-left">Add Product</a>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12">
					<form action="" method="post" id="EditSOProduct">
						<input type="hidden" name="vendor_id" class="vendor_id" value="<?=$so_details[0]['customer_id'];?>">
						<input type="hidden" name="so_id" class="so_id" value="<?=$so_details[0]['so_id'];?>">
						<table class="table table-hover table-bordered">
						<thead>
							<th>Product Name</th><th>Form</th><th>Color</th><th>Packaging</th><th>Unit Price</th><th>Quantity</th>
							<th>Total</th>
						</thead>
						<tbody>
							<?php
							if($so_details)
							{
								foreach ($so_details as $key => $value)
								{
									?>
										<tr>
											<td><?=$value['p_name'];?></td>
											<td><?=$value['form'];?></td>
											<td><?=$value['color'];?></td>
											<td><?=$value['package'];?></td>
											<td><?=displayData($value['unit_price'],'money');?></td>
											<td>
												<input type="number" name="qty[<?=$value['rowid'];?>]" max="10" min="1" class="form-control" 
													value="<?=$value['qty'];?>">
											</td>
											<td><?=displayData($value['unit_price'] * $value['qty'],'money');?></td>
										</tr>
									<?php
								}
							}
							?>
						</tbody>
						</table>
					</form>
				</div>
			</div>
    </div>
    <div class="modal-footer">
      <div class="col-md-2 pull-right">
        <button class="btn btn-danger close_so_details pull-right">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(".add-so-product").click(function(){
		vendor_id = $(this).attr("data-id");
		so_id = $(this).attr("data-so-id");
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/add_so_product',
			data:{vendor_id:vendor_id,so_id:so_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#AddSOProduct .modal-body").html(data.content);
			}
		});
	});

	$(".update_so_qty").click(function(){
		form = $("form#EditSOProduct").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_so_qty',
			data:form,
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#SOProcess .modal-body table tbody").html(data.cart);
			}
		});
	});

		$(".close_so_details").click(function(){
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
</script>