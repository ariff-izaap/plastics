<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
      <div class="col-md-6 breadcrumbs-span">
        <?php echo set_breadcrumb(); ?>
      </div>
    <a href="<?=site_url('purchase/add_edit_purchase/'.$form_product['po_id'].'');?>" class="btn pull-right">Back</a>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <a href="#modalCart" data-toggle="modal" class="btn pull-right">
      <i class="fa fa-shopping-cart"></i>&nbsp;
      View Cart (<span class="view_cart_count"><?=count($products);?></span>)
    </a>
  </div>
</div>
<?php display_flashmsg($this->session->flashdata());?>

<div class="col-md-12">
  <div id="popOverBox" style="display: block;"></div>
</div>
<br><br><br>

<div class="col-md-12">
<?=$grid;?>
</div>


<div class="clearfix"></div>
<div class="row">
  <div class="col-md-11">
    <a href="javascript:void(0)" data-po-id="<?=$form_product['po_id'];?>"  class="btn pull-right checkout-btn">Checkout</a>
  </div>
</div>
<input type="hidden" name="po_id" id="po_id" value="<?=$form_product['po_id'];?>">
<div id="modalCart" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Your Cart</h4>
      </div>
      <div class="modal-body">
        <form id="viewCart" method="post">
          <input type="hidden" name="po_id" value="<?=$form_product['po_id'];?>">
          <table class="table table-bordered table-hover">
            <thead>
              <th>Product Name</th><th>SKU</th><th>Qty</th><th>Unit Price</th><th>Total</th><th>Action</th>
            </thead>
            <tbody>
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
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <div class="col-md-2 pull-right">
          <a href="javascript:void(0);" data-po-id="<?=$form_product['po_id'];?>" class="btn checkout-btn pull-right">Checkout</a>
        </div>
        <div class="col-md-2 pull-right">
          <a href="javascript:void(0);" onclick="update_cart(this);" class="btn pull-right">Update Cart</a>
        </div>
      </div>
    </div>

  </div>
</div>