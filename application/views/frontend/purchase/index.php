<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
			<?php if($this->action->create==1){?>
				<a href="<?=site_url('purchase/add_edit_purchase');?>" class="btn pull-right">Create Purchase Order</a>
			<?php }?>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<div class="col-md-12">
	<div id="popOverBox" style="display: block;"></div>
</div>

<div class="col-md-12">
<?=$grid;?>
</div>


<div id="ViewPurchaseOrder" class="modal fade">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    	<div class="modal-ajax">
	      
      </div>
     	<div class="modal-footer">
     		<button class="btn" data-dismiss="modal">Close</button>
    	</div>
    </div>
	</div>
</div>