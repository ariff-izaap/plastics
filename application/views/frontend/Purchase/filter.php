<?php 
  //$date_range = array('name' => 'date_range', 'value' => $date_range, 'class' => 'form-control date_range');
?>

<form id="advance_search_form" class="advance_search_form" method="POST">
  <div class="col-md-12">
    <div class="filter-column">
      <div class="filter-row col-md-3 form-group">
        <label>Product</label>
        <select name="product[]" multiple class="form-control">
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
        <select name="form[]" multiple class="form-control">
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
        <select name="color[]" multiple class="form-control">
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
        <select name="package[]" multiple class="form-control">
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
    </div>
  </div>

  <div class="col-sm-2">
    <div class="text-center m_top">
      <a href="javascript:void(0)" class="btn btn-sm active" onclick="$.fn.clear_advance_search();">Clear</a>
      <button type="button" class="btn btn-sm" onclick="$.fn.submit_advance_search_form();">Search</button>
    </div>
  </div>
</form>
