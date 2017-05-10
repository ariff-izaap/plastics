<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
    <?php echo set_breadcrumb(); ?>
    <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
  </div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<div class="purchase-loader">
  <img src="<?=base_url();?>assets/img/rolling.gif">
</div>
<div class="row-fluid">
	<div class="container">	
		<div class="row">
			<form action="" method="post" id="CustomerForm">
				<div class="col-md-6 panel panel-default panel-bor dashboard">
        <div class="panel-heading formcontrol-box">
					<h3 class="text-center dashboard-title">Customer</h3>
          <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-3">Name</label>
								<div class="col-md-9">
									<input type="text" name="business_name" class="form-control customer_name" placeholder="Name">
									<input type="hidden" name="customer_id" class="form-control customer_id">
								</div>
							</div>
						</div>
            <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Phone</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_phone" name="phone" placeholder="Phone">
								</div>
							</div>
						</div>						
					</div>                    
					<div class="row">						
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Contact</label>
								<div class="col-md-9">
									<input type="text" name="contact_name" class="form-control customer_contact" placeholder="Contact Name">
								</div>
							</div>
						</div>
						<!--/span-->
	          <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Address</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_address" placeholder="Address" name="address1">
									<input type="hidden" class="form-control address_id" name="address_id">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">City</label>
								<div class="col-md-9">
									<input type="text" name="city" class="form-control customer_city" placeholder="City">
								</div>
							</div>
						</div>
						<!--/span-->
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">State</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_state" name="state" placeholder="State">
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<div class="row">						
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Zipcode</label>
								<div class="col-md-9">
									<input type="text" name="zipcode" class="form-control customer_zipcode" placeholder="Zipcode">
								</div>
							</div>
						</div>
						<!--/span-->
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Fax</label>
								<div class="col-md-9">
									<input type="text" name="fax" class="form-control customer_fax" placeholder="Fax">
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<div class="row">					
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">F/M</label>
								<div class="col-md-9">
									<select name="contact_type" class="form-control contact_type input-sm">
										<option value="1">F</option>
										<option value="2">M</option>
									</select>
								</div>
							</div>
						</div>
	          <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Lastcall</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_call" placeholder="Last Call">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
					
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Callback</label>
								<div class="col-md-9">
									<input type="text" name="" class="form-control" placeholder="Call Back">
								</div>
							</div>
						</div>
						<!--/span-->
                        	<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Salesman</label>
								<div class="col-md-9">
									<select class="form-control input-sm onepage_salesman" name="salemsan">
										<option value="">--Select--</option>
										<?php
											$sales = get_all_users_by_role('2');
											if($sales)
											{
												foreach ($sales as $key => $value)
												{
													?>
														<option value="<?=$value['id'];?>"><?=$value['first_name'];?></option>
													<?php
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<div class="row">
					
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Credit</label>
								<div class="col-md-9">
									<select class="input-sm form-control customer_credit" name="credit_type">
										<option value="">--Select--</option>
										<?php
											$sales = get_credit_type();
											if($sales)
											{
												foreach ($sales as $key => $value)
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
						<!--/span-->
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Materials</label>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="Materials">
								</div>
							</div>
						</div>
						<!--/span-->
					</div>
					<div class="row">							
						<div class="col-md-12 text-left">
							<div class="form-group">
								<label class="control-label col-md-2 padding-zero">
									<a href="#CustomerComments" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn disabled btn-info customer_comments" style="padding: 2px;">Comments</a>
								</label>
								<div class="col-md-10 padding-zero">
									<textarea name="" class="form-control customer_comments" readonly placeholder="Comments"></textarea>
								</div>
							</div>
						</div>
						<!--/span-->
					</div>				
					<div>
						<button class="btn btn-info customer-search-btn" type="button">Search</button>
						<a href="#POProcess" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn disabled btn-info po_history_btn">PO History</a>
						<a href="#SOProcess" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn disabled btn-info so_history_btn">SO History</a>						
						<a href="#LogCall" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info disabled log_call">Log Call</a>
						<a href="#ViewLog" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info view_log disabled">View Log</a>
						<a href="javascript:void(0);" onclick="update_customer();" class="btn btn-info disabled">Update</a>
					</div>
				</div>
    		</div>
    	</form>
    	<form action="" method="post" id="InventoryForm">
				<div class="col-md-6 panel panel-default panel-bor dashboard dashboard1">
					<input type="hidden" name="product_id" class="product_id">
		    	<div class="panel-heading formcontrol-box">
						<h3 class="text-center dashboard-title">Inventory</h3>
						<div class="row">
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="col-md-4">SKU</label>
									<div class="col-md-8">
										<input type="text" name="sku" class="form-control product_sku" placeholder="SKU">
									</div>
								</div>					
							</div>
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control product_name" name="name" placeholder="Product Name">
									</div>
								</div>
							</div>
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Qty</label>
									<div class="col-md-9">
										<input type="text" class="form-control product_qty" name="qty" placeholder="Qty">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="col-md-4">Form</label>
									<div class="col-md-8">
										<select name="form" class="form-control product_form input-sm">
											<option value="">--Select--</option>
											<?php
											if(get_forms())
											{
												foreach (get_forms() as $key => $value)
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
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Color</label>
									<div class="col-md-9">
										<select name="color" class="form-control product_color input-sm">
											<option value="">--Select--</option>
											<?php
											if(get_colors())
											{
												foreach (get_colors() as $key => $value)
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
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Row</label>
									<div class="col-md-9">
										<input type="text" class="form-control product_row" placeholder="Row" name="row">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="col-md-4">Type</label>
									<div class="col-md-8">
										<select name="type" class="form-control product_type input-sm">
											<option value="">--Select--</option>
											<?php
											if(get_prodcut_type())
											{
												foreach (get_prodcut_type() as $key => $value)
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
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Eq</label>
									<div class="col-md-9">
										<input type="text" class="form-control product_eq" placeholder="Eq" name="equivalent">
									</div>
								</div>
							</div>
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Units</label>
									<div class="col-md-9">
										<input type="text" class="form-control product_units" placeholder="Units" name="units">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="col-md-4">Packaging</label>
									<div class="col-md-8">
										<select name="package" class="form-control product_package input-sm">
											<option value="">--Select--</option>
											<?php
											if(get_packages())
											{
												foreach (get_packages() as $key => $value)
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
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Date</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Date">
									</div>
								</div>
							</div>
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Buyer</label>
									<div class="col-md-9">
										<input type="text" class="form-control" placeholder="Buyer">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="col-md-4">Wholesale</label>
									<div class="col-md-8">
										<input type="text" name="wholesale" class="form-control product_wholeprice" placeholder="Wholesale">
									</div>
								</div>					
							</div>
							<div class="col-md-4 padding-zero">
								<div class="form-group">
									<label class="control-label col-md-3">Retail</label>
									<div class="col-md-9">
										<input type="text" class="form-control product_retailprice" placeholder="Retail" name="retail">
									</div>
								</div>
							</div>
							<div class="col-md-4 padding-zero">
								<!-- <a href="#CostInventory" data-toggle="modal" class="btn btn-info" style="padding:3px;">Cost</a> -->
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 padding-zero invent-mb">
								<label class="col-md-2 invent">From</label>
								<div class="col-md-10">
									<input type="text" name="" class="form-control input-sm" placeholder="From">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 padding-zero invent-mb">
								<label class="col-md-2 invent">Reference</label>
								<div class="col-md-10">
									<input type="text" name="reference" class="form-control input-sm product_ref" placeholder="Reference">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 padding-zero">
								<label class="col-md-2 invent">Notes</label>
								<div class="col-md-10">
									<input type="text" name="notes" class="form-control input-sm product_notes" placeholder="Notes">
								</div>
							</div>
						</div>
						<div class="row">
							<button class="btn btn-info product-search-btn pull-right" type="button">Search</button>
							<button type="button" class="btn btn-info disabled product-update-btn pull-right" onclick="update_product();">Update</button>
						</div>
					</div>
				</div>
			</form>
			<div class="clearfix"></div>
			<div class="row ajax_table" style="max-height: 200px;overflow: auto;">
				<table class="table table-hover table-bordered">
					<thead>
						<th>Customer</th><th>Phone</th><th>Contact</th><th>City</th><th>State</th>
					</thead>
					<tbody>
						<?php
							if(get_all_vendors())
							{
								foreach (get_all_vendors() as $key => $value)
								{
									?>
										<tr class="customer_row" onclick="get_customer_details(<?=$value['id'];?>)">
											<td><?=$value['business_name'];?></td>
											<td><?=$value['phone'];?></td>
											<td><?=$value['contact_name'];?></td>
											<td><?=$value['city'];?></td>
											<td><?=$value['state'];?></td>
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

<!-- PO Popups -->
<div id="POProcess" class="modal fade" role="dialog">
</div>

<!-- SO Popups -->
<div id="SOProcess" class="modal fade" role="dialog">
</div>
<!-- PO Product Add -->
<div id="AddPOProduct" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <div class="col-md-8 pull-right">
          <button data-dismiss="modal" class="btn btn-danger pull-right">Close</button>
          <button class="btn btn-primary add_po_product_cart_btn pull-left">Add</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- SO Product Add -->
<div id="AddSOProduct" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <div class="col-md-8 pull-right">
          <button data-dismiss="modal" class="btn btn-danger pull-right">Close</button>
          <button class="btn btn-primary add_so_product_cart_btn pull-left">Add</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Customer Comments -->
<div id="CustomerComments" class="modal fade" role="dialog">
</div>
<!-- Call Log -->
<div id="LogCall" class="modal fade" role="dialog">
</div>
<!-- View Call -->
<div id="ViewLog" class="modal fade" role="dialog">
</div>
<!-- Cost Cart -->
<div id="CostInventory" class="modal fade" role="dialog">
</div>

<style type="text/css">
	.ajax_table table tbody tr:hover{background:#ccc;cursor: pointer;}
</style>