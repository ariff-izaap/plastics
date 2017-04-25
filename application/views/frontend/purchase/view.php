<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
      <div class="col-md-6 breadcrumbs-span">
        <?php echo set_breadcrumb(); ?>
      </div>
    <a href="<?=site_url('purchase');?>" class="btn btn-danger pull-right">Back</a>
  </div>
</div>
<?php display_flashmsg($this->session->flashdata());?>
<?php
	$po_id = $po['po_id'];
?>
<div class="row">
 	<div class="col-md-2 pull-right">
 		<a href='<?=site_url("purchase/print_purchase/$po_id");?>' target="_blank" class="btn btn-success">Print</a>
 	</div>
</div>
<div class="sales-order-view-section">
	<div class="container topsec_info ">
		<div class="row">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>Purchase Order</td>
					<td>Order Total</td>
					<td>PO Status</td>
					<td>Order Date</td>
				</tr>
				<tr>
					<td><span style="color:#555555">#<?php echo $po['po_id'];?></span></td>
					<td><b><?php echo displayData($po['total_amount'], 'money');?></b></td>
					<td><?php echo displayData($po['order_status'], 'colorize');?></td>
					<td><?php echo displayData($po['created_date'], 'datetime');?></td>
				</tr>
			</table>	
		</div>
	</div>
	<!-- <div class="container m_top_5">
		<div class="row box_highilite">
			<div class="col-md-3 ps_sec_blue">
				<h3>Shipment Service <span><br><?=$po['carrier'];?></span></h3>
			</div>
			<div class="col-md-3 ps_sec_blue">
				<h3>Payment Term <span><br><?php echo $po['credit'];?></span></h3>
			</div>
			<div class="col-md-4">
				<h3>Delivery : <?=$po['ship_type'];?></h3>
			</div>			
		</div>
	</div> --><br>
	<div class="container m_top_5" style="border: 1px solid #ccc;border-radius: 5px;padding: 10px;">
		<form action="<?=site_url('purchase/change_order_status');?>" method="post">
			<input type="hidden" name="po_id" value="<?=$po['po_id'];?>">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label class="col-md-12 control-label">Vendor : <b><?=$po['vendor_name'];?></b></label>						
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-6 control-label">Shipment Service :</label>
							<div class="col-md-6">
								<select class="form-control" name="shipment_service">
								<?php
									if(get_carrier())
									{
										foreach (get_carrier() as $key => $value)
										{
											?>
											<option <?=($value['name']==$po['carrier']) ? "selected" : "";?>
												 value="<?=$value['id'];?>"><?=$value['name'];?></option>
											<?php
										}
									}
								?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-6 control-label">Payment Term :</label>
							<div class="col-md-6">
								<select class="form-control" name="payment_term">
								<?php
									if(get_credit_type())
									{
										foreach (get_credit_type() as $key => $value)
										{
											?>
											<option <?=($value['name']==$po['credit']) ? "selected" : "";?>
												 value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
					<div class="col-md-3">
						<div class="form-group">
							<label class="col-md-4 control-label">Delivery :</label>
							<div class="col-md-8">
								<select class="form-control" name="delivery">
								<?php
									if(get_shipping_type())
									{
										foreach (get_shipping_type() as $key => $value)
										{
											?>
											<option <?=($value['type']==$po['ship_type']) ? "selected" : "";?>
												 value="<?=$value['id'];?>"><?=$value['type'];?></option>
											<?php
										}
									}
								?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-6 control-label">Status :</label>
							<div class="col-md-6">
								<select class="form-control" name="po_status">
									<option value="NEW" <?php if($po['order_status']=='NEW'){?> selected <?php }?>>NEW</option>
		      				<option value="PROCESSING" <?php if($po['order_status']=='PROCESSING'){?>selected <?php }?>>PROCESSING</option>
		      				<option value="PENDING" <?php if($po['order_status']=='PENDING'){?> selected <?php }?>>PENDING</option>
		      				<option value="ACCEPTED" <?php if($po['order_status']=='ACCEPTED'){?> selected <?php }?>>ACCEPTED</option>
		      				<option value="SHIPPED" <?php if($po['order_status']=='SHIPPED'){?> selected <?php }?>>SHIPPED</option>
		      				<option value="COMPLETED" <?php if($po['order_status']=='COMPLETED'){?> selected <?php }?>>COMPLETED</option>
		      				<option value="HOLD" <?php if($po['order_status']=='HOLD'){?> selected <?php }?>>HOLD</option>
		      				<option value="CANCELLED" <?php if($po['order_status']=='CANCELLED'){?> selected <?php }?>>CANCELLED</option>
		      				<option value="IGNORED" <?php if($po['order_status']=='IGNORED'){?> selected <?php }?>>IGNORED</option>
		      				<option value="RECEIVED" <?php if($po['order_status']=='RECEIVED'){?> selected <?php }?>>RECEIVED</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="col-md-6 control-label">Release To Sold :</label>
							<div class="col-md-6">
								<select class="form-control" name="release_to_sold">
									<option value="No" <?=($po['release_to_sold']=="No")? "selected":"";?>>No</option>
									<option value="Yes" <?=($po['release_to_sold']=="Yes")? "selected":"";?>>Yes</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-7 col-md-offset-5">
					<button class="btn btn-success access-level"><i class="fa fa fa-life-saver"></i>Save Changes</button>
				</div>
			</div>
		</form>
	</div><br>
	<div class="container m_top_5">
		<div class="row">
			<div class="col-md-4 span_half bill-info">
				<div class="row">
					<table class="table table-bordered">
						<thead class="greenbg_title txt_13">
							<tr>
								<th width="10%">Billing Information</th>
							</tr>
						</thead>
						<tbody class="white_bg">
							<tr>
								<td id="shipping_address" data-title="Billing Information Edit">
									<address><strong>Ram Bill</strong> <br>Bill Address 1 <br>Bill Address 2 <br>Bill City Arizona  <br>United States of America <br><abbr title="Phone">P:</abbr> 58512</address>									</td>									
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4 span_half bill-info pull-right">
				<div class="row">
					<table class="table table-bordered">
						<thead class="greenbg_title txt_13">
							<tr>
								<th width="10%">Shipping Information</th>
							</tr>
						</thead>
						<tbody class="white_bg">
							<tr>
								<td id="shipping_address" data-title="Billing Information Edit">
									<address><strong>Ram Bill</strong> <br>Bill Address 1 <br>Bill Address 2 <br>Bill City Arizona  <br>United States of America <br><abbr title="Phone">P:</abbr> 58512</address>									</td>									
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="container m_top_5">
		<h3 class="col-md-2">Ordered Items</h3>
		<?php if($po['order_status']=="NEW" || $po['order_status']=="PENDING" || $po['order_status']=="PROCESSING"){?>
		<div class="col-md-1 pull-right">
			<a href="#ProductModal"  data-toggle="modal" class="btn btn-warning pull-right">Add Product</a>
		</div>
		<?php }?>
		<div class="col-md-2 pull-right">
			<a href="#ReceivedQty" data-toggle="modal" class="btn btn-warning">Edit Received Quantity</a>
		</div>
		<table class="table table-hover table-bordered">
  		<thead>
  			<th>Product Name</th><th>SKU</th><th>Ordered Quantity</th><th>Received Quantity</th><th>Unit Price</th><th>Total</th>
  		</thead>
  		<tbody>
  			<?php
  			if($products)
  			{
  				$tot = [];
  				foreach ($products as $key => $value)
  				{
  					$tot[] = $value['qty'] * $value['unit_price'];
  					?>
  						<tr>
  							<td><?=$value['p_name'];?></td>
  							<td><?=$value['sku'];?></td>
  							<td><?=$value['qty'];?></td>
  							<td><?=$value['qty_received'];?></td>
  							<td><?=displayData($value['unit_price'],'money');?></td>
  							<td><?=displayData($value['unit_price'] * $value['qty'],'money');?></td>
  						</tr>
  					<?php
  				}
  			}
  			?>
  		</tbody>
  		<tfoot>
  			<tr>
  				<td colspan="5" class="text-right"><strong>Sub Total</strong></td>
  				<td colspan="1"><?=displayData(array_sum($tot),'money');?></td>
  			</tr>
  			<tr>
  				<td colspan="5" class="text-right"><strong>Shipping Charge</strong></td>
  				<td colspan="1">0.00</td>
  			</tr>
  			<tr>
  				<td colspan="5" class="text-right"><strong>Total</strong></td>
  				<td colspan="1"><?=displayData(array_sum($tot),'money');?></td>
  			</tr>
  		</tfoot>
	  </table>
	</div>
	<div class="container m_top_5">
		<div class="row">
	    <div class="col-md-12">
	        <label><strong>Notes : </strong></label>
	        <br><?=$po['note'];?>
	    </div>
	  </div><br>
	  <div class="row">
	    <div class="col-md-12">
	      <label><strong>PO Message :</strong> </label>
	      <br><?=$po['po_message'];?>
	    </div>
	  </div>
	</div>
	<br>
	<div class="container m_top_5">
		<a href="javascript:void(0);" class="btn show_log_btn btn-info">Show Log History</a>
	</div><br>
	<div id="ShowLog" class="hide container m_top_5">
		<div class="row" id="LogHistory">
      <div class="col-md-12">
        <h3>Log History</h3>
        <table class="table table-bordered table-hover">
        <thead>
          <th>Description</th><th>Created Date</th><th>Created By</th>
        </thead>
        <tbody>
          <?php
            $logs = get_logs("purchase",$po['po_id']);
            foreach ($logs as $key => $value)
            {
              ?>
                <tr>
                  <td><?=$value['action'];?></td>
                  <td><?=displayData($value['created_date'],'datetime');?></td>
                  <td><?=$value['created_name'];?></td>
                </tr>
              <?php
            }
          ?>
        </tbody>
        </table>
      </div>
    </div>
	</div>
</div>
<br><br>



<div id="ReceivedQty" class="modal fade">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Received Products Details</strong></h4>
      </div>
      <div class="modal-body">
      	<form action="" method="post" id="ReceivedQtyForm">
        	<table class="table table-bordered table-hover">
        	<thead>
        		<th width="15%">SKU</th><th width="55%">Product Name</th><th>Ordered Quantity</th><th>Received Quantity</th>
        	</thead>
        	<tbody>
        		<?php
			  			if($products)
			  			{
			  				$tot = [];
			  				foreach ($products as $key => $value)
			  				{
			  					$qty[] = $value['qty'];
			  					$rqty[] = $value['qty_received'];
			  					$tot[] = $value['qty'] * $value['unit_price'];
			  					?>
			  						<tr>
			  							<td><?=$value['sku'];?></td>
			  							<td><?=$value['p_name'];?></td>
			  							<td><?=$value['qty'];?></td>
			  							<td>
			  								<input type="number" class="form-control" min="<?=$value['qty_received'];?>" max="<?=$value['qty'];?>"
			  									name="row[<?=$value['id'];?>]" value="<?=$value['qty_received'];?>">
			  									<input type="hidden" name="product[<?=$value['id'];?>]" value="<?=$value['product_id'];?>">
			  							</td>
			  						</tr>
			  					<?php
			  				}
			  			}
			  			?>
        	</tbody>
        	</table>
        </form>
      </div>
      <div class="modal-footer">
      	<?php
      		if(array_sum($qty) != array_sum($rqty))
      		{
      			?>
        		<button class="btn btn-primary save-recevived-qty">Save</button>
        		<?php
        	}
        	?>
        <button class="btn btn-danger"  data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="ProductModal" class="modal fade">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Add Product </strong></h4>
      </div>
      <div class="modal-body">
      	<form action="" method="post" id="ModalAddProductForm">
					<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-3">Vendor : <b><?=$po['vendor_name'];?></b></label>
						</div>
						<div class="form-group">
							<label class="col-md-2">Product : </label>
							<div class="col-md-4">
								<select class="select2_sample2 form-control" data-placeholder="Select Product" name="product_id">
									<option value="">--Select Product--</option>
									<?php
									$pro = get_products_by_vendor($po['vendor_id']);
									if($pro)
									{
										foreach ($pro as $key => $value)
										{
											?>
												<option value="<?=$value['id'];?>"><?=$value['name'];?> - <?=displayData($value['wholesale_price'],'money');?></option>
											<?php
										}
									}?>
								</select>
							</div>
						</div>
						<div class="clearfix"></div><br>
						<div class="form-group">
							<label class="col-md-2">Qty : </label>
							<div class="col-md-4">
								<input type="text" name="qty" class="form-control">
								<input type="hidden" name="po_id" class="form-control" value="<?=$po['po_id'];?>">
							</div>
						</div>
					</div>
					</div>
				</form>
      </div>
      <div class="modal-footer">
        <button class="btn add-product-modal btn-primary"  data-dismiss="modal">Add</button>
      </div>
    </div>
  </div>
</div>