  <div class="row blue-mat">
      <div class="breadcrumbs col-md-12">
        <?php echo set_breadcrumb(); ?>
        <!--<a href="<?php echo $this->previous_url;?>" class="btn btn-sm"><i class="back_icon"></i> Back</a>-->
      </div>
      </div>

  <?php display_flashmsg($this->session->flashdata()); ?>
 
<div class="row-fluid">
    <div >
    <form name="reset_password" method="post">
        <input type="hidden" value="<?php echo $this->uri->segment(4);?>" id="email_user_id" name="email_user_id" />
        <span class="pass_success" style="color: #218c92; font-weight:bold;"></span>
        <br />
        <label>To</label>
        <input type="text" class="form-control" style="width: 200px !important;" id="email_to" name="email_to" value="<?php echo (!empty($form_data['email']))?$form_data['email']:""; ?>" readonly="readonly" />
        <br />
        <label>Name</label>
        <input type="text" class="form-control" id="email_name" style="width: 200px !important;" name="email_name" />
         <br />
        <label>Subject</label>
        <input type="text" class="form-control" id="email_subject" style="width: 200px !important;" name="email_subject" />
         <br />
         <label>Message</label>
         <br /> 
          <textarea class="form-control" id="email_message" style="width: 400px; height:150px;" name="email_message"></textarea>
        <br />
    <input type="button" onclick="send_mail(<?php echo $this->uri->segment(4);?>);" name="email_send" class="btn btn-primary"  value="SAVE" />
  </form>
    </div>
</div>

    

