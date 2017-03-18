<?php
	$menu = json_decode($access[0]['menu_id']);
	$rights = json_decode($access[0]['access_level']);
?>
 <div class="form-group <?php echo (form_error('menu[]'))?'error':'';?>" data-error="<?php echo (form_error('menu[]'))? strip_tags(form_error('menu[]')):'';?>">
  	<label required="" class="col-md-2">Menu</label>
  	<div class="col-md-12">
  		<div class="col-md-3">
  			<input type="checkbox" id='selectAll-1' value="1" <?=($menu->dashboard=="1") ? 'checked':'';?>
  				name="menu[dashboard]">Dashboard
  		</div>
  		<div class="col-md-2">
  			<input type="checkbox" id='selectAll-2' value="1" <?=($menu->sales=="1") ? 'checked':'';?>
  				name="menu[sales]">Sales
  		</div>
  		<div class="col-md-3">
  			<input type="checkbox" id='selectAll-3' value="1" <?=($menu->purchase=="1") ? 'checked':'';?>
  				name="menu[purchase]">Purchase
  		</div>
  		<div class="col-md-3"> 			
  			<input type="checkbox" id='selectAll-4' value="1" <?=($menu->inventory=="1") ? 'checked':'';?>
  				name="menu[inventory]">Inventory
  		</div>
  		<div class="col-md-3">
  			<input type="checkbox" id='selectAll-5' value="1" <?=($menu->accounting=="1") ? 'checked':'';?>
  				name="menu[accounting]">Accounting
  		</div>
  		<div class="col-md-2">
  			<input type="checkbox" id='selectAll-6' value="1" <?=($menu->admin=="1") ? 'checked':'';?>
  				name="menu[admin]">Admin
  		</div>
  		<div class="col-md-2">
  			<input type="checkbox" id='selectAll-7' value="1" <?=($menu->reports=="1") ? 'checked':'';?>
  				name="menu[reports]">Reports
  		</div>
  		<!-- <div class="col-md-2">
  			<label for="selectAll-8" class="custom-checkbox">&nbsp;</label>
  			<input type="checkbox" id='selectAll-8' name="menu[]" class="checkbox">Home
  		</div> -->
  	</div>
  </div>
  <div class="clearfix"></div>
  <br>
<div class="form-group <?php echo (form_error('rights[]'))?'error':'';?>" data-error="<?php echo (form_error('rights[]'))
	? strip_tags(form_error('rights[]')):'';?>">
	<label required="" class="col-md-2">Rights</label>
	<div class="col-md-12">
		<div class="col-md-2">
			<input type="checkbox" id='selectAll-101' value="1" <?=($rights->create=="1") ? 'checked':'';?> name="rights[create]">Create
		</div>
		<div class="col-md-2">
			<input type="checkbox" id='selectAll-102' value="1" <?=($rights->edit=="1") ? 'checked':'';?> name="rights[edit]">Edit
		</div>
		<div class="col-md-2">
			<input type="checkbox" id='selectAll-103' value="1" <?=($rights->delete=="1") ? 'checked':'';?> name="rights[delete]">Delete
		</div>
		<div class="col-md-2">
			<input type="checkbox" id='selectAll-104' value="1" <?=($rights->view=="1") ? 'checked':'';?> name="rights[view]">View
		</div>
	</div>
</div>
<style type="text/css">
</style>