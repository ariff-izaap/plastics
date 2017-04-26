<table class="table table-striped table-hover tableSite table-bordered">
 <tr>
    <td>SKU</td>
    <td>COST</td>
    <td>IN STOCK</td>
    <td>SHIPPING COST</td>
    <td>SHIPPING SERVICE</td>
    <td>ACTION</td>
 </tr>
   <?php 
       if(count($editdata['pricelts'])>0) { 
         foreach($editdata['pricelts'] as $ekey => $evalue) {
           // print_r($evalue);
     ?>
        <tr>
            <td><?php echo $evalue['sku']; ?></td>
            <td><?php echo $evalue['cost']; ?></td>
            <td><?php echo $evalue['in_stock']; ?></td>
            <td><?php echo $evalue['shipping_cost']; ?></td>
            <td><?php echo $evalue['shipping_service']; ?></td>
            <td><i class="fa fa-edit" onclick="get_form('inventory/vendor_add/<?php echo $evalue['product_id'];?>/<?php echo $evalue['id'];?>','addVendorForm','Edit Vendor',this,true);" ></i>
                <i class="fa fa-trash-o trash" onclick="product_image_delete('<?php echo $evalue['id']; ?>','vendor_price_list',<?php echo $evalue['product_id'];?>);"></i></td>
        </tr>
 <?php }} 
      else { ?>
   <tr>
    <td colspan="3"><?php echo "No Price lists Found!"; ?></td>
   </tr>
  <?php
  }
 ?>
</table>