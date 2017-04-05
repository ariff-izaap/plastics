
<div class="row-fluid">
	<table class="table table-bordered">
		<tbody class="white_bg">
			<tr>
				<td>
					<div class="col-md-6">
						<dl class="dl-horizontal text-left">
                           <div class="form-group" >
							<label>Name:*</label>
						
								<input class="form-control" name="name" id="name" value="<?php echo set_value('name', $price_list_info['name'])?>" type="text">
								<?php echo form_error('name', '<span class="error_text">', '</span>');?>
							</div>
							<div class="form-group" >
							<label>Address1 :*</label>
							
								<input class="form-control" name="address1" id="address1" value="<?php echo set_value('address1', $price_list_info['address_1'])?>" type="text">
								<?php echo form_error('address1', '<span class="error_text">', '</span>');?>
							</div>
							
                            <div class="form-group" >
							<label>Address2</label>
							   <input class="form-control" name="address2" id="address2" value="<?php echo set_value('address2', $price_list_info['address_2'])?>" type="text">
								<?php echo form_error('address2', '<span class="error_text">', '</span>');?>
							</div>
                            
						   <div class="form-group" >
							<label>City:*</label>
							
								<input class="form-control" name="city" id="city" value="<?php echo set_value('city', $price_list_info['city'])?>" type="text">
								<?php echo form_error('city', '<span class="error_text">', '</span>');?>
							</div>
							
                            <div class="form-group" >
							<label>Country:</label>
						        <select class="form-control" name="country" id="country" >
                                   <?php $country = get_country();
                                     foreach($country as $clr): ?>
                                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                                  <?php endforeach;?>
                              </select>
								<?php //echo form_dropdown('country', get_country(), set_value('country', ($price_list_info['country']!='')?$price_list_info['country']:'US'), 'id="shipping_country" class="boot_select_false"');?>
								<?php echo form_error('auto_order', '<span class="error_text">', '</span>');?>
							</div>
                            
                            <div class="form-group" >
							<label>State</label>
                              <select class="form-control" name="state" id="state" >
                                   <?php $state = get_state();
                                     foreach($state as $clr): ?>
                                    <option value="<?php echo $clr['id'];?>" > <?php echo $clr['name'];?> </option>
                                  <?php endforeach;?>
                              </select>						
							</div>
							<div class="form-group" >
							<label>Zipcode:</label>
							
								<input class="form-control" name="zip" id="zip" value="<?php echo set_value('zip', $price_list_info['zip'])?>" type="text">
								<?php echo form_error('zip', '<span class="error_text">', '</span>');?>
						  </div>
                          <div class="form-group" >
							<label>Phone:</label>
						
								<input class="form-control" name="phone" id="phone" value="<?php echo set_value('phone', $price_list_info['phone'])?>" type="text">
								<?php echo form_error('phone', '<span class="error_text">', '</span>');?>
						</div>
							

						</div>
					</div>
					
						<input type="hidden" name="ship_addr_id" id="ship_addr_id" value="<?php echo set_value('ship_addr_id', $price_list_info['ship_addr_id'])?>" />
						
					</div>

				</td>
			</tr>
		</tbody>
	</table>
</div>
