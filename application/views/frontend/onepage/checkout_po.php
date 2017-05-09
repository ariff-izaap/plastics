<div class="modal-dialog modal-lg">
<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Checkout</h4>
  </div>
  <div class="modal-body" style="max-height: 450px;overflow: auto;">
    <form action="" method="post" id="CheckoutPO">
			<input type="hidden" name="vendor_id" value="<?=$vendor_id;?>">
			<div class="row">
				<div class="col-md-12 ">
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Warehouse</label>
							<div class="col-md-8">
								<select class="form-control input-sm warehouse_select required" name="warehouse_id">
									<option value="">--Select--</option>
									<?php
						      	if(get_warehouse())
						      	{
						      		foreach (get_warehouse() as $key => $value)
						      		{
								      	?>
								      		<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
								      	<?php
								      }
								    }
						      	?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Name</label>
							<div class="col-md-8">
								<input type="text" name="wname" id="wname" class="form-control required">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Address1</label>
							<div class="col-md-8">
								<input type="text" name="address1" id="address1" class="form-control required">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Address2</label>
							<div class="col-md-8">
								<input type="text" name="address2" id="address2" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">City</label>
							<div class="col-md-8">
								<input type="text" class="form-control required" name="city" id="city">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">State</label>
							<div class="col-md-8">
								<select class="form-control input-sm required" name="state" id="state">
									<option value="">--Select--</option>
									<?php
										if(get_state())
										{
											foreach (get_state() as $key => $value)
											{
												?>
													<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
												<?php
											}
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Country</label>
							<div class="col-md-8">
								<select class="form-control input-sm required" name="country" id="country">
									<option value="">--Select--</option>
									<?php
										if(get_country())
										{
											foreach (get_country() as $key => $value)
											{
												?>
													<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
												<?php
											}
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Zipcode</label>
							<div class="col-md-8">
								<input type="text" class="form-control required" name="zipcode" id="zipcode">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Phone</label>
							<div class="col-md-8">
								<input type="text" class="form-control required" name="phone" id="phone">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Email</label>
							<div class="col-md-8">
								<input type="text" class="form-control required" name="email" id="email">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Ship Method</label>
							<div class="col-md-8">
								<select name="ship_method" class="form-control required input-sm">
					      	<option value="">--Select Ship Method--</option>
					      	<?php
					      	if(get_shipping_type())
					      	{
					      		foreach (get_shipping_type() as $key => $value)
					      		{
							      	?>
							      		<option value="<?=$value['id'];?>"><?=$value['type'];?></option>
							      	<?php
							      }
							    }
					      	?>
					      </select>
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Ship Service</label>
							<div class="col-md-8">
								 <select name="ship_service" class="form-control required input-sm">
					      	<option value="">--Select Service--</option>
					      	<?php
					      	if(get_carrier())
					      	{
					      		foreach (get_carrier() as $key => $value)
					      		{
							      	?>
							      		<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
							      	<?php
							      }
							    }
					      	?>
					      </select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4 padding-zero">
						<div class="form-group">
							<label class="col-md-5">Payment Term</label>
							<div class="col-md-7">
								<select name="credit_type" class="form-control input-sm required">
					      	<option value="">--Select Payment Term--</option>
					      	<?php
					      	if(get_credit_type())
					      	{
					      		foreach (get_credit_type() as $key => $value)
					      		{
							      	?>
							      		<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
							      	<?php
							      }
							    }
					      	?>
					      </select>
							</div>
						</div>
					</div>
					<div class="col-md-4 padding-zero">
						<div class="form-group">
							<label class="col-md-5">Pickup Date</label>
							<div class="col-md-7">
								<input type="text" class="form-control singledate required" name="pickup_date">
							</div>
						</div>
					</div>
					<div class="col-md-4 padding-zero">
						<div class="form-group">
							<label class="col-md-5">Delivery Date</label>
							<div class="col-md-7">
								<input type="text" class="form-control singledate required" name="delivery_date">
							</div>
						</div>
					</div>
					<!-- <div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-5">Documents</label>
							<div class="col-md-7">
								<a href="#"><i class="fa fa-file-zip-o"></i></a>
							</div>
						</div>
					</div> -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 padding-zero">
						<div class="form-group">
							<label class="col-md-3">PO Message</label>
							<div class="col-md-9">
								<textarea rows="5" class="form-control" name="po_message"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-6 padding-zero">
						<div class="form-group">
							<label class="col-md-3">PO Notes</label>
							<div class="col-md-9">
								<textarea rows="5" class="form-control" name="po_notes"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form id="CartPOForm" action="" method="post">
			<div class="row">
				<div class="col-md-12 cart-table">
					<h2 class="col-md-8">Cart</h2>
					<a class="btn btn-warning update_po_cart pull-right"><i class="fa fa-edit"></i> Update Cart</a>
					<table class="table table-hover table-bordered">
					<thead>
						<th>Product</th><th>SKU</th><th>Unit Price</th><th>Quantity</th><th>Total</th><th>Action</th>
					</thead>
					<tbody>
							<?php
								if($this->cart->contents())
								{
									foreach ($this->cart->contents() as $key => $value)
									{
										$rand = rand();
										?>
											<tr>
												<td><?=$value['name'];?></td>
												<td><?=$value['id'];?></td>
												<td><?=$value['price'];?></td>
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
							?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4" class="text-right">Total</td>
							<td><?=displayData($this->cart->total(),'money');?></td>
						</tr>
					</tfoot>
					</table>
				</div>
			</div>
		</form>
  </div>
  <div class="modal-footer">
    <div class="col-md-3 pull-right">
      <button class="btn back-checkout-po btn-danger pull-left">Back</button>
      <button class="btn btn-primary order-po-btn pull-right">Order Now</button>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
		$('.singledate').daterangepicker({
		  singleDatePicker: true,
		  showDropdowns: true,
	    sautoUpdateInput: false,
		  locale: {
		    format: 'YYYY-MM-DD',
		  }
	});

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

$(".update_po_cart").click(function(){
		form = $("form#CartPOForm").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_po_cart',
			data:form,
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".cart-table table").html(data.cart);
			}
		});
	});

$(".warehouse_select").change(function(){
  val = $(this).val();
  if(val!=''){
    $.ajax({
      type:"POST",
      url:base_url+'warehouse/get_warehouse_details',
      data:{val:val},
      success:function(data)
      {
        $(".purchase-loader").hide();
        data = JSON.parse(data);
        $("form#CheckoutPO #wname").val(data.name);
        $("form#CheckoutPO #address1").val(data.address1);
        $("form#CheckoutPO #address2").val(data.address2);
        $("form#CheckoutPO #city").val(data.city);
        $("form#CheckoutPO #phone").val(data.phone);
        $("form#CheckoutPO #email").val(data.email);
        $("form#CheckoutPO #state").val(data.state);
        $("form#CheckoutPO #country").val(data.country);
        $("form#CheckoutPO #zipcode").val(data.zipcode);
      }
    });
  }
  else
  {
    $(".purchase-loader").hide();
    $("form#CheckoutPO")[0].reset();
  }
});

$(".back-checkout-po").click(function(){
	c_id = $(".customer_id").val();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/create_new_po',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#POProcess").html(data.content);
			$(".cart-table table").html(data.cart);
		}
	});
});


$(".order-po-btn").click(function(){
	valid = true;
	elem = $(".required");
	elem.each(function(e,ele){
			if($(ele).val()=='')
			{
				valid = false;
				$(ele).css("border",'1px solid red');
			}
			else
				$(ele).css("border",'1px solid #ccc');
	});
	if(valid)
	{
		form = $("form#CheckoutPO").serialize();
		$.ajax({
			type:"POST",
			data:form,
			url:base_url+'dashboard/order_po',
			dataType:'json',
			success:function(data)
			{
  			$("#POProcess").html(data.content);
				console.log(data);
			}
		});
	}
});

$(".close-po-history").click(function(){
	$("#POHistory").modal('close');
	$("#POHistory").css('display','none');
});
</script>