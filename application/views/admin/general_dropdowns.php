<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
		<?php echo set_breadcrumb(); ?>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata());?>
<?php
if(validation_errors())
  echo '<div id="output">'.validation_errors()."</div>";
?>
<br>
<div class="row">
  <form name="dropdowns" id="dropdowns" method="post" action="<?=site_url('admin/add_edit_dropdowns');?>">
    <input type="hidden" name="edit_id" value="">
    <div class="form-grid">
			<div class="form-group col-md-4 " data-error="">
        <label required="">Table Type</label>
        <select name="table_type" class="form-control">
          <option value="">--Select--</option>
          <option value="1">Packaging</option>
          <option value="2">Form</option>
          <option value="3">Product Type</option>
          <option value="4">Credit</option>
          <option value="5">Freight Carriers</option>
          <option value="6">Time Zones</option>
          <option value="7">States</option>
          <option value="8">Types of Contacts</option>
          <option value="9">Call Types</option>
          <option value="10">Types of Sales</option>
          <option value="11">Freight Paid</option>
          <option value="12">Payment Terms</option>
        </select>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-4 " data-error="">
      <select id="select2_sample2" name="table_value_list">
        <option value=""></option>
      </select>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-4 " data-error="">
        <input type="text" name="table_value" class="form-control">
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-6 " data-error="">
        <label required="" class="control-label col-md-12">Active</label>
        <label><input type="radio" name="status" value="1"> Yes</label>
        <label><input type="radio" name="status" value="0"> No</label>
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="">        
      <div class="form-group col-md-2">
        <button type="button" class="btn btn-block del-dropdown">Delete</button>
      </div>
      <div class="form-group col-md-2">
        <button type="button" class="btn btn-block add-new-dropdown">Add New</button>
      </div>
      <div class="form-group col-md-2">
        <button type="submit" class="btn btn-block">Save</button>
      </div>
    </div>
  </form>
</div>