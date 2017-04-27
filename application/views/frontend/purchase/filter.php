<?php 
  //$date_range = array('name' => 'date_range', 'value' => $date_range, 'class' => 'form-control date_range');
?>

<form id="advance_search_form" class="advance_search_form" method="POST">
  <input type="hidden" name="vendor" class="vendor_input">
  <div class="col-md-12">
    <div class="filter-column">
      <div class="filter-row col-md-3 form-group">
        <label>Product</label>
        <select name="product[]" multiple data-selected-text-format="count" class="select2_sample2 form-control" data-size="5">
          <?php
            if(get_products())
            {
              foreach (get_products() as $key => $value)
              {
                ?>
                  <option value="<?=$value['name'];?>"><?=$value['name'];?></option>
                <?php
              }
            }
          ?>
        </select>
      </div>
      <div class="filter-row col-md-3 form-group">
        <label>Form</label>
        <select name="form[]" multiple data-selected-text-format="count" class="select2_sample2 form-control" data-size="5">
          <?php
            if(get_forms())
            {
              foreach (get_forms() as $key => $value)
              {
                ?>
                  <option value="<?=$value['name'];?>"><?=$value['name'];?></option>
                <?php
              }
            }
          ?>
        </select>
      </div>
      <div class="filter-row col-md-3 form-group">
        <label>Color</label>
        <select name="color[]" multiple data-selected-text-format="count" class="select2_sample2 form-control" data-size="5">
          <?php
            if(get_colors())
            {
              foreach (get_colors() as $key => $value)
              {
                ?>
                  <option value="<?=$value['name'];?>"><?=$value['name'];?></option>
                <?php
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="filter-column">
      <div class="filter-row form-group col-md-3">
        <label>Packaging</label>
        <select name="package[]" multiple data-selected-text-format="count" class="select2_sample2 form-control"  data-size="5">
          <?php
            if(get_packages())
            {
              foreach (get_packages() as $key => $value)
              {
                ?>
                  <option value="<?=$value['name'];?>"><?=$value['name'];?></option>
                <?php
              }
            }
          ?>
        </select>
      </div>
       <div class="filter-row form-group col-md-3">
        <label>Notes</label>
        <select name="note[]" multiple data-selected-text-format="count" class=" select2_sample2 form-control" data-size="5">
          <?php
            if(get_product_notes())
            {
              foreach (get_product_notes() as $key => $value)
              {
                if($value['notes']!='')
                {
                  ?>
                    <option value="<?=$value['notes'];?>"><?=$value['notes'];?></option>
                  <?php
                }
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-2 filter-search">
      <div class="text-center m_top">
        <a href="javascript:void(0)" class="btn btn-sm active" onclick="$.fn.clear_advance_search();">Clear</a>
        <button type="button" class="btn btn-primary purchase_order_search access-level" onclick="$.fn.submit_advance_search_form();"><i class="fa fa-search"></i>Search</button>
      </div>
  </div>
  </div>

 
</form>

<script type="text/javascript">
  // $('.select2_sample2').select2({
  //     placeholder: "Select Value",
  //     allowClear: true
  // });
  $('.select2_sample2').selectpicker();

</script>