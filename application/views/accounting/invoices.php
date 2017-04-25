<div class="row blue-mat">
	<div class="col-md-12 padding-zero">
    <div class="col-md-12 breadcrumbs">
      <?php echo set_breadcrumb(); ?>
    </div>
  </div>
</div>

<?php display_flashmsg($this->session->flashdata());?>

<?=$grid;?>

  <div id="ViewInvoice" class="modal fade">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-ajax">
        	
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm active" data-dismiss="modal">Close</button>
        <button class="btn btn-success change_invoice_status">Save Changes</button>
      </div>
    </div>
  </div>
</div>