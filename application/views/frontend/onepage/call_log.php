<div class="modal-dialog modal-md">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Call Log</h4>
    </div>
    <div class="modal-body" style="max-height: 450px;overflow: auto;">
    	<div class="succ_msg"></div>
    	<form action="" method="post" id="CallLogForm">
    		<input type="hidden" name="customer_id" value="<?=$customer_id;?>">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="form-group">
    					<label class="col-md-3">Salesman</label>
    					<div class="col-md-6">
    						<select class="form-control input-sm required" name="salesman">
    							<option value="">--Select--</option>
									<?php
										$sales = get_all_users_by_role('2');
										if($sales)
										{
											foreach ($sales as $key => $value)
											{
												?>
													<option value="<?=$value['id'];?>"><?=$value['first_name'];?></option>
												<?php
											}
										}
									?>
    						</select>
    					</div>
    				</div>
    				<div class="clearfix"></div><br>
    				<div class="form-group">
    					<label class="col-md-3">Call Type</label>
    					<div class="col-md-6">
    						<select class="form-control input-sm required" name="call_type">
    							<option value="">--Select--</option>
									<?php
										$type = get_call_type();
										if($type)
										{
											foreach ($type as $key => $value)
											{
												?>
													<option value="<?=$value['id'];?>"><?=$value['name'];?></option>
												<?php
											}
										}
									?>
    						</select>
    					</div>
    				</div>
    				<div class="clearfix"></div><br>
    				<div class="form-group">
    					<label class="col-md-3">Date/Time</label>
    					<div class="col-md-6">
    						<input type="text" name="log_date" class="datetime required form-control">
    					</div>
    				</div>
    				<div class="clearfix"></div><br>
    				<div class="form-group">
    					<label class="col-md-3">Comments</label>
    					<div class="col-md-6">
    						<textarea class="form-control required" name="comments"></textarea>
    					</div>
    				</div>
    			</div>
    		</div>
    	</form>
    </div>
     <div class="modal-footer">
      <div class="col-md-4 pull-right">
        <button data-dismiss="modal" class="btn btn-danger">Close</button>
        <button class="btn btn-warning save-call-log">Save</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	  $('.datetime').daterangepicker({
    singleDatePicker: true,
      timePicker: true,
    showDropdowns: true,
      sautoUpdateInput: false,
    locale: {
      format: 'YYYY-MM-DD HH:mm',
    }
  });

	  $(".save-call-log").click(function(){
	  	valid = true;
	  	form = $("form#CallLogForm").serialize();
	  	elem = $(".required");
	  	$(elem).each(function(e,cur){
	  		if($(cur).val()=='')
	  		{
	  			valid = false;
	  			$(cur).css("border","1px solid red");
	  		}
	  		else
	  		{
	  			$(cur).css("border","1px solid #ccc");	
	  		}
	  	});
	  	if(valid)
	  	{
	  		$.ajax({
	  			type:"POST",
	  			url:base_url+'dashboard/add_call_log',
	  			data:form,
	  			dataType:'json',
	  			success:function(data)
	  			{
	  				console.log(data);
	  				if(data.status=="success")
	  				{
	  					html = '<div class="alert alert-success alert-dismissable">'+
	  									'<button class="close" data-dismiss="alert">&times;</button>'+
	  									'Call Log created successfully.'+
	  								 '</div>';
	  					$("#LogCall .succ_msg").html(html);
	  					$("form#CallLogForm")[0].reset();
	  				}
	  			}
	  		});
	  	}
	  });
  
</script>