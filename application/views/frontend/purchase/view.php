<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
      <div class="col-md-6 breadcrumbs-span">
        <?php echo set_breadcrumb(); ?>
      </div>
    <a href="<?=site_url('purchase');?>" class="btn pull-right">Back</a>
  </div>
</div>
<?php display_flashmsg($this->session->flashdata());?>
<?php
	$po_id = $po['po_id'];
?>
<div class="row">
 	<div class="col-md-2 pull-right">
 		<a href='<?=site_url("purchase/print_purchase/$po_id");?>' target="_blank" class="btn">Print</a>
 	</div>
</div>
<div class="sales-order-view-section">
	<div class="container topsec_info ">
		<div class="row">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>Purchase Order</td>
					<td>Order Total</td>
					<td>Order Status</td>
					<td>Order Date</td>
					<td>Vendor Name</td>
				</tr>
				<tr>
					<td><span style="color:#555555">#<?php echo $po['po_id'];?></span></td>
					<td><?php echo displayData($po['total_amount'], 'money');?></td>
					<td><?php echo displayData($po['status'], 'colorize');?></td>
					<td><?php echo displayData($po['created_date'], 'datetime');?></td>
					<td><?php echo $po['vendor_name'];?></td>
				</tr>
			</table>	
		</div>
	</div>
	<div class="container m_top_5">
		<div class="row box_highilite">
			<!-- <div class="col-md-2">
				<h3>Paid  Status <span><br><?php echo ($po['is_paid']=='PAID')?'YES':'NO';?></span></h3>
			</div> -->
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
		<!-- <div class="create-invoice">
			<a target="_blank" href="<?php echo site_url("purchase/print_purchase/").$po['po_id']; ?>" class="btn btn-default">Print</a>
		</div> -->
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
		<h3>Product Information</h3>
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
	<div class="container m_top_5">
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
	</div>
	<div class="container m_top_5">
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