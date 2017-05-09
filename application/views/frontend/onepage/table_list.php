<table class="table table-bordered">
	<thead>
		<th>Customer Name</th><th>Phone</th><th>Contact</th><th>City</th><th>Email</th>
	</thead>
	<tbody>
		<?php
			if($vendors)
			{
				foreach ($vendors as $key => $value)
				{
					?>
						<tr class="customer_row" onclick="get_customer_details(<?=$value['id'];?>);">
							<td><?=$value['business_name'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['contact_value'];?></td>
							<td><?=$value['city'];?></td>
							<td><?=$value['email'];?></td>
						</tr>
					<?php
				}
				?>
				<?php
			}
		?>
	</tbody>
</table>
<style type="text/css">
	table tbody tr{cursor: pointer;}
	table tbody tr:hover{background:#ddd;}
</style>
<script>
$(".po_history_btn").click(function(){
		c_id = $(".customer_id").val();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_po_history',
			data:{c_id:c_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#POHistory .modal-body").html(data.content);
			}
		});
	});

$(".so_history_btn").click(function(){
	c_id = $(".customer_id").val();
	$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_so_history',
			data:{c_id:c_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#SOHistory .modal-body").html(data.content);
			}
		});
});
</script>