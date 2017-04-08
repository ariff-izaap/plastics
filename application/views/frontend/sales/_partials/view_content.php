<div class="row">
		<!-- leftpanel menu section start here -->
		<div class="col-md-3 related" id="relatedlinks">
			<?php echo $related_links;?>
		</div>

		<!-- right panel content section start here -->
			<!-- Shipping and Billing Information goes here.... -->
			<div class="row-fluid">

				<div class="col-md-4 span_half bill-info" >
					<div class="row">
						<table class="table table-bordered">
							<thead class="greenbg_title txt_13">
								<tr>
									<th width="10%">Billing Information
                                        <a class="pull-right underline" style="color:orange;" href="javascript:void(0);" onclick="change_billing_addr('form',<?php echo $so_details['billing_address_id'];?>,<?php echo $so_details['id'];?>,this)">Edit</a>
									</th>
								</tr>
							</thead>
							<tbody class="white_bg">
								<tr>
									<td id="shipping_address">
										<?php echo get_customer_billing_address($so_details['billing_address_id'], 'html');?>
									</td>									
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-md-4 span_half pull-right m_left_10 ship-info" >
					<div class="row">
						<table class="table table-bordered">
							<thead class="greenbg_title txt_13">
								<tr>
									<th width="10%">Shipping Information 
										<?php  if(strcmp($so_details['order_status'],"SHIPPED") !== 0) : ?> 
											<a class="pull-right underline" style="color:orange;" href="javascript:void(0);" onclick="change_ship_addr('form',<?php echo $so_details['shipping_address_id'];?>,<?php echo $so_details['id'];?>,this)">Edit</a> 
										<?php endif; ?>
									</th>
								</tr>
							</thead>
							<tbody class="white_bg">
								<tr>
									<td id="billing_address">
										<?php echo get_address_by_contact_id($so_details['shipping_address_id'], 'html');?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>

			<?php if($shipment_count == 0 && strcmp($so_details['order_status'], 'FAILED') !== 0 && strcmp($so_details['order_status'], 'PENDING') !== 0):?>
			<div id="div_manual_process" class="row-fluid">
				<?php echo $manual_process;?>
			</div>
			
			<!-- Modal -->
		    <div id="order_edit" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		      <form id="order_edit_<?php echo $so_id;?>" method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">Edit Order</h3>
		      </div>
		      
		      <div class="modal-body" style="height:60%;overflow:auto">
			      
		      	
			      
		      </div>
		      
		      <div class="modal-footer">
		       	<a href="javascript:;" class="btn btn-primary" onclick="edit_order_items(<?php echo $so_id;?>, this, 'process');">submit</a>
		        <button class="btn" data-dismiss="modal" aria-hidden="true" id="modal_close">Close</button>
		        
		      </div>
		      </form>
		    </div>
		    <!-- Modal -->
		    <div id="copy_price_list" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		      <form id="copy_price_list_<?php echo $so_id;?>" method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h3 id="myModalLabel">Copy Price List</h3>
		      </div>
		      
		      <div class="modal-body">
			      
		      	
			      
		      </div>
		      
		      <div class="modal-footer">
		      	<a href="javascript:;" class="btn btn-primary" onclick="copy_price_list(<?php echo $so_id;?>, 0, 0, 'process', this);">submit</a>
		      	<button class="btn" data-dismiss="modal" aria-hidden="true" id="modal_close">Close</button>
		        
		      </div>
		      </form>
	<?php endif;?>
		      <?php echo $order_details;?>
		    </div>
		
			<!-- Order Details goes here.... -->
			

			<!-- Modal -->
			<div id="div_make_payment" class="modal hide fade" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
				<form action="<?php echo site_url('user/make_payment')?>" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h3 id="myModalLabel">Make Payment</h3>
					</div>

					<div class="modal-body">
						
					</div>

					<div class="modal-footer">
						<button type="button" onclick="make_payment('process', <?php echo $so_details['customer_id'];?>,<?php echo $so_id;?>, this)" class="btn btn-primary" >submit</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true"
							id="modal_close">Close</button>

					</div>
				</form>
			</div>
			
			<?php if($so_details['paid_status']=='N'): ?>
				<button class="btn btn-primary pull-right" onclick="make_payment('form', <?php echo $so_details['customer_id'];?>,<?php echo $so_id;?>, this);"> Make Payment </button>
			<?php endif; ?>	

			<?php if( count($attachments) ): ?>
			<div class="row-fluid">	
				<div class="span12 pull-right m_left_10">					
					<div class="row">
						<h2>Attachments</h2>									
					</div>
					<div class="row" id="soattachments_list">
						<table class="table table-striped table-bordered">
							<thead class="graydarkbg_title nowrap">
								<tr id="grid-headers">
					                <th>Order Id</th>
					                <th>File Name</th>
					                <th>Download</th>					                
								</tr>
							</thead>
							<tbody>
							<?php foreach ($attachments as $file):?>
							<tr>
				                <td>#<?=displayData($file['so_id'],"string")?></td>
				                <td><?=displayData($file['file_name'],"string")?></td>
				                <td><a href="<?php echo $so_attachment_url.$file['file_name'];?>" target="_blank"><?php echo $file['file_name'];?></a></td>
				                </tr>
							<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
			<?php endif; ?>

			<?php if( count($payments) ): ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="row">
						<h2>Payment History</h2>	
									
					</div>
					<div class="row" id="payments_list">
					<table class="table table-striped table-bordered">

						<thead class="graydarkbg_title nowrap">
							<tr id="grid-headers">
				                <th>DATE</th>
				                <th>Order Id</th>
				                <th>Opening Balance</th>
				                <th>Paid</th>
				                <th>Closing Balance</th>
				                <th>Message</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($payments as $payment):?>
						<tr>
			                <td><?=displayData($payment['created_time'],"datetime",$payment)?></td>
			                <td>#<?=displayData($payment['sales_order_id'],"string",$payment)?></td>
			                <td><?=displayData($payment['opening_balance'],"money",$payment)?></td>
			                <td><?=displayData($payment['paid'],"money",$payment)?></td>
			                <td><?=displayData($payment['closing_balance'],"money",$payment)?></td>
			                <td><?=displayData($payment['message'],"string",$payment)?></td>
			             </tr>
						<?php endforeach;?>
						</tbody>
					</table>
					</div>
				</div>
				
			</div>
			<?php endif;?>
			
			<div class="row-fluid">
				<div class="col-sm-8 sales-notes m_left_10">
					<div class="row">
						<h2>Notes</h2>						
					</div>
                    <div id="div_add_note" class="modal fade" role="dialog" aria-hidden="true">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-body">
                          
                          </div>
                        </div>
                    </div>
					<div class="row" id="notes_list">
						<?php echo $notes;?>
					</div>
				</div>
				<div class="col-sm-8 log-histry m_left_10">					
					<div class="row loghistory_sec" id="logs_list"></div>
				</div>
			</div>
		</div>
	</div>	