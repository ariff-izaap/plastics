<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('warehouse/add_edit_warehouse');?>" class="btn pull-right">Create Warehouse</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<?=$grid;?>
