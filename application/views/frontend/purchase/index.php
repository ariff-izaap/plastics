<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
			<?php if($this->action->create==1){?>
				<a href="<?=site_url('purchase/add_edit_purchase');?>" class="btn btn-info pull-right">Create Purchase Order</a>
			<?php }?>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<div class="container">
	<div class="col-md-12">
		<div id="popOverBox" style="display: block;"></div>
	</div>

	<div class="col-md-12">
	<?=$grid;?>
	</div>
</div>

<div id="ViewPurchaseOrder" class="modal fade">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    	<div class="modal-ajax">
	      
      </div>
     	<div class="modal-footer">
     	<button class="btn btn-primary purchase_modal_save">Save Changes</button>
     		<button class="btn btn-danger" data-dismiss="modal">Close</button>
    	</div>
    </div>
	</div>
</div>


<div id="ProductModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-ajax">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><strong>Add Product </strong></h4>
        </div>
        <div class="modal-body product-modal-ajax">
          
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn done-product-modal"  data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>