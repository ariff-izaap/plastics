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
	<div class="row">
		<div class="col-md-12">
	    <div class="panel with-nav-tabs panel-primary">
	      <div class="panel-heading">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab1primary" data-toggle="tab">Billing Information</a></li>
	          <li><a href="#tab2primary" data-toggle="tab">Contact Information</a></li>
	          <li><a href="#tab3primary" data-toggle="tab">Delivery/Pickup Locations</a></li>
	        </ul>
	      </div>
	      <div class="panel-body">
		      <form name="CutomerRelation" id="CutomerRelation" method="post">
		        <div class="tab-content">        	
	          	<div class="tab-pane fade in active" id="tab1primary">          		
		          	<div class="row">
		          		<div class="col-md-6">
		          			<div class="form-group <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? strip_tags(form_error('name')):'';?>">
		          				<label required="">Customer Name</label>
		          				<input type="text" class="form-control" name="name" value="<?=set_value('name');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-12">
		          			<h3>Billing Information</h3>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('bill_name'))?'error':'';?>" data-error="<?php echo (form_error('bill_name'))? strip_tags(form_error('bill_name')):'';?>">
		          					<label required="">Bill To Name</label>
		          					<input type="text" class="form-control" name="bill_name" value="<?=set_value('bill_name');?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('address_1'))?'error':'';?>" data-error="<?php echo (form_error('address_1'))? strip_tags(form_error('address_1')):'';?>">
		          					<label required="">Address 1</label>
		          					<input type="text" class="form-control" name="address_1" value="<?=set_value('address_1');?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group">
		          					<label>Address 2</label>
		          					<input type="text" class="form-control" name="address_2" value="<?=set_value('address_2');?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? strip_tags(form_error('city')):'';?>">
		          					<label required="">City</label>
		          					<input type="text" class="form-control" name="city" value="<?=set_value('city');?>">
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
		          									<option <?=set_select('state',$value['id']);?>
		          										 value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
		          									<option <?=set_select('country',$value['id']);?>
		          									 value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
		          					<input type="text" class="form-control" name="zipcode" value="<?=set_value('zipcode');?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group">
		          					<label>Website</label>
		          					<input type="text" class="form-control" name="website" value="<?=set_value('website');?>">
		          				</div>
		          			</div>
		          			<div class="col-md-3">
		          				<div class="form-group <?php echo (form_error('credit_type'))?'error':'';?>" data-error="<?php echo (form_error('credit_type'))? strip_tags(form_error('credit_type')):'';?>">
		          					<label required="">Credit Type</label>
		          					<select name="credit_type" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_credit_type())
		          						{
		          							foreach (get_credit_type() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('credit_type',$value['id']);?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
		          					<input type="text" class="form-control" name="ups" value="<?=set_value('ups');?>">
		          				</div>
		          			</div>
		          		</div>
	  	        	</div>
	    	      	<div class="row">
	          		<div class="col-md-1 pull-right">
	          	 		<button type="button" class="btn" onclick="return customer_relation();">Next</button>
	          	 	</div>
	      	    	</div>
	          	</div>
		          <div class="tab-pane fade" id="tab2primary">
		          	<div class="row">
		          		<div class="col-md-6">
		          			<div class="form-group <?php echo (form_error('contact_name'))?'error':'';?>" data-error="<?php echo (form_error('contact_name'))? strip_tags(form_error('contact_name')):'';?>">
		          				<label required="">Contact Name</label>
		          				<input type="text" class="form-control" name="contact_name" value="<?=set_value('contact_name');?>">
		          			</div>
		          			<div class="form-group">
		          				<label required="" class="col-md-12">Type of Number</label>
		          				<div class="col-md-4">
		          					<select class="form-control">
		          						<option value="1">Mobile</option>
		          						<option value="3">Fax</option>
		          					</select>
		          				</div>
		          				<div class="col-md-6  padding-zero <?php echo (form_error('contact_value'))?'error':'';?>" data-error="<?php echo (form_error('contact_value'))? strip_tags(form_error('contact_value')):'';?>">
		          					<label class="col-md-1"></label>
		          					<input type="text" class="form-control" name="contact_value" value="<?=set_value('contact_value');?>">
		          				</div>
		          			</div>
		          			<div class="clearfix"></div><br>
		          			<div class="form-group <?php echo (form_error('contact_type'))?'error':'';?>" data-error="<?php echo (form_error('contact_type'))? strip_tags(form_error('contact_type')):'';?>">
		          				<label required="">Type of Contact</label>
		          				<input type="text" class="form-control" name="contact_type" value="<?=set_value('contact_type');?>">
		          			</div>
		          			<div class="form-group <?php echo (form_error('contact_email'))?'error':'';?>" data-error="<?php echo (form_error('contact_email'))? strip_tags(form_error('contact_email')):'';?>">
		          				<label required="">Contact Email</label>
		          				<input type="text" class="form-control" name="contact_email" value="<?=set_value('contact_email');?>">
		          			</div>
		          		</div>
	  	        	</div>
		          	<div class="row">
		          		<div class="col-md-2 pull-right">
		        				<button type="button" class="btn" onclick="return customer_relation();">Next</button>
		        				<button class="btn btnPrevious">Previous</button>
		          		</div>
		          	</div>
		          </div>
		          <div class="tab-pane fade" id="tab3primary">
		          	<div class="row">
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_name'))?'error':'';?>" data-error="<?php echo (form_error('loc_name'))? strip_tags(form_error('loc_name')):'';?>">
		          				<label required="">Location Name</label>
		          				<input type="text" class="form-control" name="loc_name" value="<?=set_value('loc_name');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_address_1'))?'error':'';?>" data-error="<?php echo (form_error('loc_address_1'))? strip_tags(form_error('loc_address_1')):'';?>">
		          				<label required="">Address 1</label>
		          				<input type="text" class="form-control" name="loc_address_1" value="<?=set_value('loc_address_1');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group">
		          				<label>Address 2</label>
		          				<input type="text" class="form-control" name="loc_address_2" value="<?=set_value('loc_address_2');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_city'))?'error':'';?>" data-error="<?php echo (form_error('loc_city'))? strip_tags(form_error('loc_city')):'';?>">
		          				<label required="">City</label>
		          				<input type="text" class="form-control" name="loc_city" value="<?=set_value('loc_city');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_state'))?'error':'';?>" data-error="<?php echo (form_error('loc_state'))? strip_tags(form_error('loc_state')):'';?>">
		          				<label required="">State</label>
		          				<select name="loc_state" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_state())
		          						{
		          							foreach (get_state() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('loc_state',$value['id']);?>
		          										 value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_country'))?'error':'';?>" data-error="<?php echo (form_error('loc_country'))? strip_tags(form_error('loc_country')):'';?>">
		          				<label required="">Country</label>
		          				<select name="loc_country" class="form-control">
		          						<option value="">--Select--</option>
		          						<?php
		          						if(get_country())
		          						{
		          							foreach (get_country() as $key => $value)
		          							{
		          								?>
		          									<option <?=set_select('loc_country',$value['id']);?>
		          										 value="<?=$value['id'];?>"><?=$value['name'];?></option>
		          								<?php
		          							}
		          						}
		          						?>
		          					</select>
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_zipcode'))?'error':'';?>" data-error="<?php echo (form_error('loc_zipcode'))? strip_tags(form_error('loc_zipcode')):'';?>">
		          				<label required="">Zipcode</label>
		          				<input type="text" class="form-control" name="loc_zipcode" value="<?=set_value('loc_zipcode');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('start_time'))?'error':'';?>" data-error="<?php echo (form_error('start_time'))? strip_tags(form_error('start_time')):'';?>">
		          				<label required="">Start Time</label>
		          				<input type="text" class="form-control singletime"  name="start_time" value="<?=set_value('start_time');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('end_time'))?'error':'';?>" data-error="<?php echo (form_error('end_time'))? strip_tags(form_error('end_time')):'';?>">
		          				<label required="">End Time</label>
		          				<input type="text" class="form-control singletime" name="end_time" value="<?=set_value('end_time');?>">
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('timezone'))?'error':'';?>" data-error="<?php echo (form_error('timezone'))? strip_tags(form_error('timezone')):'';?>">
		          				<label required="">TimeZone</label>
		          				<select name="timezone" class="form-control">
	          						<option value="">--Select--</option>
	          						<?php
	          						if(get_timezone())
	          						{
	          							foreach (get_timezone() as $key => $value)
	          							{
	          								?>
	          									<option <?=set_select('timezone',$value['id']);?>
	          										 value="<?=$value['id'];?>"><?=$value['name'];?></option>
	          								<?php
	          							}
	          						}
	          						?>
	          					</select>
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('weeks'))?'error':'';?>" data-error="<?php echo (form_error('weeks'))? strip_tags(form_error('weeks')):'';?>">
		          				<label required="">Days of Week</label>
		          				<select name="weeks" class="form-control">
	          						<option value="">--Select--</option>
	          						<?php
	          						if(get_weeks_operate())
	          						{
	          							foreach (get_weeks_operate() as $key => $value)
	          							{
	          								?>
	          									<option <?=set_select('weeks',$value['id']);?>
	          										 value="<?=$value['id'];?>"><?=$value['name'];?></option>
	          								<?php
	          							}
	          						}
	          						?>
	          					</select>
		          			</div>
		          		</div>
		          		<div class="col-md-3">
		          			<div class="form-group <?php echo (form_error('loc_type'))?'error':'';?>" data-error="<?php echo (form_error('loc_type'))? strip_tags(form_error('loc_type')):'';?>">
		          				<label required="" class="control-label col-md-12">Location Type</label>
		          				<label><input type="checkbox" name="loc_type[]" value="1" <?=set_checkbox('loc_type[]','1');?>> Delivery</label>
		          				<label><input type="checkbox" name="loc_type[]" value="2" <?=set_checkbox('loc_type[]','2');?>> Pickup</label>
		          			</div>
		          		</div>

		          	</div>
		          	<div class="row">
		          		<div class="col-md-2 pull-right">
		          			<button type="button" class="btn" name="submit" onclick="return customer_relation();">Save</button>
		          			<button class="btn btnPrevious">Previous</button>
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