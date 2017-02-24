<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('purchase');?>" class="btn pull-right">Back</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<div class="row">
  <form name="add_role" id="addRole" method="post">
    <div class="form-grid">
			<div class="form-group col-md-4 " data-error="">
        <label required="">PO Number#</label>
        <input type="text" name="po_id" class="form-control" id="name" value="<?=$po_id['po_id'];?>" readonly>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
      	<?=$grid;?>
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">Vendor Name</label>
        <input type="text" name="vendor_name" class="form-control" id="name" value=""  placeholder="Vendor Name">
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">Bill To Name</label>
        <input type="text" name="bill_name" class="form-control" id="name" value=""  placeholder="Bill To Name">
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">Salesman</label>
        <select class="form-control" name="salesman"></select>
      </div>
     	<div class="form-group col-md-6 " data-error="">
        <label required="">Address 1</label>
        <input type="text" name="address_1" class="form-control" id="address_1" value=""  placeholder="Address 1">
      </div>
     	<div class="form-group col-md-6 " data-error="">
        <label required="">Address 2</label>
        <input type="text" name="address_2" class="form-control" id="address_2" value=""  placeholder="Addres 2">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">City</label>
        <input type="text" name="city" class="form-control" id="city" value=""  placeholder="City">
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">State</label>
        <select class="form-control" name="state">
        	<option value="">--Select State--</option>
        	<?php
        		if(get_state())
        		{
        			foreach (get_state() as $key => $value)
        			{
        				?>
        					<option value="<?=$value['state_code']?>"><?=$value['state_code']?></option>
        				<?php
        			}
        		}
       		?>

        </select>
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Zipcode</label>
        <input type="text" name="zipcode" class="form-control" id="zipcode" value=""  placeholder="Zipcode">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">First Name</label>
        <input type="text" name="firstname" class="form-control" id="firstname" value=""  placeholder="First Name">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Last Name</label>
        <input type="text" name="lastname" class="form-control" id="lastname" value=""  placeholder="Last Name">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Mobile</label>
        <input type="text" name="mobile" class="form-control" id="mobile" value=""  placeholder="(XXX) XXX-XXXXX">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Contact Email</label>
        <input type="text" name="email" class="form-control" id="email" value=""  placeholder="Email">
      </div>
     	<div class="form-group col-md-8 " data-error="">
        <label required="">Website</label>
        <input type="text" name="website" class="form-control" id="website" value=""  
        	placeholder="Website e.g. http://www.example.com">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Date for Pickup</label>
        <input type="text" name="pickup_date" class="form-control singledate" id="pickup_date" value=""  placeholder="Pickup Date">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Estimated Date for Delivery to Customer/Warehouse</label>
        <input type="text" name="delivery_date" class="form-control singledate" id="delivery_date" value=""  placeholder="Delviery Date">
      </div>
     	<div class="form-group col-md-4 " data-error="">
        <label required="">Release to be Sold</label>
        <input type="checkbox" name="to_sold" class="" id="to_sold">
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?=$editdata['id'];?>">        
      <div class="form-group col-md-2">
        <button type="submit" class="btn btn-block">Save</button>
      </div>    
    </div>
  </form>
</div>