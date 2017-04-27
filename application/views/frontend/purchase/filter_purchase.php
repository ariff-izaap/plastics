<form id="advance_search_form" class="advance_search_form" method="POST">
  <div class="col-md-12">
    <div class="filter-column">
      <div class="filter-row col-md-3 form-group">
        <label><input type="radio" name="so_id" value="1"> Purchase Orders without Shipping Orders</label>
        <label><input type="radio" name="so_id" value="2"> Purchase Orders with Shipping Orders</label>
        <label><input type="radio" name="so_id" value="3"> All Purchase Orders</label>        
      </div>
      <div class="filter-row col-md-3 form-group">
        <label>Vendors</label>
        <select multiple="" name="vendor_id" class="form-control select2_sample2">
          <?php
          if(get_all_vendors())
          {
            foreach (get_all_vendors() as $key => $value)
            {
              ?>
                <option value="<?=$value['id'];?>"><?=$value['business_name'];?></option>
              <?php
            }
          }
          ?>
        </select>
      </div>   
    
      <div class="filter-row col-md-3 form-group">
        <label>Date Range</label>
        <input type="text" class="form-control date_range" name="date_range" placeholder="From Date">
      </div>
      <div class="filter-row col-md-3 form-group" style="margin-top:16px;">
         <div class="col-md-8">
          <div class="text-center m_top">
            <a href="javascript:void(0)" class="btn btn-sm active" onclick="$.fn.clear_advance_search();">Clear</a>
            <button type="button" class="btn btn-primary access-level" onclick="$.fn.submit_advance_search_form();"><i class="fa fa-search"></i>Search</button>
          </div>
        </div>
      </div>
    </div>
  </div>

 
</form>
<div class="clearfix"></div>
<br>

<script type="text/javascript">
  $('.select2_sample2').selectpicker();

</script>