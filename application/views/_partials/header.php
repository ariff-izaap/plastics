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
          $curr_ctlr =  $this->uri->segment(1, 'index');
          $child_ctlr = $this->uri->segment(2, 'index');
        ?>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           <li <?php echo ($curr_ctlr == 'dashboard')?'class="active"':'';?> >

              <a href="<?=site_url('dashboard');?>">
                <i class="fa fa-dashboard fa-fw"></i> 
                  Dashboard
              </a>
            </li>
            <?php if($role=="2" || $role=="1"){?>
            <li <?php echo ($curr_ctlr == 'organization')?'class="active"':'';?> >
              <a href="<?=site_url('');?>">
                 <i class="fa fa-clock-o fa-fw"></i>
                  Sales
              </a> 
            </li>
            <?php }?>
            <?php if($role=="3" || $role=="1"){?>
            <li <?php echo ($curr_ctlr == 'employee')?'class="active"':'';?> >
              <a href="<?=site_url('');?>">
                 <i class="fa fa-cubes fa-fw"></i>
                  Purchase
              </a>  
            </li>
            <?php }?>
            <?php if($role=="4" || $role=="1"){?>
             <li class="dropdown <?php echo ($curr_ctlr == 'inventory') ? "active":'';?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-database fa-fw"></i> 
                  Inventory 
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url();?>inventory">Product</a></li>
                <li><a href="<?php echo site_url();?>inventoryform">Product Form</a></li>
                <li><a href="<?php echo site_url();?>inventorycolor/">Product Color</a></li>
                <li><a href="<?php echo site_url();?>inventorytype">Product Types</a></li>
                <li><a href="<?php echo site_url();?>inventorypackage">Product Packages</a></li>                    
              </ul>
            </li>
            <?php }?>
            <?php if($role=="5" || $role=="1"){?>
            <li <?php echo ($curr_ctlr == 'timesheet')?'class="active"':'';?> >
              <a href="<?=site_url('');?>">
                <i class="fa fa-usd fa-fw"></i> 
                  Accounting
              </a>
            </li>
            <?php }?>
            <?php if($role=="1"){?>
            <li class="dropdown <?php echo ($curr_ctlr == 'admin') ? "active":'';?>">
              <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-eye fa-fw"></i> 
                  Admin 
                  <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="<?php echo ($child_ctlr == 'general_dropdowns') ? "active":'';?>">
                  <a href="<?=site_url();?>/admin/general_dropdowns">General Dropdowns</a>
                </li>
                <li class="<?php echo ($child_ctlr == 'user_setup') ? "active":'';?>">
                  <a href="<?=site_url();?>/admin/user_setup">User Setup</a>
                </li>
              </ul>
            </li>
            
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
              <li <?php echo ($curr_ctlr == 'timesheet')?'class="active"':'';?> >
              <a href="<?=site_url('timesheet');?>">
                <i class="fa fa-search fa-fw"></i> 
                  Search
              </a>
            </li>
            <?php }?>            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
                <div class="user-pic">
                    <img src="<?php echo include_img_path();?>default-user.jpg" alt="Independent Plastics" />
                  
                  <div class="dropdown custom-dropdwon">
                    <button class="dropbtn"> <i class="fa fa-gear"></i></button>
                      <div id="userSettings" class="dropdown-content" align="right">
                      <a href="<?=site_url('history');?>">Site History</a>
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
      
     