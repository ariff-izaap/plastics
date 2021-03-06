<div class="modal-dialog modal-lg">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title col-md-3">PO History</h4>
      <div class="col-md-2 pull-right">
				<button class="btn create-new-po btn-warning pull-right"><i class="fa fa-plus"></i> Create PO</button>
			</div>
    </div>
    <div class="modal-body">
    	<?php 
    		if(isset($order_st) && $order_st=="created")
    		{
    			?>
    			<div class="alert alert-success">
						<button class="close" data-dismiss="alert">&times;</button>
			  		Purchase Order created successfully.
					</div>
					<?php
				}
				?>
			<div class="row">
				<div class="col-md-12" style="max-height: 300px;overflow: auto;">
					<table class="table table-hover table-bordered">
						<thead>
							<th>PO ID</th><th>Status</th><th>Amount</th><th>Paid Status</th><th>Ordered Date</th><!-- <th>Action</th> -->
						</thead>
						<tbody>
							<?php
							if($po)
							{
								foreach ($po as $key => $value)
								{
									?>
										<tr onclick="view_po(<?=$value['id'];?>)">
											<td><?=$value['id'];?></td>
											<td><?=$value['order_status'];?></td>
											<td><?=displayData($value['total_amount'],'money');?></td>
											<td><?=$value['is_paid'];?></td>
											<td><?=$value['created_date'];?></td>
											<!-- <td>
												<a href="#PODetails" data-toggle="modal" class="btn btn-info"><i class="fa fa-eye"></i> View</a>
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
        <button data-dismiss="modal" class="btn close-po-history btn-danger pull-right">Close</button>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
	table tbody tr:hover{background: #ccc !important;cursor: pointer;}
</style>


<script type="text/javascript">
	function view_po(id)
	{
		$("#POProcess .modal-body").html("<div class='text-center'><img src='"+base_url+"/assets/img/default.gif'></div>");
		po_id = $(this).attr("data-id");
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_po_details',
			data:{po_id:id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#POProcess").html(data.content);
			}
		});
	}

$(".create-new-po").click(function(){
	c_id = $(".customer_id").val();
	$("#POProcess .modal-body").html("<div class='text-center'><img src='"+base_url+"/assets/img/default.gif'></div>");
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/create_new_po',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#POProcess").html(data.content);
			$(".cart-table table").html(data.cart);
		}
	});
});
$(".close-po-history").click(function(){
	$("#POHistory").modal('close');
	$("#POHistory").css('display','none');
});
</script>