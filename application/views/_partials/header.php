<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Image</h4>
      </div>
      <span id="success_msg" style="color: red; font-weight:bold;font-size:16px; text-align:center;"></span>
      <div class="modal-body">
        <div class="form-group">
          <label>Image Title</label>
          <input type="text" name="image_title" class="form-control" id="image_title"  placeholder="Image Title" />
        </div>
        
       <div class="form-group">
		    <input id="product_upload_image" name="product_upload_image" type="file" class="file" />
		    <input type="hidden" name="file_name" id="file_name" value="<?php //echo set_value('file_name', $editdata['file_name']);?>" />
            <?php //echo form_error('file_name', '<span class="help-block">', '</span>'); ?>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>  

<section class="container-fluid">
  <div class="row top-nav">
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
          
            <img src="<?php echo include_img_path();?>logo_new.png" alt="Independent Plastics" />
          </a>
        </div>
        <?php 
          $role = get_user_role();
          $rights = get_user_access_rights($role);
          $menu = json_decode($rights['menu_id']);
          $curr_ctlr =  $this->uri->segment(1, 'index');
          $child_ctlr = $this->uri->segment(2, 'index');
        ?>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <?php if($menu->dashboard==1){?>
           <li <?php echo ($curr_ctlr == 'dashboard')?'class="active"':'';?> >
              <a href="<?=site_url('dashboard');?>">
                <i class="fa fa-dashboard fa-fw"></i> 
                  Dashboard
              </a>
            </li>
          <?php }?>
          <?php if($menu->sales==1){?>
          <li <?php echo ($curr_ctlr == 'salesorder')?'class="active"':'';?> >
               <!-- <a href="#"> -->
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-clock-o fa-fw"></i>
                  Sales
                  <span class="caret"></span>
                </a> 
                <ul class="dropdown-menu">
                <li><a href="<?php echo site_url();?>salesorder/search">Search</a></li>
                <li><a href="<?php echo site_url();?>salesorder/calllog">Call Log</a></li>
                <li><a href="<?php echo site_url();?>salesorder/callback">Call Back</a></li>
                <li><a href="<?php echo site_url();?>salesproductselection">Product Selection</a></li>
                <li><a href="<?php echo site_url();?>salesorder/shippingorder">Shipping Order</a></li>
               </ul>
            </li>
          <?php }?>
          <?php if($menu->purchase==1){?>  
            <li class="dropdown <?php echo ($curr_ctlr == 'purchase')? "active":'';?>">
              <a href="javascript:void(0);"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-cubes fa-fw"></i>
                  Purchase
                  <span class="caret"></span>
              </a>
               <ul class="dropdown-menu">
                  <li><a href="<?php echo site_url('purchase/add_edit_purchase');?>">Create Purchase Order</a></li>
                  <li><a href="<?php echo site_url('purchase');?>">Purchase Order</a></li>
                  <li><a href="<?php echo site_url('purchase/min_level');?>">Min Level</a></li>
                </ul>
            </li>
            <li class="dropdown <?php echo ($curr_ctlr == 'inventory' || $curr_ctlr == 'category') ? "active":'';?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-database fa-fw"></i>
                  Inventory
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url();?>inventory">Product</a></li>
                <li <?php echo ($curr_ctlr == 'category')?'class="active"':'';?> >
                    <a href="<?=site_url('category');?>"> Categories</a>
                </li>
                <!--
                <li><a href="<?php //echo site_url();?>inventoryform">Product Form</a></li>
                <li><a href="<?php //echo site_url();?>inventorycolor/">Product Color</a></li>
                <li><a href="<?php // site_url();?>inventorytype">Product Types</a></li>
                <li><a href="<?php //echo site_url();?>inventorypackage">Product Packages</a></li>-->
               </ul>
            </li>
            <?php }?>
            <?php if($menu->inventory==1){?>
            <li class="dropdown <?php echo ($curr_ctlr == 'accounting') ? "active":'';?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-dollar fa-fw"></i>
                  Accounting
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo ($child_ctlr == 'shipping_orders') ? "active":'';?>">
                  <a href="<?=site_url('accounting/shipping_orders');?>">Shipping Orders</a>
                </li>
                <li class="<?php echo ($child_ctlr == 'invoices') ? "active":'';?>">
                  <a href="<?=site_url('accounting/invoices');?>">Invoices</a>
                </li>
              </ul>
            </li>
            <?php }?>
            <?php if($menu->admin==1){?>
            <li class="dropdown <?php echo ($curr_ctlr == 'admin') ? "active":'';?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-eye fa-fw"></i>
                  Admin
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo ($child_ctlr == 'roles') ? "active":'';?>">
                  <a href="<?=site_url('admin/roles');?>">Roles</a>
                </li>
                <li class="<?php echo ($child_ctlr == 'access_level') ? "active":'';?>">
                  <a href="<?=site_url('admin/access_level');?>">Access Levels</a>
                </li>
                <li class="<?php echo ($child_ctlr == 'general_dropdowns') ? "active":'';?>">
                  <a href="<?=site_url();?>/admin/general_dropdowns">General Dropdowns</a>
                </li>
                <li class="<?php echo ($child_ctlr == 'user_setup') ? "active":'';?>">
                  <a href="<?=site_url();?>/admin/user_setup">User Setup</a>
                </li>
                <li <?php echo ($curr_ctlr == 'warehouse')?'class="active"':'';?> >
                  <a href="<?=site_url('warehouse');?>">
                      Warehouse
                  </a> 
                </li>
                <!-- <li <?php echo ($curr_ctlr == 'vendor')?'class="active"':'';?> >
                  <a href="<?=site_url('vendor');?>">
                      Vendors
                  </a> 
                </li>
                <li <?php echo ($curr_ctlr == 'address')?'class="active"':'';?> >
                  <a href="<?=site_url('address/add');?>">
                      Address
                  </a> 
                </li> -->
              </ul>
            </li>
            <?php }?>
            <?php if($menu->reports==1){?>
            <li class="dropdown">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-pie-chart fa-fw"></i>
                  Reports
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);">Sales Reports</a></li>
              </ul>
            </li>
            <?php }?>
            <li <?php echo ($curr_ctlr == 'timesheet')?'class="active"':'';?> >
              <a href="<?=site_url('timesheet');?>">
                <i class="fa fa-search fa-fw"></i>
                  Search
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <div class="user-pic">
                <img src="<?php echo include_img_path();?>default-user.jpg" alt="Independent Plastics" />
                <div class="dropdown custom-dropdwon">
                  <button class="dropbtn"> <i class="fa fa-gear"></i></button>
                    <div id="userSettings" class="dropdown-content" align="right">
                    <?php if($role=="1"){?>
                      <a href="<?=site_url('history');?>">Site History</a>
                      <!-- <a href="<?=site_url('error_log');?>">Error Logs</a> -->
                    <?php }?>
                    <a href="#">My Profile</a>
                    <a href="#">Settings</a>
                    <a href="<?php echo site_url('login/logout');?>">Sign Out</a>
                    </div>
                </div>
              </div>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  </div>
  <div class="row">
    <aside class="col-sm-12 cf">