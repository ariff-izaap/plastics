<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('purchase/add_product');?>" class="btn pull-right">Back</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata());?>
<form action="" method="post">
	<div class="row">
		<div class="col-md-12">
			<h2> Shipping Information</h2>
			<div class="form-group col-md-4 <?php echo (form_error('warehouse'))?'error':'';?>" data-error="<?php echo (form_error('warehouse'))? strip_tags(form_error('warehouse')):'';?>">
	      <label required="">Ship To</label>
	      <select name="warehouse" class="form-control">
	      	<option value="">--Select Warehouse--</option>
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
	    <div class="form-group col-md-4 <?php echo (form_error('ship_type'))?'error':'';?>" data-error="<?php echo (form_error('ship_type'))? strip_tags(form_error('ship_type')):'';?>">
	      <label required="">Ship Method</label>
	      <select name="ship_type" class="form-control">
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
	    <div class="form-group col-md-4 <?php echo (form_error('carrier'))?'error':'';?>" data-error="<?php echo (form_error('carrier'))? strip_tags(form_error('carrier')):'';?>">
	      <label required="">Ship Service</label>
	      <select name="carrier" class="form-control">
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
	    <div class="form-group col-md-4 <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))? strip_tags(form_error('credit_type')):'';?>">
	      <label required="">Payment Term</label>
	      <select name="credit_type" class="form-control">
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
	<input type="hidden" name="po_id" id="po_id" value="<?=$po_id;?>">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12" id="viewCart">
			<h2>Review Order</h2>
			<table class="table table-bordered table-hover">
				<thead>
					<th>Product Name</th><th>SKU</th><th>Quantity</th><th>Unit Price</th><th>Total</th><th>Action</th>
				</thead>
				<tbody>				
					<?php
						if($products)
						{
							$total = [];
							foreach ($products as $key => $value)
							{
								$total[] = $value['unit_price'] * $value['qty'];
								?>
								<tr>
									<td><?=$value['p_name'];?></td>
									<td><?=$value['sku'];?></td>
									<td><?=$value['qty'];?></td>
									<td><?=displayData($value['unit_price'],'money');?></td>
									<td><?=displayData($value['unit_price'] * $value['qty'],'money');?></td>
									<td>
										<a href="#" onclick="remove_cart(<?=$value['rowid'];?>,this);" class="btn">X</a>
									</td>
								</tr>
								<?php
							}
						}
					?>
				</tbody>
			</table>
			<input type="hidden" name="total" value="<?=array_sum($total);?>">
			<div class="row">
				<div class="col-md-3 pull-right">
					<h3>Total : <strong><?=displayData(array_sum($total),'money');?></strong></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group col-md-12">
	      <label required="">PO Message</label>
	      <textarea class="form-control" name="po_message" rows="4"></textarea>
	    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group col-md-12">
	      <label required="">PO Notes</label>
	      <textarea class="form-control" name="po_notes" rows="4"></textarea>
	    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group col-md-12">
	      <button type="submit" class="btn">Order Now</button>
	    </div>
		</div>
	</div>
</form>
