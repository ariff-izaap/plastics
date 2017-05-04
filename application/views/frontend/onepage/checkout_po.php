<form action="" method="post" id="CheckoutPO">
	<input type="hidden" name="vendor_id" value="<?=$vendor_id;?>">
	<div class="row">
		<div class="col-md-12 ">
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-4">Warehouse</label>
					<div class="col-md-8">
						<select class="form-control input-sm warehouse_select" name="warehouse_id">
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
					<label class="col-md-3">Name</label>
					<div class="col-md-8">
						<input type="text" name="wname" id="wname" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Address1</label>
					<div class="col-md-8">
						<input type="text" name="address1" id="address1" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Address2</label>
					<div class="col-md-8">
						<input type="text" name="address2" id="address2" class="form-control">
					</div>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">City</label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="city" id="city">
					</div>
				</div>
			</div>
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">State</label>
					<div class="col-md-8">
						<select class="form-control input-sm" name="state" id="state">
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
					<label class="col-md-3">Country</label>
					<div class="col-md-8">
						<select class="form-control input-sm" name="country" id="country">
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
					<label class="col-md-3">Zipcode</label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="zipcode" id="zipcode">
					</div>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Phone</label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="phone" id="phone">
					</div>
				</div>
			</div>
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Email</label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="email" id="email">
					</div>
				</div>
			</div>
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Ship Method</label>
					<div class="col-md-8">
						<select name="ship_method" class="form-control input-sm">
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
					<label class="col-md-3">Ship Service</label>
					<div class="col-md-8">
						 <select name="ship_service" class="form-control input-sm">
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
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Payment Term</label>
					<div class="col-md-8">
						<select name="credit_type" class="form-control input-sm">
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
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Pickup Date</label>
					<div class="col-md-8">
						<input type="text" class="form-control singledate" name="pickup_date">
					</div>
				</div>
			</div>
			<div class="col-md-3 padding-zero">
				<div class="form-group">
					<label class="col-md-3">Delivery Date</label>
					<div class="col-md-8">
						<input type="text" class="form-control singledate" name="delivery_date">
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
	</div><br>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 padding-zero">
				<div class="form-group">
					<label class="col-md-3">PO Message</label>
					<div class="col-md-8">
						<textarea rows="5" class="form-control" name="po_message"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-6 padding-zero">
				<div class="form-group">
					<label class="col-md-3">PO Notes</label>
					<div class="col-md-8">
						<textarea rows="5" class="form-control" name="po_notes"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12 cart-table">
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
											<input type="number" value="<?=$value['qty'];?>" name="qty" class="qty_<?=$rand;?>">
										</td>
										<td><?=displayData($value['subtotal'],'money');?></td>
										<td>
											<a href="javascript:void(0);" class="btn btn-warning update_po_cart" data-id="<?=$value['rowid'];?>"				data-row-id="<?=$rand;?>">
												<i class="fa fa-edit"></i> Update Cart</a>
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
		rowid = $(this).attr("data-id");
		rand = $(this).attr("data-row-id");
		qty = $(".qty_"+rand).val();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_po_cart',
			data:{rowid:rowid,qty:qty},
			dataType:'json',
			success:function(data)
			{
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
</script>