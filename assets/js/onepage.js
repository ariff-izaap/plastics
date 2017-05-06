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
				$("#POProcess").html(data.content);
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
				$("#SOProcess").html(data.content);
			}
		});
});





	$(".update_po_cart").click(function(){
		rowid = $(this).attr("data-id");
		rand = $(this).attr("data-row-id");
		qty = $(".qty_"+rand).val();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_po_cart',
			data:{rowid:rowid,qty:qty},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".cart-table table").html(data.cart);
			}
		});
	});


$(".back-checkout-po").click(function(){
	$("#AddNewPO").show();
	$("#CheckoutPO").modal('close');
});


$(".back-checkout-so").click(function(){
	$("#AddNewSO").show();
	$("#CheckoutSO").modal('close');
});


$(".order-so-btn").click(function(){
		form = $("form#CheckoutSO").serialize();
		$.ajax({
			type:"POST",
			data:form,
			url:base_url+'dashboard/order_so',
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				// $("#CheckoutSO").hide();
				// $("#SOHistory").modal('show');
				// succ = '<div class="alert alert-success">'+
				// 					'<button class="close" data-dismiss="alert">&times;</button>'+
				// 				  'Sales Order created successfully.'+
				// 				'</div>';
				// $("#SOHistory .modal-body").html(succ+data.content);
			}
		});
});

$('a[href^="#"]').click(function (event) {
	  event.preventDefault ? event.preventDefault() : event.returnValue = false;
	});