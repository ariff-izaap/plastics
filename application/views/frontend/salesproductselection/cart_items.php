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
            $qty_update = (!empty($stype) && ($stype=='update'))?'<input type="text" name="update_qty" id="update_qty" value="'.$cvalue['qty'].'" />':$cvalue['qty'];
     ?>
        <tr>
            <td><input type="radio" name="sales_order_create" id="sales_order_create" /></td>
            <td><?php echo $cvalue['id']; ?></td>
            <td><?php echo $cvalue['name']; ?></td>
            <td><?php echo $cvalue['form']; ?></td>
            <td><?php echo $cvalue['color']; ?></td>
            <td><?php echo $cvalue['type']; ?></td>
           <!--
 <td><?php //echo $cvalue['equivalent']; ?></td>
-->
            <td><?php echo $qty_update; ?></td>
            <td><?php echo $cvalue['price']; ?></td>
            <td><?php echo $cvalue['package']; ?></td>
            <td><?php echo $cvalue['row']; ?></td>
            <td colspan="2">
                 <?php if(!empty($stype) && ($stype == 'update')){ ?>
                   <button type="button" name="update_cart" onclick="sales_order_update_quantity(<?php echo $cvalue['sot_id']; ?>,<?php echo $cvalue['id']; ?>);" class="btn btn-default">Update</button>
                 <?php }
                  else { ?>
                   <button type="button" name="update_cart" onclick="sales_update_cart('<?php echo $cvalue['rowid'];?>');" class="btn btn-default">Update Cart</button> |
                   <button type="button" name="delete_cart" onclick="delete_cart('<?php echo $cvalue['rowid']; ?>');" class="btn btn-default">Delete Cart</button>
             <?php } ?>   
            </td>
        </tr>
 <?php }} 
      else { ?>
   <tr>
    <td colspan="11"><?php echo "No Products Found!"; ?></td>
   </tr>
  <?php } ?>
</table>
<div class="form-group">
    <label>Total Amount<?php echo (!empty($total))?": ".$total:""; ?></label>
  </div>

 
