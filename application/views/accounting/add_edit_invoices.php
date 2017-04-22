<div class="row blue-mat">
	<div class="col-md-12 padding-zero">
    <div class="col-md-6 breadcrumbs">
      <?php echo set_breadcrumb(); ?>
    </div>
    <div class="col-md-6 action-buttons text-right">
      <a href="<?=site_url('accounting/shipping_orders');?>" class="btn active" capsOn>Back</a>
    </div>
  </div>
</div>

<?php display_flashmsg($this->session->flashdata());?>
<!-- <?="<pre>";print_r($so_details);echo"</pre>";?> -->
<?php
  if($so_details)
  {
    $ship_date = [];$total_amount=[];$cod_fee = [];$freight = [];$salesman = [];$salesman_id = [];
    foreach ($so_details as $key => $value)
    {
      $ship_date[] = date("Y-m-d",strtotime($value['ship_date']));
      $total_amount[] = $value['total_amount'];
      $cod_fee[] = $value['cod_fee'];
      $salesman_id[] = $value['salesman_id'];
      $freight[] = $value['total_shipping'];
      $salesman[] = $value['first_name']." ".$value['last_name'];
    }
  }
  $amount = array_sum($total_amount) + array_sum($cod_fee) + array_sum($freight);
  // echo "<pre>";print_r($so_details);echo "</pre>";
?>
<form action="" method="post" class="InvoiceForm" name="InvoiceForm">
  <input type="hidden" name="customer_id" value="<?=$so_details[0]['c_id'];?>">
  <input type="hidden" name="salesman_id" value="<?=implode(",",$salesman_id);?>">
  <input type="hidden" name="shipping_id" value="<?=$so_details[0]['shipping_address_id'];?>">
  <input type="hidden" name="billing_id" value="<?=$so_details[0]['billing_address_id'];?>">
  <input type="hidden" name="shipment_id" value="<?=$so_details[0]['carrier_id'];?>">
  <input type="hidden" name="po_id" value="<?=$so_details[0]['po_id'];?>">
  <div class="container">
  <div class="row">
    <div class="form-grid col-md-6 panel panel-default panel-bor s-p-box1">
    <div class="panel-heading formcontrol-box prod-sel account-invoice">
      <div class="form-group">
        <label class="col-md-6"> Shipping Order(s) :</label>
        <div class="col-md-6">
          <textarea name="so_id" class="form-control" readonly><?=str_replace(",","\n",implode(",",$so_id));?></textarea>
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6"> Salesman :</label>
        <div class="col-md-6">
          <textarea class="form-control" name="salesman" readonly><?=str_replace(",","\n",implode(",",$salesman));?></textarea>
        </div>
      </div>
     
      <div class="form-group">
        <label class="col-md-6"> Shipping Date :</label>
        <div class="col-md-6">
          <textarea class="form-control" name="ship_date" readonly><?=str_replace(",","\n",implode(",",$ship_date));?></textarea>
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6" > Customer Name :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['cname'];?>">
        </div>
      </div>
     <div class="clearfix"></div>
      <div class="form-group">
        <label class="col-md-6" > Billing Address 1 :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['address_1'];?>">
        </div>
      </div>
     
      <div class="form-group">
        <label class="col-md-6" > Billing Address 2 :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['address_2'];?>">
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6" > City :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['city'];?>">
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6" > State :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['state_name'];?>">
        </div>
      </div>
     
      <div class="form-group">
        <label class="col-md-6" > Country :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['country_name'];?>">
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6" > Zipcode :</label>
        <div class="col-md-6">
         <input type="text" class="form-control" readonly value="<?=$so_details[0]['zipcode'];?>">
        </div>
      </div>
     
    </div>
    </div>
    <div class="form-grid col-md-6 panel panel-default panel-bor s-p-box1">
    <div class="panel-heading formcontrol-box prod-sel account-invoice">
      <div class="form-group">
        <label class="col-md-6" > Invoice Date :</label>
        <div class="col-md-6">
          <input type="text" class="form-control datetime" name="invoice_date">
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6" > Due Date :</label>
        <div class="col-md-6">
          <input type="text" class="form-control datetime" name="due_date">
        </div>
      </div>
      
      <div class="form-group">
        <label class="col-md-6" > Terms :</label>
        <div class="col-md-6">
          <select class="form-control" name="credit_type">
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
    
      <!-- <div class="form-group">
        <label class="col-md-3" > PO# :</label>
        <div class="col-md-6">
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div><br>
      <div class="form-group">
        <label class="col-md-3" > SO# :</label>
        <div class="col-md-6">
          <input type="text" class="form-control" readonly=""  value="<?=$so_details[0]['so_id'];?>">
        </div>
      </div> -->
      
      <div class="form-group">
        <label class="col-md-6" > Amount :</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="amount" value="<?=displayData(array_sum($total_amount),'money');?>" readonly>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="form-group">
        <label class="col-md-6" > Prepaid COD :</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="cod_fee" readonly value="<?=displayData(array_sum($cod_fee),'money');?>">
        </div>
      </div>
    
      <div class="form-group">
        <label class="col-md-6" > Freight Amount :</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="freight" readonly value="<?=displayData(array_sum($freight),'money');?>">
        </div>
      </div>
     
      <div class="form-group">
        <label class="col-md-6" > Additional Amount:</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="add_amt" readonly value="<?=displayData('0','money');?>">
        </div>
      </div>
    
      <div class="form-group">
        <label class="col-md-6" > Total Amount :</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="total_amount" readonly value="<?=displayData($amount,'money');?>">
        </div>
      </div>
     
    </div>
    </div>
  </div>
  </div>

  <div class="row">
    <div class="col-md-4 pull-right">
      <button type="submit" name="save_invoice" class="btn" >Save Invoice</button>
      <!-- <button type="button" class="btn" >Print Invoice</button> -->
    </div>
  </div>
</form>
<br>
<br><br>