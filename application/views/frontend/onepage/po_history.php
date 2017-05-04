<div class="row">
	<div class="col-md-2 pull-right">
		<a href="#AddNewPO" class="btn create-new-po btn-warning pull-right">Create PO</a>
	</div>
</div><br>
<div class="row">
	<div class="col-md-12" style="max-height: 300px;overflow: auto;">
		<table class="table table-hover table-bordered">
			<thead>
				<th>PO ID</th><th>Status</th><th>Amount</th><th>Paid Status</th><th>Ordered Date</th><th>Action</th>
			</thead>
			<tbody>
				<?php
				if($po)
				{
					foreach ($po as $key => $value)
					{
						?>
							<tr>
								<td><?=$value['id'];?></td>
								<td><?=$value['order_status'];?></td>
								<td><?=displayData($value['total_amount'],'money');?></td>
								<td><?=$value['is_paid'];?></td>
								<td><?=$value['created_date'];?></td>
								<td>
									<a href="#PODetails" data-id="<?=$value['id'];?>" data-toggle="modal" class="btn btn-info view_po"><i class="fa fa-eye"></i> View</a>
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
	$(".view_po").click(function(){
		$("#POHistory").modal('hide');
		po_id = $(this).attr("data-id");
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_po_details',
			data:{po_id:po_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#PODetails .modal-body").html(data.content);
			}
		});
	});

$(".create-new-po").click(function(){
	$("#POHistory").modal('hide');
	$("#AddNewPO").modal('show');
	c_id = $(".customer_id").val();

	$.ajax({
		type:"POST",
		url:base_url+'dashboard/create_new_po',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#AddNewPO").css("display","block");
			$("#AddNewPO .modal-body").html(data.content);
		}
	});
});
</script>