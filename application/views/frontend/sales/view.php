
<!-- Modal -->
<div id="div_add_new_price" class="modal hide fade" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="<?php echo site_url('sales_orders/change_ship_addr/')."/".$so_details['shipping_address_id'];?>" method="post">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h3 id="myModalLabel">Change Shipping Address</h3>
		</div>

		<div class="modal-body" style="height:60%;overflow:auto">

		</div>

		<div class="modal-footer">
			<button type="button" onclick="change_ship_addr('process', <?php echo $so_details['shipping_address_id']; ?>, <?php echo $so_details['id']; ?>, this)" class="btn btn-primary" >submit</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true"
				id="modal_close">Close</button>

		</div>
	</form>
</div>


<!-- view design-->
  <div class="container topsec_info m_top_5">
	<div class="row">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Sales Order</td>
    <td>Order Total</td>
    <td>Order Status</td>
    <td>Order Date</td>
    <td>Email ID</td>
  </tr>
  <tr>
    <td><span style="color:#555555">#<?php echo $so_id;?></span></td>
    <td><?php echo displayData($order_total, 'money');?></td>
    <td><?php echo $so_details['order_status'];?></td>
    <td><?php echo displayData($so_details['created_time'], 'datetime');?></td>
    <td><?php echo displayData($user_details['email'], 'mailto');?></td>
  </tr>
</table>	
	</div>
</div>
  
  <!-- end -->
  
  <!-- start-->
  <div class="container m_top_5">
	
	<div class="row box_highilite">
		<div class="span4">
			<h3>Paid <br> Status <span><br><?php echo ($so_details['paid_status']=='Y')?'YES':'NO';?></span></h3>
		</div>
		<div class="span4 ps_sec_blue">
			<h3>Next <br>Due Date <?php echo ($next_due_date!=0) ? '<span><br /> '.date('d M',strtotime($next_due_date)).'  <br /> '.date('y',strtotime($next_due_date)).'</span>':'<span><br /> - </span>'?></h3>
		</div>
		<div class="span4 nd_sec_yellow">
			<h3>Payment <br> Term <?php echo $payment_term_name;?></h3>
		</div>
		<!--<div class="span3 pt_sec_grey">
			<h3>Payment <br /> Method <span><br />authorize</span></h3>
		</div>-->
	</div>	
</div>


<!-- end-->



<div class="container">
<?php echo $content;?>
	</div>
  
  
 <div id="updat_cart" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="sales_update_to_cart" id="sales_update_to_cart">
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
      <input type="hidden" name="cart_id" id="cart_id" value="" />
       <div class="row"> 
        <div class="form-group col-md-4">
            <label>Quantity</label>
            <input type="text" name="quantity" id="quantity"/>
        </div>
       </div>
     </div>  
     <div class="row">
        <div class="form-group col-md-4">
            <input type="button" name="cancel" onclick="modal_close();" data-dismiss="modal" class="btn btn-block" id="cancel" data-pid=""  value="Cancel" />
        </div>
        <div class="form-group col-md-4">  
            <input type="button" name="up_cart" onclick="sales_update_cart('');" data-dismiss="modal"  id="confirm" class="btn btn-block" value="Update" />
        </div>
     </div>
     </form>
     
    </div>
  </div>
</div>