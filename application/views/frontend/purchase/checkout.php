<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('purchase/add_product');?>" class="btn pull-right">Back</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata());?>

<form action="" name="checkoutForm" id="checkoutForm"  method="post">
	<div class="row">
		<div class="col-md-12 title">
			<h2 class="title"> Shipping Information</h2>
		</div>
		<div class="col-md-4">
			<div class="form-group col-md-12 <?php echo (form_error('warehouse'))?'error':'';?>" data-error="<?php echo (form_error('warehouse'))? strip_tags(form_error('warehouse')):'';?>">
	      <label required="">Ship To</label>
	      <select name="warehouse" class="form-control warehouse_select">
	      	<option value="">--Select Warehouse--</option>
	      	<?php
	      	if(get_warehouse())
	      	{
	      		foreach (get_warehouse() as $key => $value)
	      		{
			      	?>
			      		<option <?=$edit_data['warehouse_id']==$value['id'] ? 'selected' : '';?>
			      		 value="<?=$value['id'];?>"><?=$value['name'];?></option>
			      	<?php
			      }
			    }
	      	?>
	      </select>
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('wname'))?'error':'';?>" data-error="<?php echo (form_error('wname'))? strip_tags(form_error('wname')):'';?>">
	      <label required="">Warehouse Name</label>
	      <input type="text" class="form-control" name="wname" id="wname" value="<?=$edit_data['wname'];?>">
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('address1'))?'error':'';?>" data-error="<?php echo (form_error('address1'))? strip_tags(form_error('address1')):'';?>">
	      <label required="">Address 1</label>
	      <input type="text" class="form-control" name="address1" id="address1" value="<?=$edit_data['address1'];?>">
	    </div>
	    <div class="form-group col-md-12">
	      <label>Address 2</label>
	      <input type="text" class="form-control" name="address2" id="address2" value="<?=$edit_data['address2'];?>">
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? strip_tags(form_error('city')):'';?>">
	      <label required="">City</label>
	      <input type="text" class="form-control" name="city" id="city" value="<?=$edit_data['city'];?>">
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? strip_tags(form_error('state')):'';?>">
	      <label required="">State</label>
	      <select name="state" class="form-control" id="state">
          	<option value="">--Select--</option>
          	<?php
          		if(get_state())
          		{
          			foreach (get_state() as $key => $value)
          			{
          				?>
          					<option <?php if($edit_data['state']==$value['id']) { ?> selected <?php }?>
          						value="<?=$value['id'];?>"><?=$value['name'];?></option>
          				<?php
          			}
          		}
          	?>
        </select>
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('country'))?'error':'';?>" data-error="<?php echo (form_error('country'))? strip_tags(form_error('country')):'';?>">
	      <label required="">Country</label>
	      <select name="country" class="form-control" id="country">
          	<option value="">--Select--</option>
          	<?php
          		if(get_country())
          		{
          			foreach (get_country() as $key => $value)
          			{
          				?>
          					<option <?php if($edit_data['country']==$value['id']) { ?> selected <?php }?>
          						value="<?=$value['id'];?>"><?=$value['name'];?></option>
          				<?php
          			}
          		}
          	?>
        </select>
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? strip_tags(form_error('zipcode')):'';?>">
	      <label required="">Zipcode</label>
	      <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?=$edit_data['zipcode'];?>">
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('phone'))?'error':'';?>" data-error="<?php echo (form_error('phone'))? strip_tags(form_error('phone')):'';?>">
	      <label required="">Phone</label>
	      <input type="text" class="form-control" name="phone" id="phone" value="<?=$edit_data['phone'];?>">
	    </div>
	    <div class="form-group col-md-12 <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? strip_tags(form_error('email')):'';?>">
	      <label required="">Email</label>
	      <input type="text" class="form-control" name="email" id="email" value="<?=$edit_data['email'];?>">
	    </div>
	  </div>
	  <div class="col-md-8">
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
			      		<option <?=$edit_data['ship_type_id']==$value['id'] ? 'selected' : '';?>
			      			value="<?=$value['id'];?>"><?=$value['type'];?></option>
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
			      		<option <?=$edit_data['carrier_id']==$value['id'] ? 'selected' : '';?>
			      			value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
			      		<option <?=$edit_data['credit_type_id']==$value['id'] ? 'selected' : '';?>
			      			value="<?=$value['id'];?>"><?=$value['name'];?></option>
			      	<?php
			      }
			    }
	      	?>
	      </select>
	    </div>
		</div>	
		<input type="hidden" name="po_id" id="po_id" value="<?=$po_id;?>">
		<div class="col-md-8" id="viewCart">
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
	      <textarea class="form-control" name="po_message" rows="4"><?=$edit_data['po_message'];?></textarea>
	    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group col-md-12">
	      <label required="">PO Notes</label>
	      <textarea class="form-control" name="po_notes" rows="4"><?=$edit_data['note'];?></textarea>
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
