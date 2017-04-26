<input type="hidden" id="form_access" name="form_access" />
<input  type="hidden" id="item_type" name="item_type" />
<?php  $uri = $this->uri->segment(1);
       $uri2 = $this->uri->segment(2);
      
      $so_id = ($uri == 'salesorder' && $uri2 == 'update_salesorder_quantity')?$this->uri->segment(4):'cartitem';
         
          ?>
          <!--
<div class="container">
<button type="button" name="update_cart" onclick="sales_update_cart('form','<?php //echo $so_id;?>',this)" class="btn btn-default ">Update</button>
</div>
-->
<table class="table table-striped table-hover tableSite table-bordered">
 <tr>
    <td>Product Number</td>
    <td>Product</td>
    <td>Form</td>
    <td>Color</td>
    <td>Type</td>
    <td>Package</td>
    <td>Row</td>
    <!--
<td>Equivalent</td>
-->
    <td>Quantity</td>
    <td>Wholesale Price</td>
     
    <td colspan="2">Action</td>
  </tr>
  
   <?php 
         $uri = ($uri != 'salesproductselection')?$this->uri->segment(2):$uri;
        $total = '';
       if(count($cartitems)>0) { 
         foreach($cartitems as $ckey => $cvalue) {   
            $total += $cvalue['qty'] * $cvalue['price'];
            
     ?>
        <tr>
         <?php if($itemtype=='cart'){?>
          <input type="hidden" value="<?php echo $ckey; ?>" name="cart_id[]" />
          <?php } ?>
           <!--
 <td><input type="radio" name="sales_order_create" id="sales_order_create" /></td>
-->
            <td><input type="hidden" name="sales_order_item_id[]" value="<?php echo $cvalue['sot_id']; ?>" /><?php echo $cvalue['id']; ?></td>
            <td><?php echo $cvalue['name']; ?></td>
            <td><?php echo $cvalue['form']; ?></td>
            <td><?php echo $cvalue['color']; ?></td>
            <td><?php echo $cvalue['type']; ?></td>
            <td><?php echo $cvalue['package']; ?></td>
            <td><?php echo $cvalue['row']; ?></td>
           <!--
 <td><?php //echo $cvalue['equivalent']; ?></td>
-->
            <td> <?php if($uri2=='view' || $uri2 == 'update_salesorder_quantity'){?> 
            <input type="text" name="update_qty[]" id="update_qty" value="<?php echo $cvalue['qty']; ?>" /><?php } else{ echo $cvalue['qty'];  } ?></td>
            <td><?php echo $cvalue['price']; ?></td>
            
            <td>
               <button type="button" name="delete_cart" onclick="delete_cartt('<?php echo $cvalue['rowid']; ?>');" class="btn btn-default"><i class="fa fa-trash-o trash"></i></button>
               
            </td>
        </tr>
 <?php }?>
 <tr class="green_solid_bg" >
                <td class="text-right" colspan="8"><b>Total Amount:</b></td>
                
                <td><b><?php echo (!empty($total))?": ".$total:""; ?></b>
                <td>&nbsp;</td>
            </td>
            </tr>
 <?php }
    else { ?>
   <tr>
    <td colspan="11"><?php echo "No Products Found!"; ?></td>
   </tr>
  <?php } ?>
  
</table>
<div class="row m_bot_30">
    <div class="col-md-5 pull-right">
        <table class="price_box pull-right  ash_gradiant_bg">
        <tbody>
            
           <!--
 <tr>
                <td class="text-right">Shipping:</td>
                <td>&nbsp;</td>
                <td class="green">$0.00</td>
            </tr>
            <tr>
                <td class="text-right">Tax:</td>
                <td>&nbsp;</td>
                <td class="green">$0.00</td>
            </tr>
            <tr>
                <td class="text-right">Discount:</td>
                <td>&nbsp;</td>
                <td class="green">$0.00</td>
            </tr>
-->        
            
        </tbody>
        </table>
    
    </div>
</div>

 
<div>
    
  <?php if($uri2=='view') {?>  
    <!--
<input type="button" name="cancel" onclick="modal_close();" data-dismiss="modal" class="btn btn-danger" id="cancel"  value="Cancel" />
-->
  <?php } ?>  
</div>