<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
		<?php echo set_breadcrumb(); ?>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>

<div class="container add-user1 access-level">
	<div class="row">
    <div class="form-grid col-md-12 panel panel-default panel-bor">
    <div class="panel-heading formcontrol-box">
		<form action="" id="AccessLevel" name="AccessLevel" method="post">
			<div class="form-grid">
				<div class="form-group <?php echo (form_error('role_id'))?'error':'';?>" data-error="<?php echo (form_error('role_id'))? strip_tags(form_error('role_id')):'';?>">
	        <label required="" class="">Select Role</label>
	        <select class="form-control role_id" name="role_id">
	        	<option value="">--Select--</option>
	        	<?php
	        	if(get_roles())
	        	{
	        		foreach(get_roles() as $key => $value)
	        		{
	        			?>
	        				<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
	        			<?php
	        		}
	        	}
	        	?>
	        </select>
	      </div>
	      <div class="ajax_module">
		      <div class="form-group <?php echo (form_error('menu[]'))?'error':'';?>" data-error="<?php echo (form_error('menu[]'))? strip_tags(form_error('menu[]')):'';?>" style="display:table;">
					  	<label required="" class="col-md-2">Menu</label>
					  	<div class="col-md-12">
					  		<div class="col-md-3">
					  			<input type="checkbox" id='selectAll-1' value="1" name="menu[dashboard]">Dashboard
					  		</div>
					  		<div class="col-md-2">
					  			<input type="checkbox" id='selectAll-2' value="1" name="menu[sales]">Sales
					  		</div>
					  		<div class="col-md-3">
					  			<input type="checkbox" id='selectAll-3' value="1" name="menu[purchase]">Purchase
					  		</div>
					  		<div class="col-md-3"> 			
					  			<input type="checkbox" id='selectAll-4' value="1" name="menu[inventory]">Inventory
					  		</div>
					  		<div class="col-md-3">
					  			<input type="checkbox" id='selectAll-5' value="1"  name="menu[accounting]">Accounting
					  		</div>
					  		<div class="col-md-2">
					  			<input type="checkbox" id='selectAll-6' value="1" name="menu[admin]">Admin
					  		</div>
					  		<div class="col-md-2">
					  			<input type="checkbox" id='selectAll-7' value="1" name="menu[reports]">Reports
					  		</div>
					  		<!-- <div class="col-md-2">
					  			<label for="selectAll-8" class="custom-checkbox">&nbsp;</label>
					  			<input type="checkbox" id='selectAll-8' name="menu[]" class="checkbox">Home
					  		</div> -->
					  	</div>
					  </div>
					  <div class="clearfix"></div>
					  <br>
					<div class="form-group padding-zero col-md-12 <?php echo (form_error('rights[]'))?'error':'';?>" data-error="<?php echo (form_error('rights[]')) ? strip_tags(form_error('rights[]')):'';?>" style="display:table;">
						<label required="" class="col-md-2">Rights</label>
						<div class="col-md-12">
							<div class="col-md-2">
								<input type="checkbox" id='selectAll-101' value="1" name="rights[create]">Create
							</div>
							<div class="col-md-2">
								<input type="checkbox" id='selectAll-102' value="1" name="rights[edit]">Edit
							</div>
							<div class="col-md-2">
								<input type="checkbox" id='selectAll-103' value="1" name="rights[delete]">Delete
							</div>
							<div class="col-md-2">
								<input type="checkbox" id='selectAll-104' value="1" name="rights[view]">View
							</div>
						</div>
					</div>
		    </div>
	      <div class="clearfix"></div><br>
	      <div class="form-group">
	      	<button class="btn btn-success" type="submit">Save</button>
	      </div>
	    </div>
	  </form>
      </div>
      </div>
	</div>
</div>