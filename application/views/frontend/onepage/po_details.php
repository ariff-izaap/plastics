<div class="row">
	<div class="col-md-3 span-border">
    PO Status : <b><?=$po['order_status'];?></b>
  </div>
  <div class="col-md-2 span-border ps_sec_blue">
    Total : <b><?=displayData($po['total_amount'],'money');?></b>
  </div>
  <div class="col-md-3 span-border nd_sec_yellow">
    Paid Status: <b><?=$po['is_paid'];?></b>
  </div>
  <div class="col-md-3 span-border nd_sec_yellow">
    Payment Term: <b><?=$po['credit'];?></b>
  </div>
</div><br>
<div class="row">
	<div class="col-md-12 padding-zero">
		<div class="col-md-2 padding-zero">
			<div class="form-group">
				<label class="col-md-12 control-label">Vendor : <b><?=$po['vendor_name'];?></b></label>						
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Shipment Service :<?=$po['carrier'];?></label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Delivery :<?=$po['ship_type'];?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Release to Sold :<?=$po['release_to_sold'];?>
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
					<address><strong><?=$po['bill_name'];?></strong> <br><?=$po['b_address1'];?><br><?=$po['b_address2'];?>
            <br><?=$po['b_city'].",<br>".$po['b_state'];?><br>
            <?=$po['b_country']." - ".$po['b_zipcode'];?><br>
            <abbr title="Phone">P:</abbr> <?=$po['b_phone'];?><br>
            <abbr title="Email">E:</abbr> <?=$po['email'];?>
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
						<address><strong><?=$po['wname'];?></strong> <br><?=$po['address1'];?><br><?=$po['address2'];?>
                <br><?=$po['city'].",<br>".$po['state_name'];?><br>
                <?=$po['country_name']." - ".$po['zipcode'];?><br>
                <abbr title="Phone">P:</abbr> <?=$po['phone'];?><br>
                <abbr title="Email">E:</abbr> <?=$po['email'];?>
              </address>
          </td>									
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-4 pull-right">
		<a href="javascript:void(0);" class="btn btn-warning update_po_qty pull-right">Update Quantity</a>
		<a href="#AddPOProduct" data-toggle="modal" data-id="<?=$po_details[0]['vendor_id'];?>" data-po-id="<?=$po_details[0]['po_id'];?>" class="btn btn-warning add-po-product pull-left">Add Product</a>
	</div>
</div><br>
<div class="row">
	<div class="col-md-12">
		<form action="" method="post" id="EditPOProduct">
			<input type="hidden" name="vendor_id" class="vendor_id" value="<?=$po_details[0]['vendor_id'];?>">
			<input type="hidden" name="po_id" class="po_id" value="<?=$po_details[0]['po_id'];?>">
			<table class="table table-hover table-bordered">
			<thead>
				<th>Product Name</th><th>Form</th><th>Color</th><th>Packaging</th><th>Unit Price</th><th>Quantity</th>
				<th>Total</th>
			</thead>
			<tbody>
				<?php
				if($po_details)
				{
					foreach ($po_details as $key => $value)
					{
						$tot[] = $value['unit_price'] * $value['qty'];
						?>
							<tr>
								<td><?=$value['name'];?></td>
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
				<tfoot>
					<td colspan="6" class="text-right">Total</td>
					<td><?=displayData(array_sum($tot),'money');?></td>
				</tfoot>
			</tbody>
			</table>
		</form>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
      <label><strong>Notes : </strong><?=$po['note'];?></label>
  </div>
</div><br>
<div class="row">
  <div class="col-md-12">
    <label><strong>PO Message : </strong><?=$po['po_message'];?></label>
  </div>
</div>

<script type="text/javascript">
	$(".add-po-product").click(function(){
		vendor_id = $(this).attr("data-id");
		po_id = $(this).attr("data-po-id");
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/add_po_product',
			data:{vendor_id:vendor_id,po_id:po_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#AddPOProduct .modal-body").html(data.content);
			}
		});
	});

	$(".update_po_qty").click(function(){
		form = $("form#EditPOProduct").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_po_qty',
			data:form,
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#PODetails .modal-body table tbody").html(data.cart);
			}
		});
	});
</script>