<div class="succ_msg"></div>
<form action="" method="post" id="POProductAdd">
	<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label>Vendor : <b><?=get_vendor_by_id($vendor_id)[0]['business_name'];?></b></label>
		</div>
		<div class="clearfix"></div>
		<div class="form-group">
			<label class="col-md-2 padding-zero">Product: </label>
			<div class="col-md-10">
				<select class="select2_sample2 form-comtrol" name="product" data-placeholder="--Select--">
					<option value="">--Select--</option>
					<?php
						if(get_products_by_vendor($vendor_id))
						{
							foreach (get_products_by_vendor($vendor_id) as $key => $value)
							{
								?>
									<option value="<?=$value['id'];?>"><?=$value['name']." - ".displayData($value['wholesale_price'],'money');?></option>
								<?php 
							}
						}
					?>
				</select>
			</div>
		</div><br>
		<div class="form-group">
			<label class="col-md-2 padding-zero">Quantity:</label>
			<div class="col-md-10">
				<input type="number" max="10" min="1" name="quantity" autocomplete="off" class="form-control" placeholder="Quantity">
				<input type="hidden" name="po_id" value="<?=$po_id;?>">
			</div>
		</div>
	</div>
	</div>
</form>
<script type="text/javascript">
	$(".select2_sample2").select2();
</script>