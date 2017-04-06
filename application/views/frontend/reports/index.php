<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
		<?php echo set_breadcrumb(); ?>
			<!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<form action="<?=site_url('reports/report_print');?>" method="post">
	<div class="row">
	  <div class="col-md-4">
	    <div class="form-group">
	      <label class="col-md-3"> Start Date :</label>
	      <div class="col-md-6">
	        <input type="text" name="start_date" class="form-control singledate">
	      </div>
	    </div>
	  </div>
	  <div class="col-md-4">
	    <div class="form-group">
	      <label class="col-md-3"> End Date :</label>
	      <div class="col-md-6">
	        <input type="text" name="end_date" class="form-control singledate">
	      </div>
	    </div>
	  </div>
	</div>
	<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<th>Select</th><th>Report Name</th>
			</thead>
			<tbody>
				<tr>
					<td>
							<label for="selectAll-1" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-1" name="report[]" value="cleading">
					</td>
					<td>CLeading : Leading Customers by Volume</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-2" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-2" name="report[]" value="cogfind">
					</td>
					<td>COGFIND : Material Shipped By Customer</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-3" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-3" name="report[]" value="frnka">
					</td>
					<td>FRNKA : Sales to Individual Customers By Material</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-4" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-4" name="report[]" value="invsum">
					</td>
					<td>INVSUM : Sum of Shipping Orders Total Price By Ship Date By Salesman</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-5" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-5" name="report[]" value="mike1">
					</td>
					<td>MIKE1 : Gross Profit By Customer and Salesman Report</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-6" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-6" name="report[]" value="sales18d">
					</td>
					<td>SALES18D : Gross Profit Report</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-7" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-7" name="report[]" value="incott">
					</td>
					<td>INCOTT : Summary of the Cost on Inventory in the warehouses</td>
				</tr>
				<tr>
					<td>
							<label for="selectAll-8" class="custom-checkbox">&nbsp;</label>
							<input type="checkbox" class="checkbox" id="selectAll-8" name="report[]" value="invchk">
					</td>
					<td>INVCHK : Shipping Orders By Date</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-3 pull-right">
			<button class="btn" type="button">View</button>
			<button type="submit" class="btn">Print</button>
		</div>
	</div>
	</div>
</form>