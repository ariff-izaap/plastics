<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
		<?php echo set_breadcrumb(); ?>
		<a href="<?=site_url('admin/roles');?>" class="btn  active pull-right">Back</a>
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
<div class="container add-user1">
<div class="row">
  <form name="add_role" id="addRole" method="post">
  <div class="form-grid col-md-12 panel panel-default panel-bor">
      <div class="panel-heading formcontrol-box">
   
			<div class="form-group col-md-4 " data-error="">
        <label required="" class="col-md-3">Role Name</label>
        <input type="text" name="name" class="form-control col-md-9" id="name" value="<?=$editdata['name'];?>" placeholder="Role Name">
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?=$editdata['id'];?>">        
        
    </div>
    </div>
     <div class="form-group col-md-2 save">
        <button type="submit" class="btn btn-success"><i class="fa fa fa-life-saver"></i>Save</button>
      </div> 
  </form>
</div>
</div>