<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
      <div class="col-md-6 breadcrumbs-span">
        <?php echo set_breadcrumb(); ?>
      </div>
    <a href="<?=site_url('purchase');?>" class="btn pull-right">Back</a>
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
<div class="container">
  <div class="row">
    <form name="add_purchase" id="addPurchase" method="post">
      <input type="hidden" name="rand" class="rand" value="<?=isset($_POST['rand']) ? $_POST['rand'] : $po_id;?>">
      <input type="hidden" name="edit_id" class="edit_id" value="<?=$edit_data['po_id'];?>">
      <div class="form-grid">
        <div class="form-group col-md-4">
          <label required="">Purchase Order #</label>
          <input type="text" name="po_id" class="form-control" id="name" value="<?=$po_id;?>" readonly>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
        <h2>Vendor List</h2>
          <table class="table table-bordered table-hover">
            <thead>
              <th>#</th><th>Name</th><th>Contact Name</th><th>Phone</th><th>State</th><th>City</th><th>Salesman</th>
            </thead>
            <tbody>
              <?php
                if($vendor)
                {
                  $checked = "";
                  foreach ($vendor as $key => $value)
                  {
                      if($edit_data['vendor_id'] == $value['id'])
                        $checked = "checked";
                    ?>
                      <tr>
                        <td>
                          <label for="selectAll-<?=$value['id'];?>"  class="custom-radio">&nbsp;</label>
                          <input onclick="get_vendor_details('purchase/get_vendor_details/'+this.value)" type="radio" class="radio" name="vendor_id" value="<?=$value['id'];?>" <?=$checked;?> id="selectAll-<?=$value['id'];?>"
                          <?php if(isset($_POST['vendor_id'])){?> checked <?php }?> >
                        </td>
                        <td><?=$value['business_name'];?></td>
                        <td><?=$value['contact_name'];?></td>
                        <td><?=$value['contact_value'];?></td>
                        <td><?=$value['state'];?></td>
                        <td><?=$value['city'];?></td>
                        <td><?=$value['business_name'];?></td>
                      </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
          <?php
            if(form_error('vendor_id'))
            {
              ?>
                <div id='output'><?php echo (form_error('vendor_id'))? strip_tags(form_error('vendor_id')):'';?></div>
              <?php 
            }
            if($_POST['vendor_id'] || $edit_data['vendor_id'])
            {
              $vendor_id = isset($_POST['vendor_id']) ? $_POST['vendor_id'] : $edit_data['vendor_id'];
              $data = get_vendor_by_id($vendor_id);
            }
            else
              $data = array("vendor_name"=>"");
          ?>
        </div>
        <div class="form-grid col-md-6 panel panel-default panel-bor">
          <div class="panel-heading formcontrol-box">      
            <div class="form-group <?php echo (form_error('vendor_name'))?'error':'';?>" data-error="<?php echo (form_error('vendor_name'))? strip_tags(form_error('vendor_name')):'';?>">
              <label required="" class="col-md-4">Vendor Name</label>
              <input type="text" name="vendor_name" class="form-control col-md-8" id="vendor_name" value="<?=$data[0]['business_name']?>"  placeholder="Vendor Name">
            </div>
            <div class="form-group <?php echo (form_error('bill_name'))?'error':'';?>" data-error="<?php echo (form_error('bill_name'))? strip_tags(form_error('bill_name')):'';?>">
              <label required="" class="col-md-4">Bill To Name</label>
              <input type="text" name="bill_name" class="form-control col-md-8" id="bill_name" value="<?=$data[0]['b_name']?>"  placeholder="Bill To Name">
            </div>      
            <div class="form-group <?php echo (form_error('address_1'))?'error':'';?>" data-error="<?php echo (form_error('address_1'))? strip_tags(form_error('address_1')):'';?>">
              <label required="" class="col-md-4">Address 1</label>
              <input type="text" name="address_1" class="form-control col-md-8" id="address_1" value="<?=$data[0]['address1']?>"  placeholder="Address 1">
            </div>
            <div class="form-group">
              <label class="col-md-4">Address 2</label>
              <input type="text" name="address_2" class="form-control col-md-8" id="address_2" value="<?=$data[0]['address2']?>"  placeholder="Address 2">
            </div>
            
            <div class="form-group <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? strip_tags(form_error('city')):'';?>">
              <label required="" class="col-md-4">City</label>
              <input type="text" name="city" class="form-control col-md-8" id="city" value="<?=$data[0]['city']?>"  placeholder="City">
            </div>
            <div class="form-group  <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? strip_tags(form_error('state')):'';?>">
            <label required="" class="col-md-4">State</label>
            <select class="form-control col-md-8" name="state" id="state">
              <option value="">--Select State--</option>
              <?php
                if(get_state())
                {
                  foreach (get_state() as $key => $value)
                  {
                    ?>
                      <option <?php if($data[0]['state']==$value['state_code']){?> selected <?php }?>
                        value="<?=$value['state_code']?>"><?=$value['state_code']?></option>
                    <?php
                  }
                }
              ?>
            </select>
              </div>
              <div class="form-group <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? strip_tags(form_error('zipcode')):'';?>">
                <label required="" class="col-md-4">Zipcode</label>
                <input type="text" name="zipcode" class="form-control col-md-8" id="zipcode" value="<?=$data[0]['zipcode']?>" placeholder="Zipcode" maxlength="6">
              </div>
                  
            <div class="form-group clearfix postal cus-name">
              <div class="form-group col-md-6 fname1 <?php echo (form_error('firstname'))?'error':'';?>" data-error="<?php echo (form_error('firstname'))? strip_tags(form_error('firstname')):'';?>">
              <label required="">First Name</label>
              <input type="text" name="firstname" class="form-control" id="firstname" value="<?=$data[0]['first_name']?>"  placeholder="First Name">
              </div>
              <div class="form-group col-md-6 lname1 <?php echo (form_error('lastname'))?'error':'';?>" data-error="<?php echo (form_error('lastname'))? strip_tags(form_error('lastname')):'';?>">
              <label required="">Last Name</label>
              <input type="text" name="lastname" class="form-control" id="lastname" value="<?=$data[0]['last_name']?>"  placeholder="Last Name">
              </div>
            </div>
            <div class="form-group <?php echo (form_error('mobile'))?'error':'';?>" data-error="<?php echo (form_error('mobile'))? strip_tags(form_error('mobile')):'';?>">
              <label required="" class="col-md-4">Mobile</label>
              <input type="text" name="mobile" class="form-control col-md-8" id="mobile" value="<?=$data[0]['phone']?>" placeholder="(XXX) XXX-XXXXX">
            </div>
            <div class="form-group <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? strip_tags(form_error('email')):'';?>">
              <label required="" class="col-md-4">Contact Email</label>
              <input type="text" name="email" class="form-control col-md-8" id="email" value="<?=$data[0]['email']?>" placeholder="Email">
            </div>
            <div class="form-group">
              <label class="col-md-4">Website</label>
              <input type="text" name="website" class="form-control col-md-8" id="website" value="<?=$data[0]['web_url'];?>"
                placeholder="Website e.g. http://www.example.com">
            </div>
          </div>
        </div>      
        <div class="form-grid col-md-6 panel panel-default panel-bor">
          <div class="panel-heading formcontrol-box">
            <div class="form-group">
              <label class="col-md-4">Salesman</label>
              <select class="form-control col-md-8" name="salesman"></select>
            </div>
            <div class="form-group">
              <label class="">Release to be Sold</label>
              <!-- <input type="checkbox" name="to_sold" class="" id="to_sold" value="Yes"> -->
              <label for="selectAll-0" class="custom-checkbox">&nbsp;</label>
              <input type="checkbox" id='selectAll-0' class= 'checkbox' <?=$edit_data['release_to_sold']=="Yes" ? 'checked':'';?>  name="to_sold" value="Yes">
            </div>
            <div class="form-group <?php echo (form_error('pickup_date'))?'error':'';?>" data-error="<?php echo (form_error('pickup_date'))? strip_tags(form_error('pickup_date')):'';?>">
              <label required="">Date for Pickup</label>
              <input type="text" name="pickup_date" class="form-control singledate" id="pickup_date" value="<?=$edit_data['pickup_date'];?>"  placeholder="Pickup Date">
            </div>
            <div class="form-group <?php echo (form_error('delivery_date'))?'error':'';?>" data-error="<?php echo (form_error('delivery_date'))? strip_tags(form_error('delivery_date')):'';?>">
              <label required="">Estimated Date for Delivery to Customer/Warehouse</label>
              <input type="text" name="delivery_date" class="form-control singledate" id="delivery_date" value="<?=$edit_data['estimated_delivery'];?>"  placeholder="Delviery Date">
            </div>      
            <div class="clearfix"></div>
            <div class="form-group">
              <label class="">Documents to Attach</label>
                <div class="clearfix"></div>
                <a href="#UploadModal" data-toggle="modal" class="col-md-3"><i class="fa fa-2x fa-file-zip-o"></i></a>
            </div>
          </div>
        </div> 
        <div class="clearfix"></div>
        <input type="hidden" name="edit_id" class="form-control" id="edit_id" value="<?=$editdata['id'];?>">
        <div class="form-group col-md-2">
          <button type="submit" class="btn btn-block">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

