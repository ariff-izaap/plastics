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
						<tr class="customer_row" data-id="<?=$value['customer_id'];?>">
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
	
$("table tbody tr.customer_row").click(function(){
	id = $(this).attr("data-id");
	$(".purchase-loader").show();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/get_customer_by_id',
		data:{id:id},
		dataType:'json',
		success:function(data)
		{
			$(".purchase-loader").hide();
			console.log(data);
			msg = data.message;
			call = data.call;
			$(".customer_name").val(msg.business_name);
			$(".customer_id").val(msg.customer_id);
			$(".customer_phone").val(msg.phone);
			$(".customer_contact").val(msg.customer_contact);
			$(".customer_address").val(msg.address1);
			$(".customer_city").val(msg.city);
			$(".customer_state").val(msg.state);
			$(".customer_zipcode").val(msg.zipcode);
			$(".customer_credit").val(msg.credit_type);
			$(".contact_type").val(msg.contact_type);
			$(".customer_fax").val(msg.contact_value);
			$(".customer_call").val(call.log_date);
		}
	});
});
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