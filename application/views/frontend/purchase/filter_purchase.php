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
        <select multiple="" name="vendor_id" class="form-control">
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
      <div class="filter-row col-md-3 form-group">
        
      </div>
    </div>
  </div>

  <div class="col-sm-2">
    <div class="text-center m_top">
      <a href="javascript:void(0)" class="btn btn-sm active" onclick="$.fn.clear_advance_search();">Clear</a>
      <button type="button" class="btn btn-primary" onclick="$.fn.submit_advance_search_form();">Search</button>
    </div>
  </div>
</form>
<div class="clearfix"></div>
<br>
