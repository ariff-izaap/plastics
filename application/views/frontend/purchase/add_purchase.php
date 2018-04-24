<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
      <div class="col-md-6 breadcrumbs-span">
        <?php echo set_breadcrumb(); ?>
      </div>
    <a href="<?=site_url('purchase');?>" class="btn btn-danger pull-right">Back</a>
  </div>
</div>
<?php display_flashmsg($this->session->flashdata());?>

<div id="UploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Document</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <form action="" class="UploadDocForm" method="post" enctype="multipart/form-data">
          
            <div class="form-group col-md-6">
              <label class="">Upload Document</label>
              <input type="file" name="po_doc[]" class="form-control po_doc" id="">
              <span class="help-block">Allowed Extension : doc,docx,pdf,xls,xlsx</span>
            </div>            
            <div class="clearfix"></div>            
            <div class="col-md-12 doc-uploaded">
              <?php
              if(isset($_POST['rand']) && $_POST['rand']!='')
              {
                $fis = scandir("assets/uploads/purchase/tmp/".$_POST['rand']);
                for ($i=2; $i < count($fis); $i++)
                { 
                  echo "<div id='row_".$i."'>".$fis[$i]."<a href='javascript:void(0)' data-id='".$i."' data-name='".$fis[$i]."' data-rand='".$_POST['rand']."' class='col-md-2 pull-right cancel-file'>x</a></div>";
                }
              }
              else if($edit_data['po_id'])
              {
                 $fis = scandir("assets/uploads/purchase/".$edit_data['po_id']);
                for ($i=2; $i < count($fis); $i++)
                { 
                  echo "<div id='row_".$i."'>".$fis[$i]."<a href='javascript:void(0)' data-id='".$i."' data-name='".$fis[$i]."' data-rand='".$edit_data['po_id']."' data-po-id='".$edit_data['po_id']."' class='col-md-2 pull-right cancel-file'>x</a></div>";
                }
              }
              ?>
            </div>
            <div class="clearfix"></div><br>
            <div class="col-md-3">
              <button type="button" class="btn upload-doc"><i class="fa fa-upload"></i> Upload</button>
            </div>
            <div class="clearfix"></div><br>
            <div class="col-md-12 upload-msg">
              
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="purchase-loader">
  <img src="<?=base_url();?>assets/img/rolling.gif">
</div>
<div class="container custom-add-purchase">
  <div class="row">
    <div class="col-md-12">
      <div id="popOverBox" style="display: block;"></div>
    </div>
    <div class="clearfix"></div><br>

    <form name="add_purchase" id="addPurchase" method="post">
      
      <input type="hidden" name="edit_id" class="edit_id" value="<?=$edit_data['po_id'];?>">
      <div class="form-grid">
        <div class="form-group col-md-4">
          <label required="">Purchase Order #</label>
          <input type="text" name="po_id" class="form-control" id="name" value="<?=$po_id;?>" readonly>
        </div>
        
        <div class="form-group col-md-4">
          <label>Select Vendor</label>
          <select name="vendor_id" class="form-control vendor_select select2_sample2">
            <option value="">--Select--</option>
            <?php
               if($vendor)
                {
                  foreach ($vendor as $key => $value)
                  {
                    ?>
                      <option <?=($edit_data['vendor_id']==$value['id']) ? "selected" : "";?>
                        value="<?=$value['id'];?>"><?=$value['business_name'];?></option>
                    <?php
                  }
                }
            ?>
          </select>
        </div>
        <div class="form-group col-md-2 pull-right">
          <br>
          <a href="#modalCart" data-toggle="modal" class="btn btn-success pull-right">
            <i class="fa fa-shopping-cart"></i>&nbsp;
            View Cart (<span class="view_cart_count"><?=count($this->cart->contents());?></span>)
          </a>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">        
          <div class="row">
            <?=$grid;?>
          </div>
          <div class="clearfix"></div>
          <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?=$editdata['id'];?>">
          <div class="form-group col-md-2 col-md-offset-10 pull-right">
            <button type="submit" name="save_product" class="btn pull-right btn-lg btn-primary">
              <i class="fa fa-arrow-right"></i> Checkout
            </button>
          </div>
      </div>
    </form>
  </div>
</div>

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
              if($this->cart->contents())
              {
                foreach ($this->cart->contents() as $key => $value)
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
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <div class="col-md-2 pull-right">
          <a href="javascript:void(0);" data-po-id="<?=$form_product['po_id'];?>" class="btn btn-info checkout-btn pull-right">Checkout</a>
        </div>
        <div class="col-md-2 pull-right">
          <a href="javascript:void(0);" onclick="update_cart(this);" class="btn btn-primary pull-right">Update Cart</a>
        </div>
      </div>
    </div>

  </div>
</div>