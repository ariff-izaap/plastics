<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
		<?php echo set_breadcrumb(); ?>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata());?>
<div class="container category">
<div class="row">

  <form name="dropdowns" id="dropdowns" method="post" action="<?=site_url('admin/add_edit_dropdowns');?>">
  <div class="form-grid col-md-12 panel panel-default panel-bor">
   <div class="panel-heading formcontrol-box">
    <input type="hidden" name="edit_id" value="">
    <div class="form-grid">
			<div class="form-group padding-zero col-md-4 <?php echo (form_error('table_type'))?'error':'';?>" data-error="<?php echo (form_error('table_type'))? strip_tags(form_error('table_type')):'';?>">
        <label required="">Table Type</label>
        <select name="table_type" class="form-control">
          <option value="">--Select--</option>
          <option value="1">Packaging</option>
          <option value="13">Color</option>
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
      <div class="form-group col-md-4 padding-zero " data-error="">
      <select class="select2_sample2" name="table_value_list">
        <option value=""></option>
      </select>
      </div>
      <div class="clearfix"></div>
      <div class="form-group padding-zero col-md-4 <?php echo (form_error('table_value'))?'error':'';?>" data-error="<?php echo (form_error('table_value'))? strip_tags(form_error('table_value')):'';?>">
        <label>Value</label>
        <input type="text" name="table_value" class="form-control">
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-6 <?php echo (form_error('status'))?'error':'';?>" data-error="<?php echo (form_error('status'))? strip_tags(form_error('status')):'';?>">
        <label required="" class="control-label col-md-12">Active</label>
        <label><input type="radio" name="status" value="1" /> Yes</label>
        <label><input type="radio" name="status" value="0" /> No</label>
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="">        
     
    </div>
    </div> 
 <div class="form-group col-md-4 save">
        <button type="button" class="btn btn-danger del-dropdown"><i class="fa fa-trash-o trash"></i>Delete</button>
      </div>
      <div class="form-group col-md-4 save">
        <button type="button" class="btn btn-info add-new-dropdown"><i class="fa fa-plus"></i>Add New</button>
      </div>
      <div class="form-group col-md-4 save">
        <button type="submit" class="btn btn-success"><i class="fa fa fa-life-saver"></i>Save</button>
      </div>
</div>
  </form>
  
  </div>
  </div>
