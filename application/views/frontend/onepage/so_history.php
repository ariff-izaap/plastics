<div class="row">
	<!-- <div class="col-md-2 pull-right">
		<a href="#" class="btn btn-warning pull-right">Create SO</a>
	</div> -->
</div><br>
<div class="row">
	<div class="col-md-12" style="max-height: 400px;overflow: auto;">
		<table class="table table-hover table-bordered">
			<thead>
				<th>SO ID</th><th>Status</th><th>Amount</th><!-- <th>Paid Status</th> --><th>Ordered Date</th><th>Action</th>
			</thead>
			<tbody>
				<?php
				if($so)
				{
					foreach ($so as $key => $value)
					{
						?>
							<tr>
								<td><?=$value['id'];?></td>
								<td><?=$value['order_status'];?></td>
								<td><?=displayData($value['total_amount'],'money');?></td>
								<!-- <td><?=$value['is_paid'];?></td> -->
								<td><?=$value['created_date'];?></td>
								<td>
									<a href="#SODetails" data-id="<?=$value['id'];?>" data-toggle="modal"  class="btn btn-info view_so">
										<i class="fa fa-eye"></i> View</a>
								</td>
							</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(".view_so").click(function(){
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
				$("#SODetails .modal-body").html(data.content);
			}
		});
	});
</script>