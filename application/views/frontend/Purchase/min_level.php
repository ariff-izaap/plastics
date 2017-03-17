<div class="row blue-mat">
  <div class="breadcrumbs col-md-12">
      <div class="col-md-6 breadcrumbs-span">
        <?php echo set_breadcrumb(); ?>
      </div>
  </div>
</div>
<?php display_flashmsg($this->session->flashdata());?>

<div class="container">
  <div class="row">
    <form name="minLevel" id="minLevel" method="post">
    	<input type="hidden" name="edit_id" id="edit_id" value="">
      <div class="form-grid">
        <div class="col-md-4">
        	<div class="form-group  col-md-12">
            <label class="">Warning</label>
            <select id="" class="warning_select warning_select-2 form-control col-md-8" name="warning" id="warning" data-placeholder="Select Warning">
              <option value="">--Select Warning--</option>
              <?php
                if(get_minlevel())
                {
                  foreach (get_minlevel() as $key => $value)
                  {
                    ?>
                      <option <?php if($data['edit_id']==$value['id']){?> selected <?php }?>
                        value="<?=$value['id']?>"><?=$value['warning_name']?></option>
                    <?php
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group  col-md-12 <?php echo (form_error('form'))?'error':'';?>" data-error="<?php echo (form_error('form'))? strip_tags(form_error('form')):'';?>">
            <label required="">Form</label>
            <select id="" class="select2_sample2 form-control col-md-8" name="form" id="form" data-placeholder="Select Form">
              <option value="">--Select Form--</option>
              <?php
                if(get_forms())
                {
                  foreach (get_forms() as $key => $value)
                  {
                    ?>
                      <option <?php if($data['form']==$value['id']){?> selected <?php }?>
                        value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group  col-md-12 <?php echo (form_error('packaging'))?'error':'';?>" data-error="<?php echo (form_error('packaging'))? strip_tags(form_error('packaging')):'';?>">
            <label required="">Packaging</label>
            <select id="" class="select2_sample2 form-control col-md-8" name="packaging" id="packaging" data-placeholder="Select Packaging">
              <option value="">--Select Packaging--</option>
              <?php
                if(get_packages())
                {
                  foreach (get_packages() as $key => $value)
                  {
                    ?>
                      <option <?php if($data['packaging']==$value['id']){?> selected <?php }?>
                        value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php
                  }
                }
              ?>
            </select>
          </div>
          <div class="form-group  col-md-12 <?php echo (form_error('color'))?'error':'';?>" data-error="<?php echo (form_error('color'))? strip_tags(form_error('color')):'';?>">
            <label required="">Color</label>
            <select id="" class="select2_sample2 form-control col-md-8" name="color" id="color" data-placeholder="Select Color">
              <option value="">--Select Color--</option>
              <?php
                if(get_colors())
                {
                  foreach (get_colors() as $key => $value)
                  {
                    ?>
                      <option <?php if($data['color']==$value['id']){?> selected <?php }?>
                        value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php
                  }
                }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group col-md-8 <?php echo (form_error('name'))?'error':'';?>" data-error="<?php echo (form_error('name'))? strip_tags(form_error('name')):'';?>">
            <label required="">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="<?=$data['name'];?>">
          </div>
          <div class="form-group col-md-8 <?php echo (form_error('message'))?'error':'';?>" data-error="<?php echo (form_error('message'))? strip_tags(form_error('message')):'';?>">
            <label required="">Message</label>
            <textarea  name="message" class="form-control" id="message"><?=$data['message'];?></textarea>
          </div>
          <div class="clearfix"></div>
          <div class="form-group  col-md-8 <?php echo (form_error('product'))?'error':'';?>" data-error="<?php echo (form_error('product'))? strip_tags(form_error('product')):'';?>">
            <label required="" class="">Product</label>
            <select class="select2_sample2 form-control col-md-8" name="product" id="product" data-placeholder="Select Product">
              <option value="">--Select Product--</option>
              <?php
                if(get_products())
                {
                  foreach (get_products() as $key => $value)
                  {
                    ?>
                      <option <?php if($data['product']==$value['id']){?> selected <?php }?>
                        value="<?=$value['id']?>"><?=$value['name']?></option>
                    <?php
                  }
                }
              ?>
            </select>
          </div>
          <div class="clearfix"></div>
         <!--  <div class="form-group col-md-4">
            <label required="">Name</label>
            <input type="text" name="po_id" class="form-control" id="name" value="">
          </div>
          <div class="clearfix"></div>
         	<div class="form-group col-md-4">
            <label required="">Name</label>
            <input type="text" name="po_id" class="form-control" id="name" value="">
          </div> -->
          <div class="clearfix"></div>
          <div class="form-group col-md-6 <?php echo (form_error('quantity'))?'error':'';?>" data-error="<?php echo (form_error('quantity'))? strip_tags(form_error('quantity')):'';?>">
            <label required="">Quantity</label>
            <input type="text" name="quantity" class="form-control" id="quantity" value="<?=$data['quantity']?>">
          </div>
          <div class="form-group col-md-2">
          	<label>&nbsp;</label>
           	<select class="form-control" name="dropdown">
           		<?php
           			if(get_operator())
           			{
           				foreach (get_operator() as $key => $value)
           				{
  	         				?>
  	         					<option <?php if($data['dropdown']==$value['id']){?> selected <?php }?>
                       value="<?=$value['id'];?>"><?=$value['operator'];?></option>
    	       				<?php
    	       			}
    	       		}
           		?>
           	</select>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-2">
        	<button type="button" class="btn btn-block del-minlevel">Delete Warning</button>
        </div>
        <div class="form-group col-md-2">
        	<button type="button" class="btn btn-block add-new-dropdown">Add New</button>
        </div>
        <div class="form-group col-md-2">
        	<button type="submit" class="btn btn-block">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>