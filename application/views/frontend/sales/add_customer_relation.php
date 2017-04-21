<div class="customer_add_div">
	<div class="row blue-mat">
	    <div class="breadcrumbs col-md-6">
	      <?php echo set_breadcrumb(); ?>
	      <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
	    </div>
	    <div class="col-md-6 action-buttons text-right">
	      <a href="<?php echo site_url('salesorder/customer_relation');?>" class="btn" capsOn>Back</a>
	  </div>
	</div>
	<?php display_flashmsg($this->session->flashdata()); ?>
    <div class="container">
	<div class="row">
		<div class="col-md-12">
	    <div class="panel with-nav-tabs panel-primary">
	      <div class="panel-heading">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="javascript:void(0);" data-href="#tab1primary" disabled>Billing Information</a></li>
	          <li><a href="javascript:void(0);" disabled data-href="#tab2primary">Contact Information</a></li>
	          <li><a href="javascript:void(0);" disabled data-href="#tab3primary">Delivery/Pickup Locations</a></li>
	        </ul>
	      </div>
	      <div class="panel-body">
		      <form name="CustomerRelation" id="CustomerRelation" method="post" novalidate="">
		      <input type="hidden" name="edit_id" class="edit_id" value="<?=$edit_data['id'];?>">
		      <input type="hidden" name="address_id" class="address_id" value="<?=$edit_data1['id'];?>">
		        <div class="tab-content">        	
	          	<div class="tab-pane fade in active" id="tab1primary">          		
		          	<div class="row">
		          		<div class="col-md-6">
		          			<div class="form-group <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? strip_tags(form_error('name')):'';?>">
		          				<label required="">Customer Name</label>
		          				<input type="text" class="form-control" name="name" value="<?=set_value('name',$edit_data['business_name']);?>">
		          			</div>
		          		</div>
		          		<div class="col-md-12">
		          			<h3>Billing Information</h3>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('bill_name'))?'error':'';?>" data-error="<?php echo (form_error('bill_name'))? strip_tags(form_error('bill_name')):'';?>">
		          					<label required="">Bill To Name</label>
		          					<input type="text" class="form-control" name="bill_name" value="<?=set_value('bill_name',$edit_data1['name']);?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('address_1'))?'error':'';?>" data-error="<?php echo (form_error('address_1'))? strip_tags(form_error('address_1')):'';?>">
		          					<label required="">Address 1</label>
		          					<input type="text" class="form-control" name="address_1" value="<?=set_value('address_1',$edit_data1['address1']);?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group">
		          					<label>Address 2</label>
		          					<input type="text" class="form-control" name="address_2" value="<?=set_value('address_2',$edit_data1['address2']);?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? strip_tags(form_error('city')):'';?>">
		          					<label required="">City</label>
		          					<input type="text" class="form-control" name="city" value="<?=set_value('city',$edit_data1['city']);?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? strip_tags(form_error('state')):'';?>">
		          					<label required="">State</label>
		          					<select name="state" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_state())
		          						{
		          							foreach (get_state() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('state',$value['name'],(($edit_data1['state']==$value['name'])?true:false));?> value="<?=$value['name'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('country'))?'error':'';?>" data-error="<?php echo (form_error('country'))? strip_tags(form_error('country')):'';?>">
		          					<label required="">Country</label>
		          					<select name="country" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_country())
		          						{
		          							foreach (get_country() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('country',$value['name'],(($edit_data1['country']==$value['name'])?true:false));?> value="<?=$value['name'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? strip_tags(form_error('zipcode')):'';?>">
		          					<label required="">Zipcode</label>
		          					<input type="text" class="form-control" name="zipcode" value="<?=set_value('zipcode',$edit_data1['zipcode']);?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group">
		          					<label>Website</label>
		          					<input type="text" class="form-control" name="website" value="<?=set_value('website',$edit_data['web_url']);?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))? strip_tags(form_error('credit_type')):'';?>">
		          					<label required="">Credit Type</label><?= $edit_data['credit_type'];?>
		          					<select name="credit_type" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_credit_type())
		          						{
		          							foreach (get_credit_type() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('credit_type',$value['id'],(($edit_data['credit_type']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group">
		          					<label>UPS</label>
		          					<input type="text" class="form-control" name="ups" value="<?=set_value('ups',$edit_data['ups']);?>">
		          				</div>
		          			</div>
		          		</div>
	  	        	</div>
	    	      	<div class="row">
	          		<div class="col-md-1 pull-right">
	          	 		<button type="submit" class="btn btnNext">Next</button>
	          	 	</div>
	      	    	</div>
	          	</div>
		          <div class="tab-pane fade" id="tab2primary">
		          	<div class="row">
		          		<div class="col-md-6">
		          			<div class="form-group <?php echo (form_error('contact_name'))?'error':'';?>" data-error="<?php echo (form_error('contact_name'))? strip_tags(form_error('contact_name')):'';?>">
		          				<label required="">Contact Name</label>
		          				<input type="text" class="form-control" name="contact_name" value="<?=set_value('contact_name',$edit_data2['name']);?>">
		          			</div>
		          			<div class="form-group">
		          				<label required="" class="col-md-12">Type of Number</label>
		          				<div class="col-md-4">
		          					<select class="form-control ">
		          						<option value="1">Mobile</option>
		          						<option value="3">Fax</option>
		          					</select>
		          				</div>
		          				<div class="col-md-6 <?php echo (form_error('contact_value'))?'error':'';?>" data-error="<?php echo (form_error('contact_value'))? strip_tags(form_error('contact_value')):'';?>">
		          					<label class="col-md-1"></label>
		          					<input type="text" class="form-control" name="contact_value" value="<?=set_value('contact_value',
		          					$edit_data2['contact_value']);?>">
		          				</div>
		          			</div>
		          			<div class="clearfix"></div><br>
		          			<div class="form-group <?php echo (form_error('contact_type'))?'error':'';?>" data-error="<?php echo (form_error('contact_type'))? strip_tags(form_error('contact_type')):'';?>">
		          				<label required="">Type of Contact</label>
		          				<select name="contact_type" class="form-control">
			          						<option value="">--Select--</option>
			          						<?php
			          						if(get_contact_type())
			          						{
			          							foreach (get_contact_type() as $key => $value)
			          							{
			          								?>
			          									<option <?=set_select('contact_type',$value['id'],(($edit_data2['contact_type']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
			          								<?php
			          							}
			          						}
			          						?>
			          					</select>
		          			</div>
		          			<div class="form-group <?php echo (form_error('contact_email'))?'error':'';?>" data-error="<?php echo (form_error('contact_email'))? strip_tags(form_error('contact_email')):'';?>">
		          				<label required="">Contact Email</label>
		          				<input type="text" class="form-control" name="contact_email" value="<?=set_value('contact_email',$edit_data2['email']);?>">
		          			</div>
		          		</div>
	  	        	</div>
		          	<div class="row">
		          		<div class="col-md-2 pull-right">
		        				<button type="submit" class="btn">Next</button>
		        				<button type="button" class="btn btnPrevious">Previous</button>
		          		</div>
		          	</div>
		          </div>
		          <div class="tab-pane fade" id="tab3primary">
		          	<div class="row">
		          		<div class="col-md-2 pull-right">
		          			<button type="button" class="btn" onclick="add_address();">Add Address</button>
		          		</div>
		          	</div><br>
		          	<?php
		          	if(!$edit_data3)
		          	{
		          		?>
			          	<div class="row">
			          		<div class="row remove_div"></div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_name[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_name[]'))? strip_tags(form_error('loc_name[]')):'';?>">
			          				<label required="">Location Name</label>
			          				<input type="text" class="form-control" name="loc_name[]" value="<?=set_value('loc_name[]',$edit_data3['name']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_address_1[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_address_1[]'))? strip_tags(form_error('loc_address_1[]')):'';?>">
			          				<label required="">Address 1</label>
			          				<input type="text" class="form-control" name="loc_address_1[]" value="<?=set_value('loc_address_1[]',$edit_data3['address_1']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group">
			          				<label>Address 2</label>
			          				<input type="text" class="form-control" name="loc_address_2[]" value="<?=set_value('loc_address_2[]',$edit_data3['address_2']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_city[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_city[]'))? strip_tags(form_error('loc_city[]')):'';?>">
			          				<label required="">City</label>
			          				<input type="text" class="form-control" name="loc_city[]" value="<?=set_value('loc_city[]',$edit_data3['city']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_state[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_state[]'))? strip_tags(form_error('loc_state[]')):'';?>">
			          				<label required="">State</label>
			          				<select name="loc_state[]" class="form-control">
			          						<option value="">--Select--</option>
			          						<?php
			          						if(get_state())
			          						{
			          							foreach (get_state() as $key => $value)
			          							{
			          								?>
			          									<option <?=set_select('loc_state[]',$value['name'],(($edit_data3['state']==$value['name'])?true:false));?> value="<?=$value['name'];?>"><?=$value['name'];?></option>
			          								<?php
			          							}
			          						}
			          						?>
			          					</select>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_country[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_country[]'))? strip_tags(form_error('loc_country[]')):'';?>">
			          				<label required="">Country</label>
			          				<select name="loc_country[]" class="form-control">
			          						<option value="">--Select--</option>
			          						<?php
			          						if(get_country())
			          						{
			          							foreach (get_country() as $key => $value)
			          							{
			          								?>
			          									<option <?=set_select('loc_country[]',$value['name'],(($edit_data3['country']==$value['name'])?true:false));?> value="<?=$value['name'];?>"><?=$value['name'];?></option>
			          								<?php
			          							}
			          						}
			          						?>
			          					</select>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_zipcode[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_zipcode[]'))? strip_tags(form_error('loc_zipcode[]')):'';?>">
			          				<label required="">Zipcode</label>
			          				<input type="text" class="form-control" name="loc_zipcode[]" value="<?=set_value('loc_zipcode[]',$edit_data3['zipcode']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('start_time[]'))?'error':'';?>" data-error="<?php echo (form_error('start_time[]'))? strip_tags(form_error('start_time[]')):'';?>">
			          				<label required="">Start Time</label>
			          				<input type="text" class="form-control singletime"  name="start_time[]" value="<?=set_value('start_time[]',date('H:i A',strtotime($edit_data3['start_time'])));?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('end_time[]'))?'error':'';?>" data-error="<?php echo (form_error('end_time[]'))? strip_tags(form_error('end_time[]')):'';?>">
			          				<label required="">End Time</label>
			          				<input type="text" class="form-control singletime" name="end_time[]" value="<?=set_value('end_time[]',date('H:i A',strtotime($edit_data3['end_time'])));?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('timezone[]'))?'error':'';?>" data-error="<?php echo (form_error('timezone[]'))? strip_tags(form_error('timezone[]')):'';?>">
			          				<label required="">TimeZone</label>
			          				<select name="timezone[]" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_timezone())
		          						{
		          							foreach (get_timezone() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('timezone[]',$value['id'],(($edit_data3['timezone_id']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('weeks[]'))?'error':'';?>" data-error="<?php echo (form_error('weeks[]'))? strip_tags(form_error('weeks[]')):'';?>">
			          				<label required="">Days of Week</label>
			          				<select name="weeks[]" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_weeks_operate())
		          						{
		          							foreach (get_weeks_operate() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('weeks[]',$value['id'],(($edit_data3['day_of_week']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
			          			</div>
			          		</div>
			          		<?php
			          			$check = explode(",",$edit_data3['definition']);
			          		?>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_type[0][]'))?'error':'';?>" data-error="<?php echo (form_error('loc_type[0][]'))? strip_tags(form_error('loc_type[0][]')):'';?>">
			          				<label required="" class="control-label col-md-12">Location Type</label>
			          				<label><input type="checkbox" name="loc_type[0][]" value="1" > Delivery</label>
			          				<label><input type="checkbox" name="loc_type[0][]" value="2" > Pickup</label>
			          			</div>
			          		</div>
			          	</div>
			          	<?php
			          }
			          else
			          {
			          	$i = 0;
			          	foreach ($edit_data3 as $key => $row)
			          	{
			          	?>	
			          		<input type="hidden" name="location_id[]" value="<?=$row['id'];?>">
			          		<div class="row edit_address">
			          		<div class="row remove_div">
			          			<div class="col-md-2 pull-right">
			          				<button type='button' class='btn' onclick='remove_address(this,<?=$row['id'];?>);'>Remove</button>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_name[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_name[]'))? strip_tags(form_error('loc_name[]')):'';?>">
			          				<label required="">Location Name</label>
			          				<input type="text" class="form-control" name="loc_name[]" value="<?=set_value('loc_name[]',$row['name']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_address_1[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_address_1[]'))? strip_tags(form_error('loc_address_1[]')):'';?>">
			          				<label required="">Address 1</label>
			          				<input type="text" class="form-control" name="loc_address_1[]" value="<?=set_value('loc_address_1[]',$row['address_1']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group">
			          				<label>Address 2</label>
			          				<input type="text" class="form-control" name="loc_address_2[]" value="<?=set_value('loc_address_2[]',$edit_data3['address_2']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_city[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_city[]'))? strip_tags(form_error('loc_city[]')):'';?>">
			          				<label required="">City</label>
			          				<input type="text" class="form-control" name="loc_city[]" value="<?=set_value('loc_city[]',$row['city']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_state[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_state[]'))? strip_tags(form_error('loc_state[]')):'';?>">
			          				<label required="">State</label>
			          				<select name="loc_state[]" class="form-control">
			          						<option value="">--Select--</option>
			          						<?php
			          						if(get_state())
			          						{
			          							foreach (get_state() as $key => $value)
			          							{
			          								?>
			          									<option <?=set_select('loc_state[]',$value['name'],(($row['state']==$value['name'])?true:false));?> value="<?=$value['name'];?>"><?=$value['name'];?></option>
			          								<?php
			          							}
			          						}
			          						?>
			          					</select>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_country[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_country[]'))? strip_tags(form_error('loc_country[]')):'';?>">
			          				<label required="">Country</label>
			          				<select name="loc_country[]" class="form-control">
			          						<option value="">--Select--</option>
			          						<?php
			          						if(get_country())
			          						{
			          							foreach (get_country() as $key => $value)
			          							{
			          								?>
			          									<option <?=set_select('loc_country[]',$value['name'],(($row['country']==$value['name'])?true:false));?> value="<?=$value['name'];?>"><?=$value['name'];?></option>
			          								<?php
			          							}
			          						}
			          						?>
			          					</select>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('loc_zipcode[]'))?'error':'';?>" data-error="<?php echo (form_error('loc_zipcode[]'))? strip_tags(form_error('loc_zipcode[]')):'';?>">
			          				<label required="">Zipcode</label>
			          				<input type="text" class="form-control" name="loc_zipcode[]" value="<?=set_value('loc_zipcode[]',$row['zipcode']);?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('start_time[]'))?'error':'';?>" data-error="<?php echo (form_error('start_time[]'))? strip_tags(form_error('start_time[]')):'';?>">
			          				<label required="">Start Time</label>
			          				<input type="text" class="form-control singletime"  name="start_time[]" value="<?=set_value('start_time[]',date('H:i A',strtotime($row['start_time'])));?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('end_time[]'))?'error':'';?>" data-error="<?php echo (form_error('end_time[]'))? strip_tags(form_error('end_time[]')):'';?>">
			          				<label required="">End Time</label>
			          				<input type="text" class="form-control singletime" name="end_time[]" value="<?=set_value('end_time[]',date('H:i A',strtotime($row['end_time'])));?>">
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('timezone[]'))?'error':'';?>" data-error="<?php echo (form_error('timezone[]'))? strip_tags(form_error('timezone[]')):'';?>">
			          				<label required="">TimeZone</label>
			          				<select name="timezone[]" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_timezone())
		          						{
		          							foreach (get_timezone() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('timezone[]',$value['id'],(($row['timezone_id']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
			          			</div>
			          		</div>
			          		<div class="col-md-3">
			          			<div class="form-group <?php echo (form_error('weeks[]'))?'error':'';?>" data-error="<?php echo (form_error('weeks[]'))? strip_tags(form_error('weeks[]')):'';?>">
			          				<label required="">Days of Week</label>
			          				<select name="weeks[]" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_weeks_operate())
		          						{
		          							foreach (get_weeks_operate() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('weeks[]',$value['id'],(($row['day_of_week']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
			          			</div>
			          		</div>
			          		<?php
			          			$check = explode(",",$row['definition']);
			          		?>
			          		<div class="col-md-3">
			          			<div class="form-group">
			          				<label required="" class="control-label col-md-12">Location Type</label>
			          				<label><input type="checkbox" name="loc_type[<?=$i;?>][]" value="1" <?=($check[0]=="1")?"checked":"";?> > Delivery</label>
			          				<label><input type="checkbox" name="loc_type[<?=$i;?>][]" value="2" <?=($check[1]=="2")?"checked":"";?> > Pickup</label>
			          			</div>
			          		</div>
			          	</div>
			          	<?php
			          	$i++;
			          	}
			          }
			          ?>

		          

		          	<div class="ajax_address">
		          	</div>
		          	<div class="row">
		          		<div class="col-md-2 pull-right">
		          			<button type="submit" class="btn" name="submit">Save</button>
		          			<button type="button" class="btn btnPrevious">Previous</button>
		          		</div>
		          	</div>
		          </div>	        
		        </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
    </div>
</div>

