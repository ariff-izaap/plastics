<table class="table table-striped table-hover tableSite table-bordered">
 <tr>
    <td></td>
    <td>Product Number</td>
    <td>Product</td>
    <td>Form</td>
    <td>Color</td>
    <td>Type</td>
    <!--
<td>Equivalent</td>
-->
    <td>Quantity</td>
    <td>Wholesale Price</td>
    <td>Package</td>
    <td>Row</td> 
    <td colspan="2">Action</td>
  </tr>
  
   <?php 
       if(count($cartitems)>0) { 
         foreach($cartitems as $cvalue) {
            
     ?>
        <tr>
            <td><input type="radio" name="sales_order_create" id="sales_order_create" /></td>
            <td><input type="hidden" name="sales_order_item_id[]" value="<?php echo $cvalue['sot_id']; ?>" /><?php echo $cvalue['id']; ?></td>
            <td><?php echo $cvalue['name']; ?></td>
            <td><?php echo $cvalue['form']; ?></td>
            <td><?php echo $cvalue['color']; ?></td>
            <td><?php echo $cvalue['type']; ?></td>
           <!--
 <td><?php //echo $cvalue['equivalent']; ?></td>
-->
            <td><input type="text" name="update_qty[]" id="update_qty" value="<?php echo $cvalue['qty'];?>" /></td>
            <td><?php echo $cvalue['price']; ?></td>
            <td><?php echo $cvalue['package']; ?></td>
            <td><?php echo $cvalue['row']; ?></td>
            <td><button type="button" name="delete_cart" onclick="delete_cart('<?php echo $cvalue['rowid']; ?>');" class="btn btn-default">Delete</button>
            </td>
        </tr>
 <?php } ?>

 <?php 
    } 
      else { ?>
   <tr>
    <td colspan="11"><?php echo "No Products Found!"; ?></td>
   </tr>
  <?php } ?>
</table>
  <div class="form-group">
    <label>Total Amount<?php echo (!empty($total))?": ".$total:""; ?></label>
  </div>
 <div class="form-group col-md-8">
  <button type="button" name="update_cart" onclick="sales_update_cart('process',<?php echo $so_id;?>,this)" class="btn btn-default">Update</button>
  <input type="button" name="cancel" onclick="modal_close();" data-dismiss="modal" class="btn btn-default" id="cancel"  value="Cancel" />
 </div>
