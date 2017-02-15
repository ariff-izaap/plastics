<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
		<?php echo set_breadcrumb(); ?>
		<a href="<?=site_url('admin');?>" class="btn  active pull-right">Back</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<?php
	if(validation_errors())
	{
		?>
		<div id="output">
			<?php echo validation_errors(); ?>
		</div>
		<?php
	}
?>
	<br>
<div class="row">
  <form name="add_user" id="addUser" method="post">
    <div class="form-grid">
			<div class="form-group col-md-4 " data-error="">
        <label required="">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="<?=$editdata['username'];?>" placeholder="Username">
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">User ID</label>
        <input type="text" name="user_code" class="form-control" id="user_id" readonly="" value="<?=$editdata['user_code'];?>" 
        	placeholder="User ID">
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">First Name</label>
        <input type="text" name="firstname" class="form-control" id="firstname" value="<?=$editdata['first_name'];?>" placeholder="First Name">
      </div>
      <div class="form-group col-md-4 " data-error="">
        <label required="">Last Name</label>
        <input type="text" name="lastname" class="form-control" id="lastname" value="<?=$editdata['last_name'];?>" placeholder="Last Name">
      </div>        
      <div class="form-group col-md-4 " data-error="">
        <label required="">Email Address</label>
        <input type="text" name="email" class="form-control" id="email" value="<?=$editdata['email'];?>" placeholder="Email Address">
      </div> 
      <div class="form-group col-md-4">
        <label required="" class="control-label col-md-12">Active</label>
        <label><input type="radio" <?=$editdata['status']=="1" ? "checked" : "";?> name="is_active" value="1" class=""> Yes</label>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" class="" <?=$editdata['status']=="0" ? "checked" : "";?> name="is_active" value="0"> No</label>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-4">
      	<label required="">Rights</label>
      	<select class="form-control" name="role">
      		<?php
      			if($roles)
      			{
      				foreach ($roles as $value)
      				{
      					?>
      						<option <?=$editdata['role_id']==$value['id'] ? "selected" : "";?> value="<?=$value['id']?>">
      							<?=$value['name']?>
      						</option>
      					<?php
      				}
      			}
      		?>
      	</select>
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="">        
      <div class="form-group col-md-2">
        <button type="submit" class="btn btn-block">Save</button>
      </div>    
    </div>
  </form>
</div>