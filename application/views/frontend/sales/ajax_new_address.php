<div class="row">
	<div class="row">
		<div class="col-md-2 pull-right">
			<button type="button" onclick="remove_address(this);" class="btn">Remove</button>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo (form_error('loc_name'))?'error':'';?>" data-error="<?php echo (form_error('loc_name'))? strip_tags(form_error('loc_name')):'';?>">
			<label required="">Location Name</label>
			<input type="text" class="form-control" name="loc_name" value="<?=set_value('loc_name',$edit_data3['name']);?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo (form_error('loc_address_1'))?'error':'';?>" data-error="<?php echo (form_error('loc_address_1'))? strip_tags(form_error('loc_address_1')):'';?>">
			<label required="">Address 1</label>
			<input type="text" class="form-control" name="loc_address_1" value="<?=set_value('loc_address_1',$edit_data3['address_1']);?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Address 2</label>
			<input type="text" class="form-control" name="loc_address_2" value="<?=set_value('loc_address_2',$edit_data3['address_2']);?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo (form_error('loc_city'))?'error':'';?>" data-error="<?php echo (form_error('loc_city'))? strip_tags(form_error('loc_city')):'';?>">
			<label required="">City</label>
			<input type="text" class="form-control" name="loc_city" value="<?=set_value('loc_city',$edit_data3['city']);?>">
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
								<option <?=set_select('loc_state',$value['id'],(($edit_data3['state']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
								<option <?=set_select('loc_country',$value['id'],(($edit_data3['country']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
			<input type="text" class="form-control" name="loc_zipcode" value="<?=set_value('loc_zipcode',$edit_data3['zipcode']);?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo (form_error('start_time'))?'error':'';?>" data-error="<?php echo (form_error('start_time'))? strip_tags(form_error('start_time')):'';?>">
			<label required="">Start Time</label>
			<input type="text" class="form-control singletime"  name="start_time" value="<?=set_value('start_time',date('H:i A',strtotime($edit_data3['start_time'])));?>">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group <?php echo (form_error('end_time'))?'error':'';?>" data-error="<?php echo (form_error('end_time'))? strip_tags(form_error('end_time')):'';?>">
			<label required="">End Time</label>
			<input type="text" class="form-control singletime" name="end_time" value="<?=set_value('end_time',date('H:i A',strtotime($edit_data3['end_time'])));?>">
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
							<option <?=set_select('timezone',$value['id'],(($edit_data3['timezone_id']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
							<option <?=set_select('weeks',$value['id'],(($edit_data3['day_of_week']==$value['id'])?true:false));?> value="<?=$value['id'];?>"><?=$value['name'];?></option>
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
		<div class="form-group <?php echo (form_error('loc_type'))?'error':'';?>" data-error="<?php echo (form_error('loc_type'))? strip_tags(form_error('loc_type')):'';?>">
			<label required="" class="control-label col-md-12">Location Type</label>
			<label><input type="checkbox" name="loc_type[]" value="1" <?=set_checkbox('loc_type[]','1',(($check[0]=='1')?true:false));?>> Delivery</label>
			<label><input type="checkbox" name="loc_type[]" value="2" <?=set_checkbox('loc_type[]','2',(($check[1]=='2')?true:false));?>> Pickup</label>
		</div>
	</div>

</div>