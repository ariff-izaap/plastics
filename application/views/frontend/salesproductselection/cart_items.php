
<input type="hidden" id="form_access" name="form_access" />
<input  type="hidden" id="item_type" name="item_type" />
<?php  $uri  = $this->uri->segment(1);
       $uri2 = $this->uri->segment(2);
      $so_id = ($uri == 'salesorder' && $uri2 == 'update_salesorder_quantity')?$this->uri->segment(4):'cartitem';
         
          ?>
         

<?php if($request!='updated'){?>

<button type="button" name="update_cart" onclick="sales_update_cart('process','<?php echo $so_id;?>','cart','#sales_update_to_cart',this)" class="btn btn-warning sales-warn">Update</button>

<?php } ?>

<table class="table table-striped table-hover tableSite table-bordered">
 <tr>
 <?php if($uri2 != 'checkout'){ ?>
    <td>#</td>
 <?php } ?>   
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
    <td>Unit Price</td>
    <td>Total</td>
    <td>Action</td>
  </tr>
  
   <?php 
         $uri   = ($uri != 'salesproductselection')?$this->uri->segment(2):$uri;
         $total = ''; $tot = '';
        
       if(count($cartitems)>0) { 
         foreach($cartitems as $ckey => $cvalue) { 
           
            $tot    = $cvalue['qty']*$cvalue['price'];
            $total += $cvalue['qty']*$cvalue['price'];
            
            
     ?>
        <tr>
         <?php //if($itemtype=='cart'){?>
          <input type="hidden" value="<?php echo $ckey; ?>" name="cart_id[]" />
          <?php //} ?>
         <?php if($uri2 != 'checkout'){ ?>
            <td><input type="checkbox" name="sales_order_create" class="cart_checkbox" value="<?php echo $ckey; ?>" /></td>
         <?php } ?>   
            <td><input type="hidden"  name="sales_order_item_id[]" value="<?php echo $cvalue['sot_id']; ?>" /><?php echo $cvalue['id']; ?></td>
            <td><?php echo $cvalue['name']; ?></td>
            <td><?php echo $cvalue['form']; ?></td>
            <td><?php echo $cvalue['color']; ?></td>
            <td><?php echo $cvalue['type']; ?></td>
            <td><?php echo $cvalue['package']; ?></td>
            <td><?php echo $cvalue['row']; ?></td>
           <!--<td><?php //echo $cvalue['equivalent']; ?></td>-->
            <td> <?php if($request!='updated'){ ?> 
            <input type="text" name="update_qty[]" id="update_qty" onkeypress="return numbersonly(event);" value="<?php echo $cvalue['qty']; ?>" /><?php } else{ echo $cvalue['qty'];  } ?></td>
            <td><?php echo displayData($cvalue['price'],'money'); ?></td>
            <td><?php echo displayData($cvalue['qty']*$cvalue['price'],'money'); ?></td>
            
            <td>
               <button type="button" name="delete_cart" onclick="delete_cartt('<?php echo $cvalue['rowid']; ?>','single');" class="btn btn-danger">
                <i class="fa fa-trash"></i>
               </button>
            </td>
        </tr>
 <?php }?>
 <tr class="green_solid_bg" >
                <td class="text-right" colspan="10"><b>Total Amount:</b></td>
                
                <td><b><?php echo (!empty($total))?": ".displayData($total,'money'):""; ?></b>
                
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
