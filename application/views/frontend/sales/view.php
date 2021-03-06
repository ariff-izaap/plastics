	<div class="row blue-mat">
	    <div class="breadcrumbs col-md-6">
	      <?php echo set_breadcrumb(); ?>
	      <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
	    </div>
	    <div class="col-md-6 action-buttons text-right">
	      <a href="<?php echo site_url('salesorder/customer_relation');?>" class="btn btn-danger" capsOn>Back</a>
	      <a href="<?php echo site_url('salesorder/print_sales/'.$so_id.'');?>" target="_blank" class="btn btn-info" capsOn>Print</a>
	  </div>
	</div>
<div class="sales-order-view-section">
<!-- Shipping Address Modal -->
<div id="div_add_new_price" class="modal fade " role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo site_url('salesorder/change_ship_address/')."/".$so_details['shipping_address_id'];?>" method="post">
	    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="popup_close('#div_add_new_price');">&times;</button>
		<h3 id="myModalLabel">Change Shipping Address</h3>
      </div>
      <div class="modal-body">
      
      </div>
      <div class="modal-footer">
				<button type="button" onclick="change_ship_addr('process', <?php echo $so_details['shipping_address_id']; ?>, <?php echo $so_details['id']; ?>, this)" class="btn btn-primary" >submit</button>
				<button class="btn" data-dismiss="modal" aria-hidden="true" id="modal_close">Close</button>
			</div>
    </div>
  </form>
</div>

<!-- Billing Address Modal -->
<div id="div_addr_billing" class="modal fade" role="dialog" aria-labelledby="billingModalLabel" aria-hidden="true">
   <form action="<?php echo site_url('salesorder/change_billing_address/')."/".$so_details['billing_address_id'];?>" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" onclick="popup_close('#div_addr_billing');">&times;</button>
			<h3 id="billingModalLabel">Change Billing Address</h3>
		</div>
      <div class="modal-body">
      
      </div>
      <div class="modal-footer">
			<button type="button" onclick="change_billing_addr('process', <?php echo $so_details['billing_address_id']; ?>, <?php echo $so_details['id']; ?>, this)" class="btn btn-primary" >submit</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true" id="modal_close">Close</button>
		</div>
    </div>
  </form>
</div>


<!-- view design-->
  <div class="container topsec_info ">
	<div class="row">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Sales Order</td>
    <td>Order Total</td>
    <td>Order Status</td>
    <td>Order Date</td>
    <td>Customer Name</td>
    <td>Email ID</td>
  </tr>
  <tr>
    <td><span style="color:#555555">#<?php echo $so_id;?></span></td>
    <td><?php echo displayData($order_total, 'money');?></td>
    <td><?php //echo $so_details['order_status'];?>ACCEPTED</td>
    <td><?php echo displayData($so_details['created_date'], 'datetime');?></td>
    <td><?php echo $user_details['customer_name'];?></td>
    <td><?php echo $user_details['email'];?></td>
  </tr>
</table>	
	</div>
</div>
  
  <!-- end -->
  
  <!-- start-->
  <div class="container m_top_5">
	
	<div class="row box_highilite">
		<div class="span4">
			<h3>Paid  Status <span><br><?php echo ($so_details['paid_status']=='Y')?'YES':'NO';?></span></h3>
		</div>
		<div class="span4 ps_sec_blue">
			<h3>Next Due Date <?php echo ($next_due_date!=0) ? '<span><br /> '.date('d M',strtotime($next_due_date)).'  <br /> '.date('y',strtotime($next_due_date)).'</span>':'<span><br /> - </span>'?></h3>
		</div>
		<div class="span4 nd_sec_yellow">
			<h3>Payment Term <span><br><?php echo $payment_term_name;?></span></h3>
		</div>
   
	
  
		<!--<div class="span3 pt_sec_grey">
			<h3>Payment <br /> Method <span><br />authorize</span></h3>
		</div>-->
	</div>	
   <!--
 <div class="create-invoice">
    <a href="<?php //echo site_url("salesorder/invoice/").$so_id; ?>" class="btn btn-default">Create Invoice</a></div>
-->
</div>


<!-- end-->



<div class="container">
<?php echo $content;?>
	</div>
  
  
 
</div>