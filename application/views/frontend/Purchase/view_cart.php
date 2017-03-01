<?php
if($products)
{
  foreach ($products as $key => $value)
  {
    ?>
      <tr>
        <td><?=$value['p_name'];?></td>
        <td><?=$value['sku'];?></td>
        <td>
          <input type="number" value="<?=$value['qty'];?>" name="qty[<?=$value['rowid'];?>]" 
            class="form-control" max="10" min="1">
        </td>
        <td><?=displayData($value['unit_price'],'money');?></td>
        <td><?=displayData($value['unit_price'] * $value['qty'] ,'money');?></td>
        <td>
           <a href="javascript:void(0);" onclick="remove_cart(<?=$value['rowid'];?>,this)" class="btn">
            <i class="fa fa-remove"></i>
          </a>
        </td>
      </tr>
    <?php
  }
}
?>