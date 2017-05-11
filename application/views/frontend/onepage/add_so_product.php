<div class="succ_msg"></div>
<form action="" method="post" id="SOProductAdd">
	<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="col-md-2 padding-zero">Product: </label>
			<div class="col-md-10">
				<select class="select2_sample2 form-comtrol" name="product" data-placeholder="--Select--">
					<option value="">--Select--</option>
					<?php
						if(get_products())
						{
							foreach (get_products() as $key => $value)
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
				<input type="number" max="10" min="1" name="quantity" class="form-control" placeholder="Quantity">
				<input type="hidden" name="so_id" value="<?=$so_id;?>">
				<input type="hidden" name="vendor_id" value="<?=$vendor_id;?>">
			</div>
		</div>
	</div>
	</div>
</form>
<script type="text/javascript">
	$(".select2_sample2").select2();
</script>