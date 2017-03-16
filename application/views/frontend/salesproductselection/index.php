     
  <div class="row blue-mat">
      <div class="breadcrumbs col-md-6">
        <?php echo set_breadcrumb(); ?>
        <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
      </div>
      <div class="col-md-6 action-buttons text-right">
       
    </div>
  </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
    
    <div id="popOverBox" style="display: block;"></div>
    
  <?php echo $grid;?>
  
  <div id="product_ship" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
       <input type="hidden" name="product_ids" id="product_ids" />
        <div class="form-group">
         <label>Type of Sale</label>
         <select name="type_of_sale"> 
              <?php if(count($salestype)>0){ foreach($salestype as $stkey=>$stvalue){ ?>
                <option value="<?php echo $stvalue['id']; ?>"><?php echo ucfirst($stvalue['name']); ?></option>
              <?php }} ?>  
         </select>
        </div>
        <div class="form-group">
         
         Warehouse<input type="radio" name="product_from" value="warehouse" /> 
         Vendor <input type="radio" name="product_from" value="vendor" /> 
         <input type="text" name="document_name" placeholder="Document Name" />
         <div class="form-group">
		    <input id="product_upload_image" name="product_upload_image" type="file" class="file" />
		    <input type="hidden" name="file_name" id="file_name" value="<?php //echo set_value('file_name', $editdata['file_name']);?>" />
            <?php //echo form_error('file_name', '<span class="help-block">', '</span>'); ?>
        </div>
        </div>
       <div class="row"> 
        <div class="form-group col-md-4">
            <label>Quantity Available</label>
            <input type="text" name="quantity_available" id="quantity_available"/>
        </div>
        <div class="form-group col-md-4">
            <label>Quantity to Order</label>
            <input type="text" name="quantity_to_order" id="quantity_to_order"/>
        </div>
        <div class="form-group col-md-4">
            <label>Price</label>
            <input type="text" name="price" id="price"/>
        </div>
       </div>
     </div>  
     <div class="row">
        <div class="form-group col-md-4">
            
            <input type="button" name="cancel" data-dismiss="modal" class="btn btn-block" id="cancel" value="Cancel" />
        </div>
        <div class="form-group col-md-4">
            
            <input type="button" name="confirm" id="confirm" class="btn btn-block" value="Confirm"/>
        </div>
     </div>
      <!--
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
-->
    </div>

  </div>
</div>  
</div>  
