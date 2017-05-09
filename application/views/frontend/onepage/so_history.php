<div class="modal-dialog modal-lg">
<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title col-md-3">SO History</h4>
    <div class="col-md-2 pull-right">
				<button class="create-new-so btn btn-warning pull-right">Create SO</button>
			</div>
  </div>
  <div class="modal-body">
  	<?php 
  		if(isset($order_st) && $order_st=="created")
  		{
  			?>
  			<div class="alert alert-success">
					<button class="close" data-dismiss="alert">&times;</button>
		  		Sales Order created successfully.
				</div>
				<?php
			}
			?>
		<div class="row">
			<div class="col-md-12" style="max-height: 400px;overflow: auto;">
				<table class="table table-hover table-bordered">
					<thead>
						<th>SO ID</th><th>Status</th><th>Amount</th><!-- <th>Paid Status</th> --><th>Ordered Date</th><!--<th>Action</th>-->
					</thead>
					<tbody>
						<?php
						if($so)
						{
							foreach ($so as $key => $value)
							{
								?>
									<tr onclick="view_so(<?=$value['id'];?>);">
										<td><?=$value['id'];?></td>
										<td><?=$value['order_status'];?></td>
										<td><?=displayData($value['total_amount'],'money');?></td>
										<!-- <td><?=$value['is_paid'];?></td> -->
										<td><?=$value['created_date'];?></td>
										<!-- <td>
											<button data-id="<?=$value['id'];?>" class="btn btn-info view_so"><i class="fa fa-eye"></i> View</button>
										</td> -->
									</tr>
								<?php
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
    </div>
  </div>
</div>
</div>
<style type="text/css">
	table tbody tr:hover{background: #ccc !important;cursor: pointer;}
</style>

<script type="text/javascript">
	function view_so()
	{
		$("#SOHistory").modal('hide');
		so_id = $(this).attr("data-id");
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_so_details',
			data:{so_id:so_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#SOProcess").html(data.content);
			}
		});
	}

	$(".create-new-so").click(function(){
		c_id = $(".customer_id").val();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/create_new_so',
			data:{c_id:c_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#SOProcess").html(data.content);
			}
		});
	});
</script>