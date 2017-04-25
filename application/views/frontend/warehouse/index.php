<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
			<?php if($this->action->create==1){?>
				<a href="<?=site_url('warehouse/add_edit_warehouse');?>" class="btn btn-block warehouse pull-right access-level"><i class="fa fa-plus"></i>Create Warehouse</a>
			<?php }?>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<?=$grid;?>
