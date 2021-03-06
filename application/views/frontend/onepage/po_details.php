<div class="modal-dialog modal-lg">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
	    <button type="button" class="close close_po_details">&times;</button>
	    <h4 class="col-md-4 modal-title">PO - #<?=$po['po_id'];?></h4>
	    <?php $po_id = $po['po_id'];?>
	    <div class="col-md-2 pull-right">
	    	<a target="_blank" class="btn btn-success" href="<?=site_url('purchase/print_purchase/'.$po_id.'');?>">Print</a
	    	>
	    </div>
	  </div>
	  <div class="modal-body" style="max-height: 400px;overflow: auto;">
	    <div class="row">
				<div class="col-md-2 span-border">
			    PO Status : <b><?=$po['order_status'];?></b>
			  </div>
			  <div class="col-md-2 span-border ps_sec_blue">
			    Total : <b><span class="order_total"><?=displayData($po['total_amount'],'money');?></span></b>
			  </div>
			  <div class="col-md-4 padding-zero">
					<div class="form-group">
						<label class="col-md-12 control-label">Vendor : <b><?=$po['vendor_name'];?></b></label>						
					</div>
				</div>
			  <div class="col-md-3 span-border nd_sec_yellow">
			    <label class="pull-left control-label">Payment Term:</label>
			    <div class="col-md-6">
			    	<select class="form-control input-sm payment_term">
			    		<?php
			    		if(get_credit_type())
			    		{
			    			foreach (get_credit_type() as $key => $value)
			    			{
				    			?>
				    				<option <?=($po['credit']==$value['name'])?"selected":"";?>
				    					value="<?=$value['id'];?>"><?=$value['name'];?></option>
				    			<?php
				    		}
				    	}
			    		?>
			    	</select>
			    </div>
			  </div>
			</div><br>
			<div class="row">
				<div class="col-md-12 padding-zero">
					<div class="col-md-3 span-border nd_sec_yellow">
				    <label class="col-md-7">Paid Status:</label>
				    <div class="col-md-5">
				    	<select class="form-control input-sm paid_status">
				    		<option <?=($po['is_paid']=="PAID")?"selected":"";?> value="PAID">PAID</option>
				    		<option <?=($po['is_paid']=="NOT PAID")?"selected":"";?> value="NOT PAID">NOT PAID</option>
				    	</select>
				    </div>
				  </div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label col-md-4">Shipment </label>
							<div class="col-md-8">
								<select class="form-control input-sm shipment_service">
					    		<?php
					    		if(get_carrier())
					    		{
					    			foreach (get_carrier() as $key => $value)
					    			{
						    			?>
						    				<option <?=($po['carrier']==$value['name'])?"selected":"";?>
						    					value="<?=$value['id'];?>"><?=$value['name'];?></option>
						    			<?php
						    		}
						    	}
					    		?>
					    	</select>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label col-md-6">Delivery :</label>
							<div class="col-md-6 padding-zero">
								<select class="form-control input-sm delivery_type">
									<?php
					    		if(get_shipping_type())
					    		{
					    			foreach (get_shipping_type() as $key => $value)
					    			{
						    			?>
						    				<option <?=($po['ship_type']==$value['type'])?"selected":"";?>
						    					value="<?=$value['id'];?>"><?=$value['type'];?></option>
						    			<?php
						    		}
						    	}
					    		?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label col-md-8">Release to Sold :</label>
							<div class="col-md-4 padding-zero">
								<select class="form-control input-sm release_to_sold">
									<option <?=($po['release_to_sold']=="Yes")?"selected":"";?> value="Yes">Yes</option>
									<option <?=($po['release_to_sold']=="No")?"selected":"";?> value="No">No</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="succ_msg col-md-8"></div>
				<div class="col-md-2 pull-right">
					<button class="btn btn-success pull-right" onclick="save_po_changes(<?=$po['po_id'];?>);">Save</button>
				</div>
			</div><br>
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
						<table class="table table-hover table-bordered product-cart">
							<thead>
								<th>Action</th><th>Product Name</th><th>Form</th><th>Color</th><th>Packaging</th><th>Unit Price</th>
								<th>Quantity</th><th>Total</th>
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
												<td>
													<a href="javascript:void(0);" class="btn btn-danger" 
														onclick="remove_po_product(<?=$value['po_id'];?>,<?=$value['rowid'];?>);">
														<i class="fa fa-trash"></i>
													</a>
												</td>
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
							</tbody>
							<tfoot>
								<td colspan="7" class="text-right">Total</td>
								<td class="cart-total"><?=displayData(array_sum($tot),'money');?></td>
							</tfoot>
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
			<div class="row">
	  		<div class="col-md-12">
	  			<button class="btn btn-info" onclick="show_logs();">Show Logs</button>
	  		</div><br><br><br>
		  	<div class="col-md-12 LogDiv" style="display: none;">
		    	<table class="table table-hover table-bordered">
		    		<thead>
		    			<th>SNO</th>
		    			<th>Log Description</th>
		    			<th>Date</th>
		    		</thead>
		    		<tbody>
		    			<?php
		    				if($logs)
		    				{
		    					$i = 1;
		    					foreach ($logs as $key => $value)
		    					{
		    						?>
		    							<tr>
		    								<td><?=$i++;?></td>
		    								<td><?=$value['action'];?></td>
		    								<td><?=displayData($value['created_date'],'datetime');?></td>
		    							</tr>
		    						<?php
		    					}
		    				}
		    			?>
		    		</tbody>
		    	</table>
		    </div>
		  </div>
	  </div>

	  <div class="modal-footer">
	    <div class="col-md-2 pull-right">
	      <button class="btn btn-danger close_po_details pull-right">Close</button>
	    </div>
	  </div>
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
				$("#POProcess .modal-body table.product-cart tbody").html(data.cart);
				$("#POProcess .modal-body table.product-cart tfoot td.cart-total").html(data.cart_total);
				$("#POProcess .order_total").html(data.cart_total);
			}
		});
	});
	$(".close_po_details").click(function(){
		c_id = $(".customer_id").val();
		$("#POProcess .modal-body").html("<div class='text-center'><img src='"+base_url+"/assets/img/default.gif'></div>");
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_po_history',
			data:{c_id:c_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#POProcess").html(data.content);
			}
		});
	});
</script>