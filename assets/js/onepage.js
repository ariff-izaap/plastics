$(".customer-search-btn").click(function(){

	salesman = $(".onepage_salesman").val();
	$(".purchase-loader").show();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_customer_salesman',
			data:{sale:salesman},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".purchase-loader").hide();
				$(".ajax_table").html(data.content);
			}
		});
});

$(".product-search-btn").click(function(){
	$(".purchase-loader").show();
	product = $(".product_name").val();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/get_products',
		data:{product:product},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$(".purchase-loader").hide();
			$(".ajax_table").html(data.content);
		}
	});
});

$(".close_po_details").click(function(){
	$("#POHistory").modal('show');
	c_id = $("form#EditPOProduct .vendor_id").val();
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

$(".close_so_details").click(function(){
	$("#SOHistory").modal('show');
	c_id = $("form#EditSOProduct .vendor_id").val();
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


$(".add_po_product_cart_btn").click(function(){
	form = $("#POProductAdd").serialize();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/add_to_product_po',
		data:form,
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			if(data.status=="success")
			$(".succ_msg").html('<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Product added successfully.!</div>');
			$("#PODetails .modal-body table tbody").html(data.cart);
		}
	});
});

$(".add_so_product_cart_btn").click(function(){
	form = $("#SOProductAdd").serialize();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/add_to_product_so',
		data:form,
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			if(data.status=="success")
			$(".succ_msg").html('<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Product added successfully.!</div>');
			$("#SODetails .modal-body table tbody").html(data.cart);
		}
	});
});


	
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

$(".checkout-po").click(function(){
	$("#AddNewPO").hide();
	 vendor_id = $(".po_vendor_id").val();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/checkout_po',
			data:{vendor_id:vendor_id},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#CheckoutPO .modal-body").html(data.content);
			}
		});
});

$(".back-checkout-po").click(function(){
	$("#AddNewPO").show();
	$("#CheckoutPO").modal('close');
});

$(".order-po-btn").click(function(){
		form = $("form#CheckoutPO").serialize();
		$.ajax({
			type:"POST",
			data:form,
			url:base_url+'dashboard/order_po',
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$("#CheckoutPO").hide();
				$("#POHistory").modal('show');
				succ = '<div class="alert alert-success">'+
									'<button class="close" data-dismiss="alert">&times;</button>'+
								  'Purchase Order created successfully.'+
								'</div>';
				$("#POHistory .modal-body").html(succ+data.content);
			}
		});
});