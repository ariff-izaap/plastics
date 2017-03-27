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
        //print_r($cartitems);
         foreach($cartitems as $cvalue) {
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
            <td><?php echo $cvalue['qty']; ?></td>
            <td><?php echo $cvalue['price']; ?></td>
            <td><?php echo $cvalue['package']; ?></td>
            <td><?php echo $cvalue['row']; ?></td>
            <td colspan="2">
                <button type="button" name="update_cart" onclick="sales_update_cart('<?php echo $cvalue['rowid'];?>');" class="btn btn-default">Update Cart</button> |
                <button type="button" name="delete_cart" onclick="delete_cart('<?php echo $cvalue['rowid']; ?>');" class="btn btn-default">Delete Cart</button>
            </td>
        </tr>
 <?php }} 
      else { ?>
   <tr>
    <td colspan="11"><?php echo "No Products Found!"; ?></td>
   </tr>
  <?php } ?>
</table>


 <div id="updat_cart" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form name="sales_update_to_cart" id="sales_update_to_cart">
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
      <input type="hidden" name="cart_id" id="cart_id" value="" />
       <div class="row"> 
        <div class="form-group col-md-4">
            <label>Quantity</label>
            <input type="text" name="quantity" id="quantity"/>
        </div>
       </div>
     </div>  
     <div class="row">
        <div class="form-group col-md-4">
            <input type="button" name="cancel" onclick="modal_close();" data-dismiss="modal" class="btn btn-block" id="cancel" data-pid=""  value="Cancel" />
        </div>
        <div class="form-group col-md-4">  
            <input type="button" name="up_cart" onclick="sales_update_cart('');" data-dismiss="modal"  id="confirm" class="btn btn-block" value="Update" />
        </div>
     </div>
     </form>
      
    </div>
  </div>
</div>
