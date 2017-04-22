<?php
if($products)
{
  foreach ($products as $key => $value)
  {
    ?>
      <tr>
        <td><?=$value['name'];?></td>
        <td><?=$value['sku'];?></td>
        <td>
          <input type="hidden" name="rowid[]" value="<?=$value['rowid'];?>">
          <input type="number" value="<?=$value['qty'];?>" name="qty[<?=$value['rowid'];?>]" 
            class="form-control" max="10" min="1">
        </td>
        <td><?=displayData($value['price'],'money');?></td>
        <td><?=displayData($value['price'] * $value['qty'] ,'money');?></td>
        <td class="text-center">
           <a href="javascript:void(0);" onclick="remove_cart('<?=$value['rowid'];?>',this)" class="btn btn-danger">
            <i class="fa fa-trash"></i>
          </a>
        </td>
      </tr>
    <?php
  }
}
?>