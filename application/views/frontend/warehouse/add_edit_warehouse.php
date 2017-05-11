<div class="row blue-mat">
	<div class="breadcrumbs col-md-12">
			<div class="col-md-6 breadcrumbs-span">
				<?php echo set_breadcrumb(); ?>
			</div>
		<a href="<?=site_url('warehouse');?>" class="btn btn-danger pull-right">Back</a>
	</div>
</div>
<?php display_flashmsg($this->session->flashdata()); ?>
<div class="container">
  <div class="row ">
  <div class="panel panel-default panel-bor">
  <div class="panel-heading" style="display:inline-block;">
    <form name="add_purchase" id="addPurchase" method="post">
      <div class="form-grid" style="padding-top:20px;">
        <div class="form-group col-md-4 <?php echo (form_error('wname'))?'error':'';?>" data-error="<?php echo (form_error('wname'))? strip_tags(form_error('wname')):'';?>">
          <label required="">Warehouse Name</label>
          <input type="text" name="wname" class="form-control" id="wname" value="<?=$edit_data['name'];?>">
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('address1'))?'error':'';?>" data-error="<?php echo (form_error('address1'))? strip_tags(form_error('address1')):'';?>">
          <label required="">Address 1</label>
          <input type="text" name="address1" class="form-control" id="address1" value="<?=$edit_data['address1'];?>">
        </div>
        <div class="form-group col-md-4">
          <label>Address 2</label>
          <input type="text" name="address2" class="form-control" id="address2" value="<?=$edit_data['address2'];?>">
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('city'))?'error':'';?>" data-error="<?php echo (form_error('city'))? strip_tags(form_error('city')):'';?>">
          <label required="">City</label>
          <input type="text" name="city" class="form-control" id="city" value="<?=$edit_data['city'];?>">
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('state'))?'error':'';?>" data-error="<?php echo (form_error('state'))? strip_tags(form_error('state')):'';?>">
          <label required="">State</label>
          <select name="state" class="form-control">
          	<option value="">--Select--</option>
          	<?php
          		if(get_state())
          		{
          			foreach (get_state() as $key => $value)
          			{
          				?>
          					<option <?php if($edit_data['state']==$value['id']) { ?> selected <?php }?>
          						value="<?=$value['id'];?>"><?=$value['name'];?></option>
          				<?php
          			}
          		}
          	?>
          </select>
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('country'))?'error':'';?>" data-error="<?php echo (form_error('country'))? strip_tags(form_error('country')):'';?>">
          <label required="">Country</label>
          <select name="country" class="form-control">
          	<option value="">--Select--</option>
          	<?php
          		if(get_country())
          		{
          			foreach (get_country() as $key => $value)
          			{
          				?>
          					<option <?php if($edit_data['country']==$value['id']) { ?> selected <?php }?>
          						value="<?=$value['id'];?>"><?=$value['name'];?></option>
          				<?php
          			}
          		}
          	?>
          </select>
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('phone'))?'error':'';?>" data-error="<?php echo (form_error('phone'))? strip_tags(form_error('phone')):'';?>">
          <label required="">Phone</label>
          <input type="text" name="phone" class="form-control" id="phone" value="<?=$edit_data['phone'];?>">
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('zipcode'))?'error':'';?>" data-error="<?php echo (form_error('zipcode'))? strip_tags(form_error('zipcode')):'';?>">
          <label required="">Zipcode</label>
          <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?=$edit_data['zipcode'];?>">
        </div>
        <div class="form-group col-md-4 <?php echo (form_error('email'))?'error':'';?>" data-error="<?php echo (form_error('email'))? strip_tags(form_error('email')):'';?>">
          <label required="">Email</label>
          <input type="text" name="email" class="form-control" id="email" value="<?=$edit_data['email'];?>">
        </div>
        <div class="form-group col-md-4">
          <label required="">Status</label><br>
          <input type="radio" name="status" class="" id="name" value="1" <?=$edit_data['status']=="1"?"checked":"checked";?>>Yes
          <input type="radio" name="status" class="" id="name" value="0" <?=$edit_data['status']=="0"?"checked":"";?>>No
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <input type="submit" name="name" class="btn btn-success" id="name" value="Submit">
        </div>
      </div>
    </form>
    </div>
    </div>
  </div>
</div>