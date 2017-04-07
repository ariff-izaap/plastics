<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:900px;margin-top:0; font-family: Arial,Helvetica Neue,Helvetica,sans-serif; margin-right:auto; margin-bottom:0; margin-left:auto">
  <tr>
    <td colspan="2" ><p style=" text-align: right;
    font-size: 31px; margin-right: 25px; font-family: sans-serif;">Order #<?php echo $so_id;?></p>
    <br />
    <p>Status : <?php echo $order_status;?></p>
    </td>
  </tr>
  <tr>
    <td style="padding:10px; border:1px solid #000"><h2>Billing Information</h2>
   <p> <?php echo $billing['first_name']." ".$billing['last_name'];?> <br />
    <?php echo $billing['company'];?> <br />
    <?php echo $billing['address1'];?>  <br />
    <?php echo $billing['address2'];?>  <br />
     <?php echo $billing['city'];?> <br />
     P: <?php echo $billing['phone'];?></p> 
    
    
    </td>
    
    <td style="padding:10px;  border:1px solid #000"><h2>Shipping Information</h2>
    <p><?php echo $shipping['name'];?> <br />
     <?php echo $shipping['address_1']." ".$shipping['address_2'];?> <br />
     <?php echo $shipping['city']." ".$shipping['state'];?> <br />
      <?php echo $shipping['country'];?> </p>
      P:  <?php echo $shipping['phone'];?></p>
    
    
    </td>
  </tr>
  <tr>
    <td colspan="2" ><table width="100%" border="1" cellspacing="0" cellpadding="5" style="margin-top:20px;" >
      <tr>
        <td style="text-align:center"><strong>Product</strong></td>
        <td style="text-align:center"><strong>Color</strong></td>
        <td style="text-align:center"><strong>QTY</strong></td>
        <td style="text-align:center"><strong>Unit Price</strong></td>
      </tr>
      <?php $tot = ''; 
            if(count($od_items)>0){ 
            foreach($od_items as $okey=> $ovalue){ $tot += $ovalue['price']; ?>
      <tr>
        <td style="text-align:center"><?php echo $ovalue['name']; ?></td>
        <td style="text-align:center"><?php echo $ovalue['color']; ?></td>
        <td style="text-align:center"><?php echo $ovalue['qty']; ?></td>
        <td style="text-align:center"><?php echo $ovalue['price']; ?></td>
      </tr>
      <?php }} ?>
      <tr>
        <td colspan="2" style="text-align:center"></td>
        <td style="text-align:left">Shipping: </td>
        <td style="text-align:center">$0.00</td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:center"></td>
        <td style="text-align:left">Tax: </td>
        <td style="text-align:center">$0.00</td>
      </tr>
      <!--
<tr>
        <td colspan="5" style="text-align:center"></td>
        <td style="text-align:left">Discount: </td>
        <td style="text-align:center">$54,540.00</td>
      </tr>
-->
      <tr>
        <td colspan="2" style="text-align:center"></td>
        <td style="text-align:left"><strong>Total:</strong></td>
        <td style="text-align:center"><?php echo $tot; ?></td>
      </tr>
    </table></td>
  </tr>
</table>