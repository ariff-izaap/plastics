<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><strong>PO - #<?=$po['po_id'];?></strong></h4>
</div>
<div class="modal-body">
<div class="blue-mat"></div>
	<div class="row">
		<div class="col-md-4">
			<label>PO Status : <strong><?=displayData($po['order_status'],'colorize');?></strong></label>
		</div>
		<div class="col-md-4">
			<label>Total : <strong><?=displayData($po['total_amount'],'money');?></strong></label>
		</div>
		<div class="col-md-4">
			<label>Paid Status : <strong><?=$po['is_paid'];?></strong></label>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-12">
      <div class="panel with-nav-tabs panel-primary">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1primary" data-toggle="tab">General Details</a></li>
            <li><a href="#tab2primary" data-toggle="tab">Billing Details</a></li>
            <li><a href="#tab3primary" data-toggle="tab">Order Details</a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1primary">
            	<div class="row">
	            	<div class="col-md-3">
	            		<label>Vendor : <strong><?=$po['vendor_name'];?></strong></label>
	            	</div>
	            	<div class="col-md-5">
	            		<label>Ordered Date : <strong><?=displayData($po['created_date'],'datetime');?></strong></label>
	            	</div>
	            	<div class="col-md-4">
	            		<label class="col-md-5">Status :</label>
	            		<div class="col-md-7">
	            			<select class="form-control order_status">
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
            	</div><br>
            	<div class="row">
	            	<div class="col-md-4">
	            		<label>Shipment Type : <strong><?=$po['ship_type'];?></strong></label>
	            	</div>
	            	<div class="col-md-4">
	            		<label>Shipment Service : <strong><?=$po['carrier'];?></strong></label>
	            	</div>
	            	<div class="col-md-4">
	            		<label>Payment Term : <strong><?=$po['credit'];?></strong></label>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<label><strong>Notes : </strong></label>
	            		<br><?=$po['note'];?>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-12">
	            		<label><strong>PO Message :</strong> </label>
	            		<br><?=$po['po_message'];?>
	            	</div>
	            </div>
	            <div class="row">
	            	<div class="col-md-2 pull-right">
	            		<button class="btn change_order_status" data-id="<?=$po['po_id'];?>">Save Changes</button>
	            	</div>
	            </div>
            </div>
            <div class="tab-pane fade" id="tab2primary">
            	<div class="row">
            		<div class="col-md-6">
            			<h4>Billing Information</h4><br>
            			<p><strong><?=$po['wname'];?></strong></p>
            			<p><?=$po['address1'].", ".$po['address2'];?></p>
            			<p><?=$po['city'].", ".$po['state_name'];?></p>
            			<p><?=$po['country_name']." - ".$po['zipcode'];?></p>
            			<p>Phone : <?=$po['phone'];?></p>
            			<p>Email : <?=$po['email'];?></p>
            		</div>
            		<div class="col-md-6">
            			<h4>Shipping Information</h4><br>
            			<p><strong><?=$po['wname'];?></strong></p>
            			<p><?=$po['address1'].", ".$po['address2'];?></p>
            			<p><?=$po['city'].", ".$po['state_name'];?></p>
            			<p><?=$po['country_name']." - ".$po['zipcode'];?></p>
            			<p>Phone : <?=$po['phone'];?></p>
            			<p>Email : <?=$po['email'];?></p>
            		</div>
            	</div>
            </div>
            <div class="tab-pane fade" id="tab3primary">
            	<table class="table table-hover table-bordered">
            		<thead>
            			<th>Product Name</th><th>SKU</th><th>Quantity</th><th>Unit Price</th><th>Total</th>
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
            				<td colspan="4" class="text-right"><strong>Sub Total</strong></td>
            				<td colspan="1"><?=displayData(array_sum($tot),'money');?></td>
            			</tr>
            			<tr>
            				<td colspan="4" class="text-right"><strong>Shipping Charge</strong></td>
            				<td colspan="1">0.00</td>
            			</tr>
            			<tr>
            				<td colspan="4" class="text-right"><strong>Total</strong></td>
            				<td colspan="1"><?=displayData(array_sum($tot),'money');?></td>
            			</tr>
            		</tfoot>
            	</table>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
<script type="text/javascript">
	
$(".change_order_status").click(function(){
  id = $(this).attr("data-id");
  val = $(".order_status").val();
  $.ajax({
  	type:"POST",
  	url:base_url+'purchase/change_order_status',
  	data:{id:id,val:val},
  	success:function(data)
  	{
  		data = JSON.parse(data);
  		service_message(data.status,data.message);
  	}
  });
});
</script>