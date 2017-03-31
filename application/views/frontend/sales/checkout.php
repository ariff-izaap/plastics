 <div class="row">
    <div class="breadcrumbs">
      <?php echo set_breadcrumb(); ?>
        <a href="<?php echo $this->previous_url;?>" class="btn btn-sm pull-right"><i class="back_icon"></i> Back</a>
    </div>
  </div>
<?php //print_r($editdata); ?>
  <div class="row">

  <form name="checkout" id="checkout" method="POST" action="<?php echo site_url();?>salesorder/checkout">
    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo (isset($editdata['id']) && !empty($editdata['id']))?$editdata['id']:""; ?>" />
      <div class="form-grid col-md-8">
        <div class="form-group col-md-6 <?php echo (form_error('customer_id'))?'error':'';?>" data-error="<?php echo (form_error('customer_id'))? form_error('customer_id'):'';?>">
          <label required>Customer Name</label>
          <select name="customer_id" id="customer_id" onchange="get_customer_details(<?php echo $this->uri->segment(3);?>);" >
            <option value="">Select Customer</option>
            <?php if(count($customer)>0){
                foreach($customer as $ckey=>$cvalue){ ?>
                  <option value="<?php echo $cvalue['id'];?>" <?php echo set_select('customer_id',$cvalue['id'],(($editdata['customer_id'] == $cvalue['id'])?true:false));?>><?php echo $cvalue['business_name']; ?></option>  
               <?php }} ?>
          </select>
        </div>
       <div id="customer_details_view" class="col-md-12"> 
        <?php $this->load->view("frontend/sales/customer_details",$this->data);?>
       </div>
</div>  
<div class="col-md-4">
    
   <div class="form-group <?php echo (form_error('type'))?'error':'';?>" data-error="<?php echo (form_error('type'))? form_error('type'):'';?>" >
      <label>Type</label>
      <select name="type" class="form-group" >
        <option value="">Select Type</option>
         <?php if(count($saletype)>0){
                foreach($saletype as $tkey=>$tvalue){ ?>
                  <option value="<?php echo $tvalue['name'];?>" <?php echo set_select('type',$tvalue['name'],(($editdata['type'] == $tvalue['name'])?true:false));?>><?php echo $tvalue['name']; ?></option>  
         <?php }} ?>
      </select>
    </div>
   <div class="form-group <?php echo (form_error('shipping_type'))?'error':'';?>" data-error="<?php echo (form_error('shipping_type'))? form_error('shipping_type'):'';?>">
      <label>Shipping Type</label>
      <select name="shipping_type" class="form-group">
        <option value="">Select Shipping Type</option>
        <?php if(count($shipping_type)>0){ foreach($shipping_type as $skey => $svalue){ ?>
         <option value="<?php echo $svalue['id']; ?>" <?php echo set_select('shipping_type',$svalue['id'],(($editdata['shipping_type'] == $svalue['id'])?true:false));?>><?php echo $svalue['type']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))?form_error('credit_type'):'';?>" >
      <label>Credit Type</label>
      <select name="credit_type" class="form-group">
        <option value="">Select Credit Type</option>
        <?php if(count($credit_type)>0){ foreach($credit_type as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('credit_type',$cvalue['id'],(($editdata['credit_type'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="form-group <?php echo (form_error('carrier'))?'error':'';?>" data-error="<?php echo (form_error('carrier'))?form_error('carrier'):'';?>" >
      <label>Carrier</label>
      <select name="carrier" class="form-group">
        <option value="">Select Carrier</option>
        <?php if(count($carrier)>0){ foreach($carrier as $ckey => $cvalue){ ?>
         <option value="<?php echo $cvalue['id']; ?>" <?php echo set_select('carrier',$cvalue['id'],(($editdata['carrier'] == $cvalue['id'])?true:false));?> ><?php echo $cvalue['name']; ?></option>
        <?php }} ?>
      </select>
    </div>
    
    <div class="form-group <?php echo (form_error('order_status'))?'error':'';?>" data-error="<?php echo (form_error('order_status'))? form_error('order_status'):'';?>" >
      <label>Order Status</label>
      <select name="order_status" class="form-group" >
        <option value="">Select Status</option>
         <option value="NEW" <?php echo set_select('order_status',"NEW",(($editdata['order_status'] == "NEW")?true:false));?>>NEW</option>
         <option value="PROCESSING" <?php echo set_select('order_status',"PROCESSING",(($editdata['order_status'] == "PROCESSING")?true:false));?>>PROCESSING</option>
         <option value="PENDING" <?php echo set_select('order_status',"PENDING",(($editdata['order_status'] == "PENDING")?true:false));?>>PENDING</option>
         <option value="COMPLETED" <?php echo set_select('order_status',"COMPLETED",(($editdata['order_status'] == "COMPLETED")?true:false));?>>COMPLETED</option>
      </select>
    </div>
    <div class="form-group" >
      <label>SO Instructions</label>
      <textarea name="so_instructions" class="form-control"><?php echo $editdata['so_instructions']; ?></textarea>
    </div>
    <div class="form-group " >
      <label>BOL Instructions</label>
      <textarea class="form-control" name="bol_instructions"><?php echo $editdata['bol_instructions']; ?></textarea>
    </div>
     
  </div>
   <div class="form-group" id="cartItems">
     <?php $this->load->view("frontend/salesproductselection/cart_items",$this->data); ?>
   </div>
   
   
  
  <div class="form-group">
  </div>
  <div>
    <input type="submit" name="so" class="btn btn-default" value="<?php echo (isset($editdata['btn']))?$editdata['btn']:""; ?>" />
  </div>  
  </form> 
  
  
  <!-- view design-->
  <div class="container topsec_info m_top_5">
	<div class="row">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Sales Order</td>
    <td>Order Total</td>
    <td>Order Status</td>
    <td>Sales Channel</td>
    <td>Order Date</td>
    <td>Email ID</td>
  </tr>
  <tr>
    <td>#151697</td>
    <td>$199.98</td>
    <td>ACCEPTED</td>
    <td>test channel</td>
    <td>2015-08-24 19:18:19</td>
    <td>test@gmail.com</td>
  </tr>
</table>	
	</div>
</div>
  
  <!-- end -->
  
  <!-- start-->
  <div class="container m_top_5">
	
	<div class="row box_highilite">
		<div class="span4">
			<h3>Paid <br> Status <span><br>YES</span></h3>
		</div>
		<div class="span4 ps_sec_blue">
			<h3>Next <br>Due Date <span><br> 24 Aug  <br> 15</span></h3>
		</div>
		<div class="span4 nd_sec_yellow">
			<h3>Payment <br> Term <span><br>Advance</span></h3>
		</div>
		<!--<div class="span3 pt_sec_grey">
			<h3>Payment <br /> Method <span><br />authorize</span></h3>
		</div>-->
	</div>	
</div>


<!-- end-->




<div class="container">
	<div class="row">
		<!-- leftpanel menu section start here -->
		<div class="col-md-3 related">
        <h2 class="row">Related Links</h2>
      <ul>
      <li><a href="#"> Back to Purchase Order list</a>
       <li><a href="#"> Sales Order
       <ul>
        <li><a href="#"> SO#151697</a>
        
       
       </ul>
       
       </a>
        <li><a href="#"> Shipment</a>
        <ul>
        <li><a href="#"> SO#151697</a>
        
       
       </ul>
        
        </li>
         <li><a href="#"> Back to Purchase Order list</a></li>
      
      </ul>
					</div>

		<!-- right panel content section start here -->
		<div class="col-md-9 pull-right m_top_30">

			<!-- Shipping and Billing Information goes here.... -->
			<div class="row-fluid">

				<div class="col-md-6 span_half">
					<div class="row">
						<table class="table table-bordered">
							<thead class="greenbg_title txt_13">
								<tr>
									<th width="10%">Billing Information</th>
								</tr>
							</thead>
							<tbody class="white_bg">
								<tr>
									<td id="shipping_address" style="height: 120px;">
										<address><strong>Steve Mccourt</strong> <br>244 19 Ave NW <br>Calgary AB T2M 0Y2 <br>CA <br><abbr title="Phone">P:</abbr> 4034633096</address>									</td>									
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-md-6 span_half pull-right m_left_10">
					<div class="row">
						<table class="table table-bordered">
							<thead class="greenbg_title txt_13">
								<tr>
									<th width="10%">Shipping Information 
										 
											<a class="pull-right underline" style="color:orange;" href="javascript:void(0);" onclick="change_ship_addr('form',271816,151697,this)" data-original-title="" title="">Edit</a> 
																			</th>
								</tr>
							</thead>
							<tbody class="white_bg">
								<tr>
									<td id="billing_address">
										<address><strong>Steve Mccourt</strong> <br>244 19 Ave NW <br>Calgary AB T2M 0Y2 <br>CA <br><abbr title="Phone">P:</abbr> 4034633096</address>									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>

						<!-- Order Details goes here.... -->
				<div class="row oreder-details">
		<h2 class="pull-left">Order Details</h2> 

		<div class="pull-right m_top_15">

<div class="btn-group">
				
			<a class="btn btn-primary" onclick="issue_return_auth(151697, this)" href="javascript:;" data-original-title="" title="">Issue Return
			Auth</a></div>
			
			<div class="btn-group">
				
			<a class="btn btn-primary" onclick="issue_direct_refund(151697, this)" href="javascript:;" data-original-title="" title="">Issue Refund</a></div>

			<div class="btn-group">
				
			<a class="btn btn-primary" onclick="issue_refund_on_order(151697, this)" href="javascript:;" data-original-title="" title="">Issue Direct Refund</a></div>
	</div>

	</div>
	

			
	<form method="post" id="so_form">

	
	
	<div class="row m_bot_5">
		<table class="table table-bordered m_bot_10">
			<tbody class="light_green_bg green">
				<tr>
					<td align="left" width="33%">Vendor: <span class="black">DIOMEDICS					</span>
					</td>
					<td class="text-center" width="33%">Standard 2-6 days					</td>
					<td class="text-right" width="33%">Shipment status: NEW					</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-bordered table-striped">
			<thead class="greenbg_title">
				<tr>
					<th></th>
					<th>Product</th>
					<th>SKU</th>
					<th>QTY</th>
					<th>Unit Price</th>
					<th>Total</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody class="white_bg">
												<tr>
					<td><input name="op_select[]" value="190590" type="checkbox">
					</td>
					<td><a href="http://admin.healiohealth.com/product/view/2026" data-original-title="" title="">Infrared Light Therapy Polychromatic LED Therapy Device Model 900 </a>					</td>
					<td>DIO-D900					</td>
					<td>1					</td>
					<td>$169.50					</td>
					<td>$169.50					</td>
					<td>NEW					</td>
				</tr>
							</tbody>
		</table>
	</div>
	
	
	<div class="row m_bot_30">
		<div class="span4 pull-right">
			<table class="price_box pull-right  ash_gradiant_bg" width="100%">

				<tbody><tr>
					<td class="text-right" width="50%">Purchases:</td>
					<td width="1%">&nbsp;</td>
										<td class="green" width="49%">$169.50					</td>
				</tr>
				<tr>
					<td class="text-right">Shipping:</td>
					<td>&nbsp;</td>
					<td class="green">$22.00					</td>
				</tr>
				<tr>
					<td class="text-right">Tax:</td>
					<td>&nbsp;</td>
					<td class="green">$8.48					</td>
				</tr>
				<tr>
					<td class="text-right">Discount:</td>
					<td>&nbsp;</td>
					<td class="green">$0.00					</td>
				</tr>
				
				<tr class="green_solid_bg">
					<td class="text-right"><b>Total:</b>
					</td>
					<td>&nbsp;</td>
					<td><b>$199.98					</b>
					</td>
				</tr>

			</tbody></table>
					</div>
	</div>
	
	</form>
		

			<!-- Modal -->
			<div id="div_make_payment" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<form action="http://admin.healiohealth.com/user/make_payment" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-original-title="" title="">×</button>
						<h3 id="myModalLabel">Make Payment</h3>
					</div>

					<div class="modal-body" style="max-height: 489px; overflow: auto;">
						
					</div>

					<div class="modal-footer">
						<button type="button" onclick="make_payment('process', 107327,151697, this)" class="btn btn-primary" data-original-title="" title="">submit</button>
						<button class="btn" data-dismiss="modal" aria-hidden="true" id="modal_close" data-original-title="" title="">Close</button>

					</div>
				</form>
			</div>
			
				

			
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
												<tr>
			                <td>2015-08-24 19:18:20</td>
			                <td>#151697</td>
			                <td>$199.98</td>
			                <td>$0.00</td>
			                <td>$199.98</td>
			                <td> Customer account is debited by $199.98 .</td>
			             </tr>
												<tr>
			                <td>2015-08-24 19:18:20</td>
			                <td>#151697</td>
			                <td>$199.98</td>
			                <td>$199.98</td>
			                <td>$0.00</td>
			                <td> Customer account is credited by $199.98</td>
			             </tr>
												</tbody>
					</table>
					</div>
				</div>
				
			</div>
						
			<div class="row-fluid">
				<div class="span12">
					<div class="row">
						<h2>Notes</h2>						
					</div>
					<div class="row" id="notes_list">
						<div class="row-fluid notes_sec" id="notes_list">
	No notes found.
</div>

             	

					</div>
				</div>
				<div class="span12 pull-right m_left_10">					
					<div class="row loghistory_sec" id="logs_list"></div>
				</div>
			</div>

			

		</div>

	</div>
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