<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close close_so_details">&times;</button>
      <h4 class="col-md-4 modal-title">SO - #<?=$so['id'];?></h4>
      <?php $so_id = $so['id'];?>
      <div class="col-md-2 pull-right">
	    	<a target="_blank" class="btn btn-success" href="<?=site_url('salesorder/print_sales/'.$so_id.'');?>">Print</a
	    	>
	    </div>
    </div>
    <div class="modal-body" style="max-height: 400px;overflow: auto;">
      <div class="row">
				<div class="col-md-2 span-border">
			    SO Status : <b><?=$so['order_status'];?></b>
			  </div>
			  <div class="col-md-2 span-border">
			    Total : <b><span class="order_total"><?=displayData($so['total_amount'],'money');?></span></b>
			  </div>
			  <div class="col-md-4 span-border nd_sec_yellow">
			    <label class="col-md-6">Payment Term: </label>
			    <div class="col-md-6">
			    	<select name="payment_term" class="form-control payment_term input-sm">
			    		<?php
			    		if(get_credit_type())
			    		{
			    			foreach (get_credit_type() as $key => $value)
			    			{
			    				?>
			    					<option <?=($value['name']==$so['credit'])?"selected":"";?>
			    						value="<?=$value['id'];?>"><?=$value['name'];?></option>
			    				<?php
			    			}
			    		}
			    		?>
			    	</select>
			    </div>
			  </div>
			  <div class="col-md-4">
					<div class="form-group">
						<label class="col-md-6 control-label">Shipment Service :</label>
						<div class="col-md-6">
							<select name="payment_term" class="form-control shipment_service input-sm">
				    		<?php
				    		if(get_carrier())
				    		{
				    			foreach (get_carrier() as $key => $value)
				    			{
				    				?>
				    					<option <?=($value['name']==$so['carrier'])?"selected":"";?>
				    						value="<?=$value['id'];?>"><?=$value['name'];?></option>
				    				<?php
				    			}
				    		}
				    		?>
				    	</select>
						</div>
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
							<label class="col-md-4 control-label">Delivery:</label>
							<div class="col-md-8">
								<select class="form-control input-sm delivery_type">
									<?php
					    		if(get_shipping_type())
					    		{
					    			foreach (get_shipping_type() as $key => $value)
					    			{
						    			?>
						    				<option <?=($so['ship_type']==$value['type'])?"selected":"";?>
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
				<div class="col-md-12 padding-zero">
					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label">COD Fee : <b><?=($so['cod_fee'])?$so['cod_fee']:"NIL";?></b></label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="col-md-8 control-label">Fright Paid: <b><?=($so['freight_paid'])?$so['freight_paid']:"NIL";?></b></label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">Amount :<b><?=($so['amount'])?$so['amount']:"NIL";?></b>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Add. Amount :<b><?=($so['add_amount'])?$so['add_amount']:"NIL";?></b>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 pull-left succ_msg">
				</div>
				<div class="col-md-2 pull-right">
					<button class="btn pull-right btn-success" onclick="save_so_changes(<?=$so['id'];?>);">Save</button>
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
						<table class="table table-hover table-bordered product-cart">
						<thead>
							<th>Action</th><th>Product Name</th><th>Form</th><th>Color</th><th>Packaging</th><th>Unit Price</th>
							<th>Quantity</th><th>Total</th>
						</thead>
						<tbody>
							<?php
							if($so_details)
							{
								foreach ($so_details as $key => $value)
								{
									$tot[] = $value['unit_price'] * $value['qty'];
									?>
										<tr>
											<td>
												<a href="javascript:void(0);" class="btn btn-danger" 
														onclick="remove_so_product(<?=$value['so_id'];?>,<?=$value['rowid'];?>)";>
													<i class="fa fa-trash"></i>
												</a>
											</td>
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
					<label class="control-label">SO Instructions : <?=$so['so_instructions'];?></label>
				</div>
				<div class="col-md-12">
					<label class="control-label">BOL Instructions : <?=$so['bol_instructions'];?></label>
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
				$("#SOProcess .modal-body table.product-cart tbody").html(data.cart);
				$("#SOProcess .modal-body table.product-cart tfoot td.cart-total").html(data.cart_total);
				$("#SOProcess .order_total").html(data.cart_total);
			}
		});
	});

	$(".close_so_details").click(function(){
			$("#SOProcess .modal-body").html("<div class='text-center'><img src='"+base_url+"/assets/img/default.gif'></div>");
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