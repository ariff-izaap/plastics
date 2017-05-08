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
			<div class="col-md-6">
				<h3 class="text-center">Customer</h3>
				<div class="row">
					<div class="form-group">
						<label class="col-md-1">Name</label>
						<div class="col-md-11">
							<input type="text" name="" class="form-control customer_name" placeholder="Name">
							<input type="hidden" name="" class="form-control customer_id">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Phone</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_phone" placeholder="Phone">
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Contact</label>
								<div class="col-md-9">
									<input type="text" name="" class="form-control customer_contact" placeholder="Contact Name">
								</div>
							</div>
						</div>
						<!--/span-->
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Address</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_address" placeholder="Address">
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">City</label>
								<div class="col-md-9">
									<input type="text" name="" class="form-control customer_city" placeholder="City">
								</div>
							</div>
						</div>
						<!--/span-->
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">State</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_state" placeholder="State">
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Zipcode</label>
								<div class="col-md-9">
									<input type="text" name="" class="form-control customer_zipcode" placeholder="Zipcode">
								</div>
							</div>
						</div>
						<!--/span-->
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Fax</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_fax" placeholder="Fax">
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">F/M</label>
								<div class="col-md-9">
									<select name="" class="form-control contact_type input-sm">
										<option value="0">F</option>
										<option value="1">M</option>
									</select>
								</div>
							</div>
						</div>
						<!--/span-->
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Lastcall</label>
								<div class="col-md-9">
									<input type="text" class="form-control customer_call" placeholder="Last Call">
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Callback</label>
								<div class="col-md-9">
									<input type="text" name="" class="form-control" placeholder="Call Back">
								</div>
							</div>
						</div>
						<!--/span-->
					</div><br>
					<div class="row">
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
						<div class="col-md-6 text-left">
							<div class="form-group">
								<label class="control-label col-md-3">Credit</label>
								<div class="col-md-9">
									<select class="input-sm form-control customer_credit">
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
					</div><br>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-2">Materials</label>
								<div class="col-md-10">
									<input type="text" class="form-control" placeholder="Materials">
								</div>
							</div>
						</div><br><br>
						<!--/span-->
						<div class="col-md-12 text-left">
							<div class="form-group">
								<label class="control-label col-md-2">Comments</label>
								<div class="col-md-10">
									<input type="text" name="" class="form-control customer_comments" placeholder="Comments">
								</div>
							</div>
						</div>
						<!--/span-->
					</div><br>
				</div>
				<div class="row">
					<button class="btn btn-info customer-search-btn">Search</button>
					<a href="#POProcess" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info po_history_btn">PO History</a>
					<a href="#SOProcess" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info so_history_btn">SO History</a>
					<a href="#CustomerComments" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info 
					customer_comments">Comments</a>
					<a href="#LogCall" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info log_call">Log Call</a>
					<a href="#ViewLog" data-backdrop="static" data-keyboard="false" data-toggle="modal" class="btn btn-info view_log">View Log</a>
				</div>
			</div>
			<div class="col-md-6" style="">
				<h3 class="text-center">Inventory</h3>
				<div class="row">
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="col-md-4">SKU</label>
							<div class="col-md-8">
								<input type="text" name="" class="form-control product_sku" placeholder="SKU">
							</div>
						</div>					
					</div>
					<div class="col-md-6 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-2">Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control product_name" placeholder="Product Name">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-1">Qty</label>
							<div class="col-md-9">
								<input type="text" class="form-control product_qty" placeholder="Qty">
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5 padding-zero">
						<div class="form-group">
							<label class="col-md-3">Form</label>
							<div class="col-md-9">
								<select name="" class="form-control product_form input-sm">
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
							<label class="control-label col-md-2">Color</label>
							<div class="col-md-10">
								<select name="" class="form-control product_color input-sm">
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
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-1">Row</label>
							<div class="col-md-9">
								<input type="text" class="form-control product_row" placeholder="Row">
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5 padding-zero">
						<div class="form-group">
							<label class="col-md-3">Type</label>
							<div class="col-md-9">
								<select name="" class="form-control product_type input-sm">
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
							<label class="control-label col-md-2">Eq</label>
							<div class="col-md-10">
								<input type="text" class="form-control product_eq" placeholder="Eq">
							</div>
						</div>
					</div>
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-1">Units</label>
							<div class="col-md-9">
								<input type="text" class="form-control product_units" placeholder="Units">
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-4 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Packaging</label>
							<div class="col-md-8">
								<select name="" class="form-control product_package input-sm">
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
					<div class="col-md-3 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-2">Date</label>
							<div class="col-md-9">
								<input type="text" class="form-control" placeholder="Date">
							</div>
						</div>
					</div>
					<div class="col-md-5 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-2">Buyer</label>
							<div class="col-md-10">
								<input type="text" class="form-control" placeholder="Buyer">
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5 padding-zero">
						<div class="form-group">
							<label class="col-md-4">Wholesale</label>
							<div class="col-md-8">
								<input type="text" name="" class="form-control product_wholeprice" placeholder="Wholesale">
							</div>
						</div>					
					</div>
					<div class="col-md-5 padding-zero">
						<div class="form-group">
							<label class="control-label col-md-3">Retail</label>
							<div class="col-md-9">
								<input type="text" class="form-control product_retailprice" placeholder="Retail">
							</div>
						</div>
					</div>
					<div class="col-md-2 padding-zero">
						<!-- <a href="#CostCart" data-toggle="modal" class="btn btn-info">Cost</a> -->
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12 padding-zero">
						<label class="col-md-2">From</label>
						<div class="col-md-10">
							<input type="text" name="" class="form-control input-sm" placeholder="From">
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12 padding-zero">
						<label class="col-md-2">Reference</label>
						<div class="col-md-10">
							<input type="text" name="" class="form-control input-sm product_ref" placeholder="Reference">
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12 padding-zero">
						<label class="col-md-2">Notes</label>
						<div class="col-md-10">
							<input type="text" name="" class="form-control input-sm product_notes" placeholder="Notes">
						</div>
					</div>
				</div><br>
				<div class="row">
					<button class="btn btn-info product-search-btn pull-right">Search</button>
				</div>
			</div>
		</div>
		<div class="clearfix"></div><br>
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
									<tr class="customer_row" data-id="<?=$value['id'];?>">
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

<style type="text/css">
	.ajax_table table tbody tr:hover{background:#ccc;cursor: pointer;}
</style>