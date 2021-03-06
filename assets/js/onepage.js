$(".customer-search-btn").click(function(){

	salesman = $(".onepage_salesman").val();
	customer = $(".customer_name").val();
	$(".create-new-so,.create-new-po,.po_history_btn,.so_history_btn,.log_call,.view_log,.update-cus-btn").addClass("disabled");
	$(".purchase-loader").show();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/get_customer_salesman',
			data:{sale:salesman,customer:customer},
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".purchase-loader").hide();
				$(".ajax_table").html(data.content);
			}
		});
});



$(".create-new-po").click(function(){
	c_id = $(".customer_id").val();
	$("#POProcess").modal('show');
	$("#POProcess .modal-body").html("<div class='text-center'><img src='"+base_url+"/assets/img/default.gif'></div>");
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/create_new_po',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			$("input[name='product_onepage']").prop('checked',false);
			console.log(data);
			$("#POProcess").html(data.content);
			$(".cart-table table").html(data.cart);
		}
	});
});


$(".create-new-so").click(function(){
	c_id = $(".customer_id").val();
	$("#SOProcess").modal('show');
	$("#SOProcess .modal-body").html("<div class='text-center'><img src='"+base_url+"/assets/img/default.gif'></div>");
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/create_new_so',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			$("input[name='product_onepage']").prop('checked',false);
			console.log(data);
			$("#SOProcess").html(data.content);
			$(".cart-table table").html(data.cart);
		}
	});
});


$(".product-search-btn").click(function(){
	$("form#InventoryForm button.product-update-btn").addClass("disabled");
	$(".purchase-loader").show();
	product = $(".product_name").val();
	sku = $(".product_sku").val();
	form = $(".product_form").val();
	color = $(".product_color").val();
	row = $(".product_row").val();
	type = $(".product_type").val();
	package = $(".product_package").val();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/get_products',
		data:{product:product,sku:sku,form:form,color:color,row:row,type:type,package:package},
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
			$("#POProcess .modal-body table.product-cart tbody").html(data.cart);
			$("#POProcess .modal-body table.product-cart tfoot td.cart-total").html(data.cart_total);
			$("#POProcess .modal-body span.order_total").html(data.cart_total);
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
			$("#SOProcess .modal-body table.product-cart tbody").html(data.cart);
			$("#SOProcess .modal-body table.product-cart tfoot td.cart-total").html(data.cart_total);
			$("#SOProcess .modal-body span.order_total").html(data.cart_total);
		}
	});
});


function get_customer_details(id)
{
	$(".purchase-loader").show();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/get_customer_by_id',
		data:{id:id},
		dataType:'json',
		success:function(data)
		{
			$("a.disabled").removeClass("disabled");
			$(".purchase-loader").hide();
			console.log(data);
			msg = data.message;
			call = data.call;
			$(".customer_name").val(msg.business_name);
			$(".customer_id").val(msg.customer_id);
			$(".address_id").val(msg.address_id);
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
			$(".customer_comments").val(msg.comments);
		}
	});
}

function get_product_details(id)
{
	$(".purchase-loader").show();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/get_product_by_id',
		data:{id:id},
		dataType:'json',
		success:function(data)
		{
			$("form#InventoryForm button.disabled").removeClass("disabled");
			$(".purchase-loader").hide();
			console.log(data);
			msg = data.message;
			$(".product_sku").val(msg.sku);
			$(".product_id").val(msg.product_id);
			$(".product_name").val(msg.product_name);
			$(".product_qty").val(msg.quantity);
			$(".product_form").val(msg.form);
			$(".product_color").val(msg.color_id).trigger('change');
			$(".product_row").val(msg.row);
			$(".product_type").val(msg.type);
			$(".product_eq").val(msg.equivalent);
			$(".product_units").val(msg.units);
			$(".product_package").val(msg.packaging);
			$(".product_wholeprice").val(msg.wholesale_price);
			$(".product_retailprice").val(msg.retail_price);
			$(".product_ref").val(msg.ref_no);
			$(".product_notes").val(msg.notes);
		}
	});
}

function update_customer()
{
	form = $("form#CustomerForm").serialize();
	c_id = $(".customer_id").val();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/update_customer',
		data:form,
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			get_customer_details(c_id);
		}
	});
}


function update_product()
{
	form = $("form#InventoryForm").serialize();
	product_id = $(".product_id").val();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/update_product',
		data:form,
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			get_product_details(product_id);
		}
	});
}


$(".po_history_btn").click(function(){
		c_id = $(".customer_id").val();
		if(c_id=='')
		{
			bootbox.alert("Please select any one of the results below.");
			return false;
		}
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
	if(c_id=='')
	{
		bootbox.alert("Please select any one of the results below.");
		return false;
	}
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
		form = $("form#CartPOForm").serialize();
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/update_po_cart',
			data:form,
			dataType:'json',
			success:function(data)
			{
				console.log(data);
				$(".cart-table table").html(data.cart);
			}
		});
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

$("a.customer_comments").click(function(){
	c_id = $(".customer_id").val();
	if(c_id=='')
	{
		bootbox.alert("Please select any one of the results below.");
		return false;
	}
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/customer_comments',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#CustomerComments").html(data.content);
		}
	});
});


$(".log_call").click(function(){
	c_id = $(".customer_id").val();
	if(c_id=='')
	{
		bootbox.alert("Please select any one of the results below.");
		return false;
	}
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/log_call',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#LogCall").html(data.content);
		}
	});
});



$(".view_log").click(function(){
	c_id = $(".customer_id").val();
	if(c_id=='')
	{
		bootbox.alert("Please select any one of the results below.");
		return false;
	}
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/view_log',
		data:{c_id:c_id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#ViewLog").html(data.content);
		}
	});
});
  
function update_logs(id)
{
	$("#LogCall").modal('show');
  $.ajax({
  	type:"POST",
  	url:base_url+'dashboard/update_logs',
  	dataType:'json',
  	data:{id:id},
  	success:function(data)
  	{
  		console.log(data);
  		$("#LogCall").html(data.content);
  	}
  });
}

function save_po_changes(id)
{
	ship = $(".shipment_service").val();
	payment = $(".payment_term").val();
	paid = $(".paid_status").val();
	delivery = $(".delivery_type").val();
	release = $(".release_to_sold").val();

	$.ajax({
		type:"POST",
		url:base_url+'dashboard/save_po_changes',
		data:{ship:ship,payment:payment,paid:paid,delivery:delivery,release:release,id:id},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			html = '<div class="alert alert-dismissable alert-success">'+
								'<button class="close" data-dismiss="alert">&times;</button>'+
								'Sales order has been udpated successfully.'+
							'</div>';
			$("#POProcess").html(data.content);
			$("#POProcess .succ_msg").html(html);
		}
	});

}

function save_so_changes(id)
{
	payment = $(".payment_term").val();
	ship = $(".shipment_service").val();
	delivery = $(".delivery_type").val();
	$.ajax({
		type:"POST",
		url:base_url+'dashboard/update_so_changes',
		data:{id:id,payment:payment,ship:ship,delivery:delivery},
		dataType:'json',
		success:function(data)
		{
			console.log(data);
			$("#SOProcess").html(data.content);
			html = '<div class="alert alert-dismissable alert-success">'+
					'<button class="close" data-dismiss="alert">&times;</button>'+
					'Sales order has been udpated successfully.'+
				'</div>';
			$("#SOProcess .succ_msg").html(html);
		}
	});
}

function remove_so_product(so_id,rowid)
{
  con = confirm("Are you sure want to remove?");
  if(con)
  {
    $.ajax({
	    type:"POST",
	    url:base_url+'dashboard/remove_so_product',
	    data:{rowid:rowid,so_id:so_id},
	    dataType:'json',
	    success:function(data)
	    {
	    	console.log(data);
	      $("#SOProcess").html(data.content);
	    }
	  });
	}
}


function remove_po_product(po_id,rowid)
{
  con = confirm("Are you sure want to remove?");
  if(con)
  {
    $.ajax({
	    type:"POST",
	    url:base_url+'dashboard/remove_po_product',
	    data:{rowid:rowid,po_id:po_id},
	    dataType:'json',
	    success:function(data)
	    {
	    	console.log(data);
	      $("#POProcess").html(data.content);
	    }
	  });
	}
}

function show_logs()
{
	$(".LogDiv").slideToggle();
}

function onepage_product_add(curr='',product_id='',method='')
{
	if(curr.checked === false && cur !== null )
		return false;
	else
	{
		$.ajax({
			type:"POST",
			url:base_url+'dashboard/onepage_product_add',
			data:{product_id:product_id,method:method},
			dataType:'json',
			success:function(data)
			{
				if(method=='listing')
				{
					alert("Product added to cart successfull");
					$(".cart-table #CartPOForm table").html(data.po_cart);
					$(".cart-table #CartSOForm table").html(data.so_cart);
				}

				console.log(data);
			},
			error:function(err)
			{
				console.log(err);
			}
		});
	}
}

