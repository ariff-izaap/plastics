
<section class="container-fluid login-page">
  <div class="row">
    <div class="login-container">
          <div class="avatar"><h1>IP SYSTEM</h1><?php /*?><img src="<?php echo include_img_path();?>logo.png" alt="Independent Plastics"><?php */?></div>
          <div class="form-box">
        <form name="login" method="POST">
          <?php
            $a = isset($_COOKIE['login']) ? json_decode($_COOKIE['login']) : "";
            $uname = isset($a->email) ? $a->email : "";
            $pass = isset($a->password) ? $a->password : "";
          ?>
              <div class="form-group">
                <input name="email" type="text" placeholder="Email" value="<?=$uname;?>">
                <input name="password" type="password" placeholder="Password" value="<?=$pass;?>">
                
                <?php if(validation_errors() || $this->session->flashdata('log_fail1')==TRUE):?>
                <div id="output">
                  <?php echo validation_errors(); ?>

                  <?php if($this->session->flashdata('log_fail1')==TRUE){

                    echo "<p>".$this->session->flashdata('log_fail1')."</p>";

                  }
                  ?>

                </div>
                <?php endif;?>

              </div>
              <div class="form-group">
            <label for="forGot" class="custom-checkbox">Remember me!</label>
            <input type="checkbox" name="forGot" id="forGot">
          </div>
          <button class="btn btn-primary login" type="submit">Login</button>
        </form>
        <div>  </div>
      </div>
    </div>
  </div>
</section>