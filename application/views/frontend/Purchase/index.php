<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('purchase/add_edit_purchase');?>" class="btn pull-right">Create Purchase Order</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>