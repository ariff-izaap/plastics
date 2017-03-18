<table class="table table-striped table-hover tableSite table-bordered">
 <tr>
    <td></td>
    <td>Product Number</td>
    <td>Product</td>
    <td>Form</td>
    <td>Color</td>
    <td>Type</td>
    <td>Equivalent</td>
    <td>Quantity</td>
    <td>Wholesale Price</td>
    <td>Package</td>
    <td>Row</td>
  </tr>
  
   <?php 
       if(count($cartitems)>0) { 
         foreach($cartitems as $cvalue) {
     ?>
        <tr>
            <td><input type="radio" name="sales_order_create" id="sales_order_create" /></td>
            <td><?php echo $cvalue['id']; ?></td>
            <td><?php echo $cvalue['name']; ?></td>
            <td><?php echo $cvalue['form']; ?></td>
            <td><?php echo $cvalue['color']; ?></td>
            <td><?php echo $cvalue['type']; ?></td>
            <td><?php echo $cvalue['equivalent']; ?></td>
            <td><?php echo $cvalue['qty']; ?></td>
            <td><?php echo $cvalue['price']; ?></td>
            <td><?php echo $cvalue['package']; ?></td>
            <td><?php echo $cvalue['row']; ?></td>
        </tr>
 <?php }} 
      else { ?>
   <tr>
    <td colspan="11"><?php echo "No Products Found!"; ?></td>
   </tr>
  <?php } ?>
</table>