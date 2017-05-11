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
            <div class="col-md-4 padding-zero">
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
            <div class="col-md-4 padding-zero">
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
            <div class="col-md-4 padding-zero">
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
        </div>
        <div class="row">
          <div class="col-md-12 ">
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-5">COD Fee</label>
                <div class="col-md-7 padding-zero">
                  <input type="text" name="cod_fee" class="form-control" placeholder="COD Fee">
                </div>
              </div>
            </div>
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-6">Freight Paid</label>
                <div class="col-md-6 padding-zero">
                  <input type="text" name="freight_paid" class="form-control" placeholder="Freight Paid">
                </div>
              </div>
            </div>
            <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-3">Amount</label>
                <div class="col-md-8">
                  <input type="text" name="amount" class="form-control" placeholder="Amount">
                </div>
              </div>
            </div>
             <div class="col-md-3 padding-zero">
              <div class="form-group">
                <label class="col-md-6">Add. Amount</label>
                <div class="col-md-6">
                  <input type="text" name="add_amount" class="form-control" placeholder="Add. Amount">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 checkoutpo-form">
            <h4 style="padding-left:14px;">Billing Information</h4><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Business Name</label>
                <div class="col-md-8">
                  <input type="text" name="business_name" class="form-control required" value="<?=$customer['b_name'];?>">
                  <input type="hidden" name="billing_id" class="form-control" value="<?=$customer['b_id'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">First Name</label>
                <div class="col-md-8">
                  <input type="text" name="first_name" class="form-control required" value="<?=$customer['b_fname'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Last Name</label>
                <div class="col-md-8">
                  <input type="text" name="last_name" class="form-control required" value="<?=$customer['b_lname'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Email</label>
                <div class="col-md-8">
                  <input type="text" name="email" class="form-control required" value="<?=$customer['b_email'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">URL</label>
                <div class="col-md-8">
                  <input type="text" name="url" class="form-control required" value="<?=$customer['web_url'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Mobile</label>
                <div class="col-md-8">
                  <input type="text" name="mobile" class="form-control required" value="<?=$customer['b_mobile'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Address1</label>
                <div class="col-md-8">
                  <input type="text" name="address1" class="form-control required" value="<?=$customer['b_address1'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Address2</label>
                <div class="col-md-8">
                  <input type="text" name="address2" class="form-control" value="<?=$customer['b_address2'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">City</label>
                <div class="col-md-8">
                  <input type="text" name="city" class="form-control required" value="<?=$customer['b_city'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">State</label>
                <div class="col-md-8">
                  <select class="form-control input-sm">
                    <?php
                      if(get_state())
                      {
                        foreach (get_state() as $key => $value)
                        {
                          ?>
                            <option <?=($value['name']==$customer['b_state'])?"selected":"";?>
                              value="<?=$value['name'];?>"><?=$value['name'];?></option>
                          <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Country</label>
                <div class="col-md-8">
                  <select class="form-control input-sm">
                    <?php
                      if(get_country())
                      {
                        foreach (get_country() as $key => $value)
                        {
                          ?>
                            <option <?=($value['name']==$customer['b_country'])?"selected":"";?>
                              value="<?=$value['name'];?>"><?=$value['name'];?></option>
                          <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Zipcode</label>
                <div class="col-md-8">
                  <input type="text" name="zipcode" class="form-control required" value="<?=$customer['b_zipcode'];?>">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 checkoutpo-form">
            <h4 style="padding-left:14px;">Shipping Information</h4><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Name</label>
                <div class="col-md-8">
                  <input type="text" name="s_name" class="form-control required" value="<?=$customer['s_name'];?>">
                  <input type="hidden" name="ship_id" class="form-control" value="<?=$customer['s_id'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Mobile</label>
                <div class="col-md-8">
                  <input type="text" name="s_mobile" class="form-control required" value="<?=$customer['s_phone'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Address1</label>
                <div class="col-md-8">
                  <input type="text" name="s_address1" class="form-control required" value="<?=$customer['s_address1'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Address2</label>
                <div class="col-md-8">
                  <input type="text" name="s_address2" class="form-control" value="<?=$customer['s_address2'];?>">
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">City</label>
                <div class="col-md-8">
                  <input type="text" name="s_city" class="form-control required" value="<?=$customer['s_city'];?>">
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">State</label>
                <div class="col-md-8">
                  <select class="form-control input-sm" name="s_state">
                    <?php
                      if(get_state())
                      {
                        foreach (get_state() as $key => $value)
                        {
                          ?>
                            <option <?=($value['name']==$customer['s_state'])?"selected":"";?>
                              value="<?=$value['id'];?>"><?=$value['name'];?></option>
                          <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div><div class="clearfix"></div><br>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Country</label>
                <div class="col-md-8">
                   <select class="form-control input-sm" name="s_country">
                    <?php
                      if(get_country())
                      {
                        foreach (get_country() as $key => $value)
                        {
                          ?>
                            <option <?=($value['name']==$customer['s_country'])?"selected":"";?>
                              value="<?=$value['id'];?>"><?=$value['name'];?></option>
                          <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">Zipcode</label>
                <div class="col-md-8">
                  <input type="text" name="s_zipcode" class="form-control required" value="<?=$customer['s_zipcode'];?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">SO Instructions</label>
                <div class="col-md-8">
                  <textarea rows="5" class="form-control" name="so_instructions"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6 padding-zero">
              <div class="form-group">
                <label class="col-md-4">BOL Instructions</label>
                <div class="col-md-8">
                  <textarea rows="5" class="form-control" name="bol_instructions"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
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

  $(".remove_so_cart").click(function(){
    rowid = $(this).attr("data-id");
    con = confirm("Are you sure want to remove?");
    if(con)
    {
      $.ajax({
        type:"POST",
        url:base_url+'dashboard/remove_so_cart',
        data:{rowid:rowid},
        dataType:'json',
        success:function(data)
        {
          $(".cart-table table").html(data.cart);
        }
      });
    }
  });
</script>