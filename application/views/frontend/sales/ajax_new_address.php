<div class="row new_address">
	<div class="row remove_div">
		<div class="col-md-2 pull-right">
			<button type="button" onclick="remove_address(this);" class="btn">Remove</button>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">Location Name</label>
			<input type="text" class="form-control" name="loc_name[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">Address 1</label>
			<input type="text" class="form-control" name="loc_address_1[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Address 2</label>
			<input type="text" class="form-control" name="loc_address_2[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">City</label>
			<input type="text" class="form-control" name="loc_city[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">State</label>
			<select name="loc_state[]" class="form-control">
					<option value="">--Select--</option>
					<?php
					if(get_state())
					{
						foreach (get_state() as $key => $value)
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
	<div class="col-md-3">
		<div class="form-group">
			<label required="">Country</label>
			<select name="loc_country[]" class="form-control">
					<option value="">--Select--</option>
					<?php
					if(get_country())
					{
						foreach (get_country() as $key => $value)
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
	<div class="col-md-3">
		<div class="form-group">
			<label required="">Zipcode</label>
			<input type="text" class="form-control" name="loc_zipcode[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">Start Time</label>
			<input type="text" class="form-control singletime"  name="start_time[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">End Time</label>
			<input type="text" class="form-control singletime" name="end_time[]">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label required="">TimeZone</label>
			<select name="timezone[]" class="form-control">
				<option value="">--Select--</option>
				<?php
				if(get_timezone())
				{
					foreach (get_timezone() as $key => $value)
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
	<div class="col-md-3">
		<div class="form-group">
			<label required="">Days of Week</label>
			<select name="weeks[]" class="form-control">
				<option value="">--Select--</option>
				<?php
				if(get_weeks_operate())
				{
					foreach (get_weeks_operate() as $key => $value)
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
	<div class="col-md-3">
		<div class="form-group">
			<label required="" class="control-label col-md-12">Location Type</label>
			<label><input type="checkbox" name="loc_type[<?=$row;?>][]" value="1"> Delivery</label>
			<label><input type="checkbox" name="loc_type[<?=$row;?>][]" value="2"> Pickup</label>
		</div>
	</div>

</div>