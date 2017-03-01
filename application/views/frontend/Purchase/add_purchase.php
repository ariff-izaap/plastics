<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('purchase');?>" class="btn pull-right">Back</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata());?>
<div class="purchase-loader">
  <img src="<?=base_url();?>assets/img/rolling.gif">
</div>
<div class="row">
  <form name="add_purchase" id="addPurchase" method="post">
    <div class="form-grid">
			<div class="form-group col-md-4">
        <label required="">PO Number#</label>
        <input type="text" name="po_id" class="form-control" id="name" value="<?=$po_id['po_id'];?>" readonly>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
      	<table class="table table-bordered table-hover">
      		<thead>
      			<th>#</th><th>Name</th><th>Contact Name</th><th>Phone</th><th>State</th><th>City</th><th>Salesman</th>
      		</thead>
      		<tbody>
      			<?php
      			if($vendor)
      			{
      				foreach ($vendor as $key => $value)
      				{
      					?>
      						<tr>
      							<td>
      								<label for="selectAll-<?=$value['id'];?>"  class="custom-radio">&nbsp;</label>
      								<input onclick="get_vendor_details('purchase/get_vendor_details/'+this.value)" type="radio" class="radio" name="vendor_id" value="<?=$value['id'];?>" id="selectAll-<?=$value['id'];?>"
                      <?php if(isset($_POST['vendor_id'])){?> checked <?php }?> >
      							</td>
      							<td><?=$value['business_name'];?></td>
      							<td><?=$value['contact_name'];?></td>
      							<td><?=$value['contact_value'];?></td>
      							<td><?=$value['state'];?></td>
      							<td><?=$value['city'];?></td>
      							<td><?=$value['business_name'];?></td>
      						</tr>
      					<?php
      				}
      			}
      			?>
      		</tbody>
      	</table>
        <?php
          if(form_error('vendor_id'))
          {
            ?>
              <div id='output'><?php echo (form_error('vendor_id'))? strip_tags(form_error('vendor_id')):'';?></div>
              <?php 
          }
          if($_POST['vendor_id'])
          {
            $data = get_vendor_by_id($_POST['vendor_id']);
          }
          else
          {
            $data = array("vendor_name"=>"");
          }
          ?>
      </div>
      <div class="form-group col-md-4 <?php echo (form_error('vendor_name'))?'error':'';?>" data-error="<?php echo (form_error('vendor_name'))? strip_tags(form_error('vendor_name')):'';?>">
        <label required="">Vendor Name</label>
        <input type="text" name="vendor_name" class="form-control" id="vendor_name" value="<?=$data[0]['business_name']?>"  placeholder="Vendor Name">
      </div>
      <div class="form-group col-md-4 <?php echo (form_error('bill_name'))?'error':'';?>" data-error="<?php echo (form_error('bill_name'))? strip_tags(form_error('bill_name')):'';?>">
        <label required="">Bill To Name</label>
        <input type="text" name="bill_name" class="form-control" id="bill_name" value=""  placeholder="Bill To Name">
      </div>
      <div class="form-group col-md-4">
        <label>Salesman</label>
        <select class="form-control" name="salesman"></select>
      </div>
     	<div class="form-group col-md-6 <?php echo (form_error('address_1'))?'error':'';?>" data-error="<?php echo (form_error('address_1'))? strip_tags(form_error('address_1')):'';?>">
        <label required="">Address 1</label>
        <input type="text" name="address_1" class="form-control" id="address_1" value="<?=$data[0]['address1']?>"  placeholder="Address 1">
      </div>
     	<div class="form-group col-md-6">
        <label>Address 2</label>
        <input type="text" name="address_2" class="form-control" id="address_2" value="<?=$data[0]['address2']?>"  placeholder="Address 2">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? strip_tags(form_error('city')):'';?>">
        <label required="">City</label>
        <input type="text" name="city" class="form-control" id="city" value="<?=$data[0]['city']?>"  placeholder="City">
      </div>
      <div class="form-group col-md-4 <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? strip_tags(form_error('state')):'';?>">
        <label required="">State</label>
        <select class="form-control" name="state" id="state">
        	<option value="">--Select State--</option>
        	<?php
        		if(get_state())
        		{
        			foreach (get_state() as $key => $value)
        			{
        				?>
        					<option <?php if($data[0]['state']==$value['state_code']){?> selected <?php }?>
                    value="<?=$value['state_code']?>"><?=$value['state_code']?></option>
        				<?php
        			}
        		}
       		?>

        </select>
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? strip_tags(form_error('zipcode')):'';?>">
        <label required="">Zipcode</label>
        <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?=$data[0]['zipcode']?>"  placeholder="Zipcode">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('firstname'))?'error':'';?>" data-error="<?php echo (form_error('firstname'))? strip_tags(form_error('firstname')):'';?>">
        <label required="">First Name</label>
        <input type="text" name="firstname" class="form-control" id="firstname" value="<?=$data[0]['first_name']?>"  placeholder="First Name">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('lastname'))?'error':'';?>" data-error="<?php echo (form_error('lastname'))? strip_tags(form_error('lastname')):'';?>">
        <label required="">Last Name</label>
        <input type="text" name="lastname" class="form-control" id="lastname" value="<?=$data[0]['last_name']?>"  placeholder="Last Name">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('mobile'))?'error':'';?>" data-error="<?php echo (form_error('mobile'))? strip_tags(form_error('mobile')):'';?>">
        <label required="">Mobile</label>
        <input type="text" name="mobile" class="form-control" id="mobile" value="<?=$data[0]['phone']?>"  placeholder="(XXX) XXX-XXXXX">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? strip_tags(form_error('email')):'';?>">
        <label required="">Contact Email</label>
        <input type="text" name="email" class="form-control" id="email" value="<?=$data[0]['email']?>"  placeholder="Email">
      </div>
     	<div class="form-group col-md-8">
        <label>Website</label>
        <input type="text" name="website" class="form-control" id="website" value="<?=$data[0]['web_url'];?>"  
        	placeholder="Website e.g. http://www.example.com">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('pickup_date'))?'error':'';?>" data-error="<?php echo (form_error('pickup_date'))? strip_tags(form_error('pickup_date')):'';?>">
        <label required="">Date for Pickup</label>
        <input type="text" name="pickup_date" class="form-control singledate" id="pickup_date" value=""  placeholder="Pickup Date">
      </div>
     	<div class="form-group col-md-4 <?php echo (form_error('delivery_date'))?'error':'';?>" data-error="<?php echo (form_error('delivery_date'))? strip_tags(form_error('delivery_date')):'';?>">
        <label required="">Estimated Date for Delivery to Customer/Warehouse</label>
        <input type="text" name="delivery_date" class="form-control singledate" id="delivery_date" value=""  placeholder="Delviery Date">
      </div>
     	<div class="form-group col-md-4">
        <label>Release to be Sold</label>
        <input type="checkbox" name="to_sold" class="" id="to_sold" value="Yes">
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?=$editdata['id'];?>">        
      <div class="form-group col-md-2">
        <button type="submit" class="btn btn-block">Save</button>
      </div>    
    </div>
  </form>
</div>