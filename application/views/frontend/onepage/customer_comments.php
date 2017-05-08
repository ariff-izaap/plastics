<div class="modal-dialog modal-lg">
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Customer Comments</h4>
    </div>
    <div class="modal-body" style="max-height: 450px;overflow: auto;">
    	<?php
    		if(isset($cmt_st) && $cmt_st=="created")
    		{
    			?>
    			<div class="alert alert-success alert-dismissable">
		    		<button class="close" data-dismiss="alert">&times;</button>
		    		Comments inserted successfully.
		    	</div>
		    	<?php
		    }
		  ?>
    	<div class="row">
    		<div class="col-md-12">
    			<div class="form-group">
    				<label>Comments</label>
    				<textarea class="form-control comment"></textarea>
    			</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-12">
    			<table class="table table-hover table-bordered">
    				<thead>
    					<th width="20">SNO</th>
    					<th>Comments</th>
    				</thead>
    				<tbody>
    					<?php
    						if($comments)
    						{
    							$cmt = explode(';',$comments['comments']);
    							$i=1;
    							foreach ($cmt as $value)
    							{
    								if($value!='')
    								{
    								?>
    								<tr>
    									<td><?=$i++;?></td>
    									<td><?=$value;?></td>
    								</tr>
    								<?php
    								}
    							}
    						}
    					?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
    <div class="modal-footer">
      <div class="col-md-2 pull-right">
        <button data-dismiss="modal" class="btn btn-danger pull-right">Close</button>
        <button class="btn btn-warning save-comments pull-left">Save</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(".save-comments").click(function(){
		c_id = $(".customer_id").val();
		comment = $(".comment").val();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/add_comments',
			data:{c_id:c_id,comment:comment},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#CustomerComments").html(data.content);
			}
		});
	});
</script>