<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Checkout</h4>
    </div>
    <div class="modal-body" style="max-height: 450px;overflow: auto;">
      <form action="" method="post" id="CheckoutSO">
        <input type="hidden" name="vendor_id" value="<?=$vendor_id;?>">
        <div class="row">
          <div class="col-md-12 ">
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Customer</label>
                <div class="col-md-8">
                  <select class="form-control input-sm ship_customer_id required" name="ship_customer_id">
                    <option value="">--Select--</option>
                    <?php
                      if(get_all_vendors())
                      {
                        foreach (get_all_vendors() as $key => $value)
                        {
                          ?>
                            <option <?=($customer['id']==$value['id'])?"selected":"";?>
                              value="<?=$value['id'];?>"><?=$value['business_name'];?></option>
                          <?php
                        }
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Shipping</label>
                <div class="col-md-8">
                  <select name="ship_method" class="form-control input-sm required">
                    <option value="">--Select Ship Method--</option>
                    <?php
                    if(get_shipping_type())
                    {
                      foreach (get_shipping_type() as $key => $value)
                      {
                        ?>
                          <option value="<?=$value['id'];?>"><?=$value['type'];?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Carrier</label>
                <div class="col-md-8">
                   <select name="ship_service" class="form-control input-sm required">
                    <option value="">--Select Service--</option>
                    <?php
                    if(get_carrier())
                    {
                      foreach (get_carrier() as $key => $value)
                      {
                        ?>
                          <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Payment</label>
                <div class="col-md-8">
                  <select name="credit_type" class="form-control input-sm required">
                    <option value="">--Select Payment Term--</option>
                    <?php
                    if(get_credit_type())
                    {
                      foreach (get_credit_type() as $key => $value)
                      {
                        ?>
                          <option value="<?=$value['id'];?>"><?=$value['name'];?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-6">
            <h4>Billing Information</h4><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Business Name</label>
                <div class="col-md-8">
                  <input type="text" name="business_name" class="form-control required" value="<?=$customer['b_name'];?>">
                  <input type="hidden" name="billing_id" class="form-control" value="<?=$customer['b_id'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">First Name</label>
                <div class="col-md-8">
                  <input type="text" name="first_name" class="form-control required" value="<?=$customer['b_fname'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Last Name</label>
                <div class="col-md-8">
                  <input type="text" name="last_name" class="form-control required" value="<?=$customer['b_lname'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Email</label>
                <div class="col-md-8">
                  <input type="text" name="email" class="form-control required" value="<?=$customer['b_email'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">URL</label>
                <div class="col-md-8">
                  <input type="text" name="url" class="form-control required" value="<?=$customer['web_url'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Mobile</label>
                <div class="col-md-8">
                  <input type="text" name="mobile" class="form-control required" value="<?=$customer['b_mobile'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Address1</label>
                <div class="col-md-8">
                  <input type="text" name="address1" class="form-control required" value="<?=$customer['b_address1'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Address2</label>
                <div class="col-md-8">
                  <input type="text" name="address2" class="form-control" value="<?=$customer['b_address2'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">City</label>
                <div class="col-md-8">
                  <input type="text" name="city" class="form-control required" value="<?=$customer['b_city'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">State</label>
                <div class="col-md-8">
                  <input type="text" name="state" class="form-control required" value="<?=$customer['b_state'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
             <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Country</label>
                <div class="col-md-8">
                  <input type="text" name="country" class="form-control required" value="<?=$customer['b_country'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Zipcode</label>
                <div class="col-md-8">
                  <input type="text" name="zipcode" class="form-control required" value="<?=$customer['b_zipcode'];?>">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h4>Shipping Information</h4><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Name</label>
                <div class="col-md-8">
                  <input type="text" name="s_name" class="form-control required" value="<?=$customer['s_name'];?>">
                  <input type="hidden" name="ship_id" class="form-control" value="<?=$customer['s_id'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Mobile</label>
                <div class="col-md-8">
                  <input type="text" name="s_mobile" class="form-control required" value="<?=$customer['s_phone'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Address1</label>
                <div class="col-md-8">
                  <input type="text" name="s_address1" class="form-control required" value="<?=$customer['s_address1'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Address2</label>
                <div class="col-md-8">
                  <input type="text" name="s_address2" class="form-control" value="<?=$customer['s_address2'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">City</label>
                <div class="col-md-8">
                  <input type="text" name="s_city" class="form-control required" value="<?=$customer['s_city'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">State</label>
                <div class="col-md-8">
                  <input type="text" name="s_state" class="form-control required" value="<?=$customer['s_state'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Country</label>
                <div class="col-md-8">
                  <input type="text" name="s_country" class="form-control required" value="<?=$customer['s_country'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Zipcode</label>
                <div class="col-md-8">
                  <input type="text" name="s_zipcode" class="form-control required" value="<?=$customer['s_zipcode'];?>">
                </div>
              </div>
            </div>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">SO Instructions</label>
                <div class="col-md-8">
                  <textarea rows="5" class="form-control" name="so_instructions"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-3">BOL Instructions</label>
                <div class="col-md-8">
                  <textarea rows="5" class="form-control" name="bol_instructions"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div><br>
      </form>
      <form action="" method="post" id="CartSOForm">
        <div class="row">
          <div class="col-md-12 cart-table">
            <h2 class="col-md-8">Cart</h2>
            <a class="btn btn-warning update_so_cart pull-right"><i class="fa fa-edit"></i> Update Cart</a>
            <table class="table table-hover table-bordered">
              <thead>
                <th>Product</th><th>SKU</th><th>Unit Price</th><th>Quantity</th><th>Total</th><th>Action</th>
              </thead>
              <tbody>
                  <?php
                    if($this->cart->contents())
                    {
                      foreach ($this->cart->contents() as $key => $value)
                      {
                        $rand = rand();
                        ?>
                          <tr>
                            <td><?=$value['name'];?></td>
                            <td><?=$value['id'];?></td>
                            <td><?=$value['price'];?></td>
                            <td>
                              <input type="number" value="<?=$value['qty'];?>" name="qty[<?=$value['rowid'];?>]">
                            </td>
                            <td><?=displayData($value['subtotal'],'money');?></td>
                            <td>
                              <a href="javascript:void(0);" class="btn btn-danger remove_po_cart" data-id="<?=$value['rowid'];?>">
                              <i class="fa fa-remove"></i></a>
                            </td>
                          </tr>
                        <?php
                      } 
                    }
                  ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4" class="text-right">Total</td>
                  <td><?=displayData($this->cart->total(),'money');?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <div class="col-md-3 pull-right">
        <button class="btn back-checkout-so btn-danger pull-left">Back</button>
        <button class="btn btn-primary order-so-btn pull-right">Order Now</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(".ship_customer_id").change(function(){
    val = $(this).val();
    v_id = $("input[name='vendor_id']").val();
    $.ajax({
      type:"POST",
      url:base_url+'dashboard/get_customer_info',
      data:{val:val,v_id:v_id},
      dataType:'json',
      success:function(data)
      {
        console.log(data);
        $("#SOProcess").html(data.content);
      }
    });
  });

  $(".back-checkout-so").click(function(){
    c_id = $(".customer_id").val();
    $.ajax({
      type:"POST",
      url:base_url+'dashboard/create_new_so',
      data:{c_id:c_id},
      dataType:'json',
      success:function(data)
      {
        console.log(data);
        $("#SOProcess").html(data.content);
        $(".cart-table table").html(data.cart);
      }
    });
  });

  $(".order-so-btn").click(function(){
    valid = true;
    elem = $(".required");
    elem.each(function(e,ele){
        if($(ele).val()=='')
        {
          valid = false;
          $(ele).css("border",'1px solid red');
        }
        else
          $(ele).css("border",'1px solid #ccc');
    });
    if(valid)
    {
      form = $("form#CheckoutSO").serialize();
      $.ajax({
        type:"POST",
        data:form,
        url:base_url+'dashboard/order_so',
        dataType:'json',
        success:function(data)
        {
          console.log(data);
          $("#SOProcess").html(data.content);
        }
      });
    }
  });

$(".update_so_cart").click(function(){
    form = $("form#CartSOForm").serialize();
    $.ajax({
      type:"POST",
      url:base_url+'dashboard/update_so_cart',
      data:form,
      dataType:'json',
      success:function(data)
      {
        console.log(data);
        $(".cart-table table").html(data.cart);
      }
    });
  });

</script>