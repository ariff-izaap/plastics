
<div class="row-fluid">
	<table class="table table-bordered">
		<tbody class="white_bg">
			<tr>
				<td>

					<div class="span6">
						<dl class="dl-horizontal text-left">

							<dt>First Name:*</dt>
							<dd>
								<input class="input-medium" name="first_name" id="first_name" value="<?php echo set_value('first_name', $price_list_info['first_name'])?>" type="text">
								<?php echo form_error('first_name', '<span class="error_text">', '</span>');?>
							</dd>
							
							<dt>Last Name:*</dt>
							<dd>
								<input class="input-medium" name="last_name" id="last_name" value="<?php echo set_value('last_name', $price_list_info['last_name'])?>" type="text">
								<?php echo form_error('last_name', '<span class="error_text">', '</span>');?>
							</dd>
							
							<dt>Address1 :*</dt>
							<dd>
								<input class="input-medium" name="address1" id="address1" value="<?php echo set_value('address1', $price_list_info['address1'])?>" type="text">
								<?php echo form_error('address1', '<span class="error_text">', '</span>');?>
							</dd>
							
							<dt>Address2</dt>
							<dd>
								<input class="input-medium" name="address2" id="address2" value="<?php echo set_value('address2', $price_list_info['address2'])?>" type="text">
								<?php echo form_error('address2', '<span class="error_text">', '</span>');?>
							</dd>
							<dt>Company</dt>
							<dd>
								<input class="input-medium" name="company" id="company" value="<?php echo set_value('company', $price_list_info['company'])?>" type="text">
								<?php echo form_error('company', '<span class="error_text">', '</span>');?>
							</dd>
							
							<dt>City:*</dt>
							<dd>
								<input class="input-medium" name="city" id="city" value="<?php echo set_value('city', $price_list_info['city'])?>" type="text">
								<?php echo form_error('city', '<span class="error_text">', '</span>');?>
							</dd>
							
							<dt>Country:</dt>
							<dd>
								<?php echo form_dropdown('country', get_countries(), set_value('country', ($price_list_info['country']!='')?$price_list_info['country']:'US'), 'id="shipping_country" class="boot_select_false"');?>
								<?php echo form_error('auto_order', '<span class="error_text">', '</span>');?>
							</dd>

							<dt>State:*</dt>
							<dd>
								<input class="input-medium" name="state" id="state" value="<?php echo set_value('state', $price_list_info['state'])?>" type="text">
								<?php echo form_error('state', '<span class="error_text">', '</span>');?>
							</dd>						
							
							
							<dt>Zipcode:</dt>
							<dd>
								<input class="input-medium" name="zip" id="zip" value="<?php echo set_value('zip', $price_list_info['zip'])?>" type="text">
								<?php echo form_error('zip', '<span class="error_text">', '</span>');?>
							</dd>
							<dt>Phone:</dt>
							<dd>
								<input class="input-medium" name="phone" id="zip" value="<?php echo set_value('phone', $price_list_info['phone'])?>" type="text">
								<?php echo form_error('phone', '<span class="error_text">', '</span>');?>
							</dd>
							

						</dl>
					</div>
					
						<input type="hidden" name="ship_addr_id" id="ship_addr_id" value="<?php echo set_value('ship_addr_id', $price_list_info['ship_addr_id'])?>" />
						
					</div>

				</td>
			</tr>
		</tbody>
	</table>
</div>
