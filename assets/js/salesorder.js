/** Start to Punitha */
function change_ship_addr(action_type, ship_addr_id, sales_order_id, elm)
{
	action_type = action_type?action_type:'form';
	
	if(!before_ajax(elm, 'Loading....'))
		return false;
	
	data = {};
	if(action_type == 'process')
		data = $("#div_add_new_price form").serialize();
	
	ship_addr_id = parseInt(ship_addr_id);
	
	$.ajax( {
        url:base_url+'salesorder/change_ship_address/'+ship_addr_id+'/'+sales_order_id+'/'+action_type,
        type: "POST",
        data: data,
        dataType:"json",
        success : function(rdata){
        	
        	if(!after_ajax(elm, rdata))
        		return false;
        	
        	if(rdata.status == 'warning'){
        		$("#div_add_new_price .modal-body").html(rdata.content);
            	$("#div_add_new_price").css('width', '800px').addClass("show").removeClass('hide');
                $("#div_add_new_price").modal();
        	}
        	else if(rdata.status == 'success' && action_type == 'process')
        	{
        		$("#div_add_new_price").modal('hide');
        		        		
        		bootbox.alert(rdata.message, function(){
        			if(ship_addr_id)
        			location.href = base_url+'salesorder/view/'+sales_order_id;
        		});
        	} 
        	else
        	{
        		bootbox.alert(rdata.message);
        	}	
        },
        error : function(rdata) {
         after_ajax(elm, rdata);
        }
	});    
}


function change_billing_addr(action_type, bill_addr_id, sales_order_id, elm)
{
	action_type = action_type?action_type:'form';
	
	if(!before_ajax(elm, 'Loading....'))
		return false;
	
	data = {};
	if(action_type == 'process')
		data = $("#div_addr_billing form").serialize();
	
	bill_addr_id = parseInt(bill_addr_id);
	
	$.ajax( {
        url:base_url+'salesorder/change_billing_address/'+bill_addr_id+'/'+sales_order_id+'/'+action_type,
        type: "POST",
        data: data,
        dataType:"json",
        success : function(rdata){
        	
        	if(!after_ajax(elm, rdata))
        		return false;
        	
        	if(rdata.status == 'warning'){
        		$("#div_addr_billing .modal-body").html(rdata.content);
            	$("#div_addr_billing").css('width', '800px').addClass("show").removeClass('hide');
                $("#div_addr_billing").modal();
        	}
        	else if(rdata.status == 'success' && action_type == 'process')
        	{
        		$("#div_addr_billing").modal('hide');
        		        		
        		bootbox.alert(rdata.message, function(){
        			if(ship_addr_id)
        			location.href = base_url+'salesorder/view/'+sales_order_id;
        		});
        	} 
        	else
        	{
        		bootbox.alert(rdata.message);
        	}	
        },
        error : function(rdata) {
         after_ajax(elm, rdata);
        }
	});    
}


function get_vendor_details(v_url)
{
   $(".purchase-loader").show();
    $.post(base_url+v_url,{},function(data){
    $(".purchase-loader").hide();
    console.log(data);
      $("form#addPurchase #vendor_name").val(data.business_name);
      $("form#addPurchase #bill_name").val(data.b_name);
      $("form#addPurchase #address_1").val(data.address1);
      $("form#addPurchase #address_2").val(data.address2);
      $("form#addPurchase #city").val(data.city);
      $("form#addPurchase #state").val(data.state);
      $("form#addPurchase #zipcode").val(data.zipcode);
      $("form#addPurchase #firstname").val(data.first_name);
      $("form#addPurchase #lastname").val(data.last_name);
      $("form#addPurchase #mobile").val(data.phone);
      $("form#addPurchase #email").val(data.email);
      $("form#addPurchase #website").val(data.web_url);
      $("form#addPurchase #zipcode").val(data.zipcode);
  },'json');
}

function sales_update_cart(action_type,sales_order_id,ftype,elm)
{
    
    action_type = action_type?action_type:'form';
	var atype   =  $("#form_access").val();
    
     $("#item_type").val(ftype); 
     
    action_type = (atype == '')?action_type:atype;
    
	if(!before_ajax(elm, 'Loading....'))
		return false;
	
	data = {};
	if(action_type == 'process')
		data = $("#sales_update_to_cart").serialize();
        
	
	$.ajax({
        url:base_url+'salesorder/update_salesorder_quantity'+'/'+action_type+'/'+sales_order_id,
        type:"POST",
        data:data,
        dataType:"json",
        success : function(rdata){
        	after_ajax(elm, rdata);
            
        //	if(rdata.status == 'warning'){
//        		$("#updat_cart .modal-body").html(rdata.content);
//            	$("#updat_cart").removeClass('hide');
//                $("#updat_cart").modal();
//                 $("#updat_cart").modal({
//                    backdrop:"static"
//                 });
//                $("#form_access").val("process");
//                if(rdata.itemtype == 'cart'){
//                   $("#item_type").val("cart"); 
//                }
//                $("#product_shipping_lists").html(rdata.content);
//                
//        	}
//        	else 
            if(rdata.status == 'success' && action_type == 'process')
        	{
        	   bootbox.alert(rdata.message);
        		$("#div_addr_billing").modal('hide');
                $("#updat_cart").modal('hide');
        		$("#updated_cart_items").html(rdata.content);
                if(sales_order_id !='cartitem')
                   location.href = base_url+"salesorder/view/"+sales_order_id; 
                
        	} 
        	else
        	{
        		bootbox.alert(rdata.message);
                $("#updated_cart_items").html(rdata.content);
        	}	
        },
        error : function(rdata) {
         after_ajax(elm, rdata);
        }
	}); 
    
 
}


function update_sales_status(so_id)
{
    var carrier = $("#carrier").val();
    var ordstat = $("#order_status").val();
    var fdata = {carrier:carrier,order_status:ordstat};
    
    $.ajax({
        url:base_url+'salesorder/update_ord_status/'+so_id,
        type: "POST",
        data: fdata,
        dataType:"json",
        success : function(rdata){
        	bootbox.alert(rdata.message);
        },
        error : function(data) {
         alert('error');
        }
	});
}

function get_sales_items(sales_order_id)
{
    	$.ajax({
        url:base_url+'salesorder/_get_products_details/'+sales_order_id,
        type: "POST",
        data: {},
        dataType:"json",
        success : function(rdata){
        	$("#order_item_view").html(rdata.content);
        },
        error : function(data) {
         alert('error');
        }
	});
}

function sales_order_update_quantity(sale_item_id,so_id)
{
    var qty  = $("#update_qty").val();
    
    if(!before_ajax(elm, 'Loading....'))
		return false;
        
   $.ajax({
    type:"POST",
    url:base_url+'salesorder/update_salesorder_quantity',
    data:{id:sale_item_id,so_id:so_id,quantity:qty},
    dataType:"json",
    success:function(data)
    {
        if(!after_ajax(elm, rdata))
      		  return false;
                
      var status = data.status;   
      if(status == 'success'){
        $("#cartItems").html(data.viewlist);
        $(window).scrollTop($('#cartItems').offset().top);
      }
    }  
  });
}

function show_logs(key, val)
{
	$.ajax( {
        url:base_url+current_controller+'/get_logs/'+key+'/'+val,
        type: "POST",
        data: {},
        dataType:"json",
        success : function(rdata){
        	var obj = $("#logs_list");
        	obj.html(rdata.listing);	
        	//obj.focus();
            scroll_to("logs_list");
            
        	$('#logs_table').fixedHeaderTable({	autoShow: false, altClass: 'odd', height:'550px'});
        	$('#logs_table').fixedHeaderTable('show', 1000);
        },
        error : function(data) {
         alert('error');
        }
	});
	
}


function add_note(type, id)
{
	var hl = '<form id="note_form" method="post"> '+
						'<div class="modal-header"> '+
        					'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> '+
        					'<h3 id="myModalLabel">Add Note</h3> '+
						'</div> '+		      
						'<div class="modal-body" style="height:60%;overflow:auto"> '+
                            '<input type="hidden" name="line" id="line" value="'+type+'">'+
							'<input type="hidden" name="action_id" id="action_id" value="'+id+'">'+
							'<textarea id="note-body" name="message" class="form-group"></textarea>'+	
						'</div>'+
						'<div class="modal-footer">'+
							'<a href="javascript:;" class="btn btn-primary" onclick="save_notes(this);">submit</a>'+
							'<button class="btn" data-dismiss="modal" aria-hidden="true" id="modal_close">Close</button>'+
						'</div>'+
					'</form>';
	
    $("#div_add_note .modal-body").html(hl);
	$("#div_add_note").css({width:'800px',display:"block !important"}).removeClass('hide');
    $("#div_add_note").modal({
         backdrop:"static"
    });
    $("#div_add_note").show();
}

function save_notes(elm)
{
	if(!before_ajax(elm, 'saving....'))
		return false;
	
	$("#note-body").val();
	
	$.ajax( {
        url:base_url+'note/save',
        type: "POST",
        data: $("#note_form").serialize(),
        dataType:"json",
        success : function(rdata){
        	after_ajax(elm, rdata);
        	if(rdata.status == 'error')
    			alert(rdata.message);
    		else
    		{
    			//if successfully added, show it in list-view
    			show_notes(rdata.key, rdata.val);
    			alert('successfully added.');
    			$("#div_add_note #modal_close").trigger('click');          
                scroll_to("notes_list");      
    		}
        },
        error : function(data) {
         after_ajax(elm);
        }
	});
	
}

function show_notes(key, val)
{
	$.ajax( {
        url:base_url+current_controller+'/get_notes/'+val,
        type: "POST",
        data: {},
        dataType:"json",
        success : function(rdata){
        	var obj = $("#notes_list");
        	obj.html(rdata.listing);	
        	obj.focus();
        },
        error : function(data) {
         alert('error');
        }
	});	
}

function product_add_to_shipment(prod_id,prod_name,prod_sku)
{
   //  if($("#selectAll-"+prod_id).prop('checked') == true){
        //    $("#selectAll-"+prod_id).attr("checked","checked");
            var price = $("#addcart"+prod_id).attr("data-price");
            var qty   = $("#addcart"+prod_id).attr("data-qty");
            
            $("#price").val(price);
            $("#quantity_available").val(qty);
            $("#cancel").attr("data-pid",prod_id); 
            $("#product_id").val(prod_id);
            var pd = "<p><b>Product Name:</b> "+prod_name+"</p><br /> <p><b>SKU: </b>"+prod_sku+"</p>";
            $("#prod_details").html(pd);
            $("#product_ship").modal({
                  backdrop: 'static',
                  keyboard: false 
            });
           $("#product_ship").show();
      //  }
}


function sales_prod_add_to_cart(type)
{
    var ord_qty ='', qty= '', pid= '', fdata = '', ids ='', apd_open='', apd_close='';
    
      if(type == 'single'){
             fdata   = $("#sales_add_to_cart").serialize();
             qty     = parseInt($("#quantity_available").val());
             ord_qty = parseInt($("#quantity_to_order").val());
             pid     = $("#product_id").val();
            
              if(ord_qty == ''){
                alert("Quantity should not be empty");
                $("#quantity_to_order").val('');
                $("#quantity_to_order").focus();
                $("#selectAll-"+pid).removeAttr("checked");
                return false;
             }
             else if(qty<ord_qty){
                alert("Quantity should be less than available quantity");
                $("#quantity_to_order").val('');
                $("#quantity_to_order").focus();
                $("#selectAll-"+pid).removeAttr("checked");
                return false;
            }
    
       }
       else
       {
            $(document).find(".checkbox:checked").each(function(){ 
                ids += (ids)?','+$(this).val():$(this).val();
           });
           
           if(ids == ''){
             bootbox.alert("Please select product to add cart");
             return false;
           }
           fdata = {ids:ids,type:type};
       }
    //alert(ids);
    if(ord_qty!='' || ids !=''){
        $.ajax({
              url:base_url+"salesproductselection/add_to_cart",
              type:"POST",
              data:fdata,
              dataType:'json',
              success:function(res)
              {
                var status = res.status;
                var output = res.output;      
                if(status == 'success'){
                    bootbox.alert(res.message);
                   
                      apd_open = ($("#sales_update_to_cart").length == 0)?'<form name="sales_update_to_cart" id="sales_update_to_cart">':"";
                      apd_close = ($("#sales_update_to_cart").length == 0)?'</form>':"";
                    
                   $("#product_shipping_lists").html(apd_open+res.viewlist+apd_close);
                   
                   var pd_id = $("#cancel").attr("data-pid");
                    modal_close(pd_id);
                    $("#selectAll-"+pd_id).removeAttr("checked");
                    $(window).scrollTop($('#product_shipping_lists').offset().top);
                }
                else
                {
                  $("#inventory_add_section").html(output); 
                }
              }
          });
    }  
}

function delete_cartt(cart_id='',type='')
{   
    var ids = '';
    if(cart_id == ''){
        
        $(document).find(".cart_checkbox:checked").each(function(){ 
           ids += (ids)?','+$(this).val():$(this).val();
        });
        
        cart_id = ids;
    }
    else
    {
        cart_id = cart_id;
    }
    
  $.ajax({
    type:"POST",
    url:base_url+'salesproductselection/delete_cart',
    data:{id:cart_id,type:type},
    dataType:"json",
    success:function(data)
    {
      var status = data.status;
      var output = data.output;      
      if(status == 'success'){
        $("#product_shipping_lists").html(data.viewlist);
        $("#cartItems").html(data.viewlist);
        $("#updat_cart .modal-body").html(data.viewlist);
        $(window).scrollTop($('#product_shipping_lists').offset().top);
      }
    } 
  });
}

/** End to Punitha */