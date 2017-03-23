$(function(){
    
    //product selection
 //   $("#sales_product_id").click(function(){
//        
//        var product = $("#sales_product_id").val();
//        //alert(product);
//         $.ajax({
//              url:base_url+"inventory/getproduct/"+product,
//              type:"POST",
//              data:{},
//              dataType:'json',
//              success:function(data)
//              {
//                 var form_id = data.product.form_id;
//                 var pkg_id  = data.product.package_id;
//                 var clr_id  = data.product.color_id;
//                 var pkg_id  = data.product.package_id;
//                 
//                 $('.productform option').each(function() {
//                    if($(this).val() == form_id) {
//                        $(this).prop("selected", true);
//                    }
//                });
//                 
//              }
//        });
//        
//    });
    
  //$('a,button').tooltip();

    $("#sales_order_search").submit(function(){
        
        
    });

	$('.singledate').daterangepicker({
	  singleDatePicker: true,
	  showDropdowns: true,
    sautoUpdateInput: false,
	  locale: {
	    format: 'YYYY-MM-DD',
	  }
	});

 
  
  $('.singledate').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD'));
  });

  $('.singletime').on('apply.datetimepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('hh:mm:ss'));
  });

	init_daterangepicker();

	$('input[id=base-input]').change(function() {
        $('#fake-input').val($(this).val().replace("C:\\fakepath\\", ""));
    });

    $("form#addUser #firstname,form#addUser #lastname").keyup(function(){
      firstname = $("form#addUser #firstname").val();
      lastname = $("form#addUser #lastname").val();
      $("form#addUser #user_id").val(firstname.toUpperCase()+lastname.toUpperCase());
    });
});	


 $('.select2_sample2').select2({
      placeholder: "Select Value",
      allowClear: true
  });

  $("select[name='table_type']").change(function() {
    val = $(this).val();
    $.ajax({
      url:base_url+"admin/get_table_value",
      type:"POST",
      data:{val:val},
      success:function(data)
      {
        $("select[name='table_value_list']").html(data);
      }
    });
  });

  $("select[name='table_value_list']").change(function(){
    $("input[name='table_value']").val($(this).find("option:selected").text());
    $("form#dropdowns input[name='edit_id']").val($(this).val());
  });

   $('.warning_select-2').select2({
      placeholder: "Select Warning",
      allowClear: true,
      }).on('select2:select',function(){
       val = $(this).val();
       $.ajax({
        type:"POST",
        url:base_url+'purchase/get_min_level',
        data:{val:val},
        success:function(data)
        {
          console.log(data);
           data = JSON.parse(data);
          $('.select2_sample2').val(data.product).trigger("change");
          $("form#minLevel input[name='edit_id']").val(data.id);
          $("form#minLevel input[name='name']").val(data.warning_name);
          $("form#minLevel textarea[name='message']").val(data.message);
          $("form#minLevel input[name='quantity']").val(data.quantity);
          $("form#minLevel select[name='dropdown']").val(data.dropdown).trigger("change");
          $("form#minLevel select[name='form']").val(data.form).trigger("change");
          $("form#minLevel select[name='color']").val(data.color).trigger("change");
          $("form#minLevel select[name='packaging']").val(data.packaging).trigger("change");
        }
       });
     }).on("select2:unselect",function(data)
     {
      $("form#minLevel")[0].reset();
      $('.select2_sample2,.warning_select').val(null).trigger("change");
     });

  

  $(".add-new-dropdown").click(function(){
    $("form#dropdowns,form#minLevel")[0].reset();
     //$(".warning_select-2").empty();
  });



  $(".del-minlevel").click(function(){
    con = confirm("Are sure want to delete?");
    id = $("select[name='warning']").val();
    if(con)
    {
      $.ajax({
          url:base_url+"purchase/del_min_level",
          type:"POST",
          data:{id:id},
          success:function(data){
            location.reload();
          }
      });
    }
  });

  $(".del-dropdown").click(function(){
    con = confirm("Are sure want to delete?");
    table = $("select[name='table_type']").val();
    id = $("input[name='edit_id']").val();
    if(con)
    {
      $.ajax({
          url:base_url+"admin/del_table_value",
          type:"POST",
          data:{table:table,id:id},
          success:function(data){
            location.reload();
          }
      });
    }
  });
/*
  $.mockjaxSettings.responseTime = 500;

     $.mockjax({
            url: base_url+'purchase/add_cart',
            response: function (data,xhr) {
                console.log(data,xhr);
            }
        });

   $('#username').editable({
            url: base_url+'purchase/add_cart',
            type: 'text',
            value:'',
            name: 'username',
            title: 'Enter Quantity',
            inputclass:'form-control input-sm',
            showbuttons: 'right',
             validate: function (value) {
                if ($.trim(value) == '') return 'Enter Quantity';
            }
  });


*/


function add_to_cart(b,a,d,f,v)
{
  b=b?b:0;
  d=d?d:"form";
  var e="#"+$(f).attr("id");
  var c=$(e).attr("data-original-title");
  if(d=="form")
  {
    if(!before_ajax(e,"Updating...."))
    {
      return false;
    }
    $.ajax({
      url:base_url+"purchase/form_add_to_cart/"+b+"/"+a+"/"+$(f).attr("id")+"/"+v,
      type:"POST",
      data:{},
      dataType:"json",
      success:function(g){
        console.log(g);
        after_ajax(e,g);
        $(e).removeAttr("data-original-title");
        $(e).popover({
          placement:"top",
          title:'Add to Cart <button type="button" class="close" onclick="$(\''+e+"').popover('hide')\">&times;</button>",
          html:"true",
          content:g.content,
          callback:function(){
            $(e).tooltip("hide");
          }
        });
        $(e).popover("show");
        $("#qty").focus();
        $(e).attr("data-original-title",c);
      },
      error:function(g){
        after_ajax(f,g);
      }
    });
  }
  else
  {
    if(!before_ajax(f,"Updating...."))
    {
      return false;
    }
    b=$("#pid").val();
    a=$("#vid").val();
    e="#"+$("#elm_id").val();
    $.ajax({
      url:base_url+"purchase/add_cart/"+b+"/"+$("#po_id").val()+"/"+$("#qty").val()+"/"+v,
      type:"POST",
      data:{},
      dataType:"json",
      success:function(data){
        console.log(data);
        after_ajax(f,data);
        $(e).popover("hide");
        bootbox.alert(data.message,function() {
               if(data.status=="success")
                  location.reload();
            });
      },
      error:function(g){
        after_ajax(f,g)
      }
    })
  };
}


function update_cart(a)
{
  if(!before_ajax(a,"Updating...."))
  {
    return false;
  }
  $.ajax({
    url:base_url+"purchase/update_cart/",
    type:"POST",
    data:$("#viewCart").serialize(),
    dataType:"json",
    success:function(b){
      console.log(b);
      after_ajax(a,b);
      $("#viewCart table tbody").html(b.content);
      bootbox.alert(b.message)
    },
    error:function(b){
      after_ajax(a,b);
    }
  });
}

function remove_cart(a,b)
{
  if(!before_ajax(b,"Removing...."))
  {
    return false;
  }
  $.ajax({
    url:base_url+"purchase/remove_cart/"+a+"/"+$("#po_id").val(),
    type:"POST",
    data:{},
    dataType:"json",
    success:function(c){
      console.log(c);
      after_ajax(b,c);
      if(c.count=="0")
      {
        bootbox.alert("Your cart is empty.",function(){
          location.href=base_url+"purchase/add_product";  
        });
        
      }
      $("#viewCart table tbody").html(c.content);
      bootbox.alert(c.message);
    },
    error:function(c){
      after_ajax(b,c);
    }
  });
}


function init_daterangepicker(seldate)
{

	var seldate = seldate?seldate:'';

    $('.date_range').daterangepicker({
    	showDropdowns: true,
    	ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
		    format: 'YYYY-MM-DD',
		    separator: " | ",
		},
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),        
		alwaysShowCalendars: true,
		opens: "right"
        
    }, function(start, end, label) {
	  	//console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
	});


	if(seldate){
		var splitdat = seldate.split("|");
		$(".date_range").data('daterangepicker').setStartDate(splitdat[0]);
		$(".date_range").data('daterangepicker').setEndDate(splitdat[1]);
		$(".date_range").data('daterangepicker').updateView();
	}		
}


function init_checkbox(selval)
{
	selval = selval?selval:'';
	if(selval){		
		$.each(selval, function( index, value ) {
			$('#checkbox-'+value).attr('checked', true);
		});	
	}
	$(".checkbox").checkboxradio({ icon: false });
}

function numbersonly(e) 
{
  var unicode=e.charCode? e.charCode : e.keyCode
  if (unicode!=8 && unicode != 46){ //if the key isn't the backspace key (which we should allow)
  if (unicode<48||unicode>57) //if not a number
    {
      if(unicode==8 || unicode==46 || unicode == 37 || unicode == 39)//To  enable tab index in firefox and mac.(TAB, Backspace and DEL from the keyboard)
      return true
        else
      return false //disable key press
    }
  }
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



//to delete selected record from list.
function delete_record(del_url,elm){

	$("#div_service_message").remove();
    
    	retVal = confirm("Are you sure to remove?");

        if( retVal == true ){
            
            $.post(base_url+del_url,{},function(data){
                if(data.status == "success"){
                //success message set.
                service_message(data.status,data.message);
                
                //grid refresh
                refresh_grid();
    
            }
            else if(data.status == "error"){
                 //error message set.
                service_message(data.status,data.message);
            }
            
            },"json");
       } 
}


function create_timesheet(elm)
{
	
	var hour = $("#working_hours").val();
	
	if(!hour){
		alert('Please enter working hours!');
		return false;
	}

	var data = {};

	data = $("#advance_search_form").serialize();

	data += "&hours="+hour;

	$.post(base_url+'timesheet/create',data,function(rdata){
					
		if(rdata.status == 'success'){
			refresh_grid();
			service_message(rdata.status,rdata.message);
		}
		else
		{
			service_message(rdata.status,rdata.message);
		}	

	}, 'json');			
	
}

function edit_timesheet(action_type,edit_id)
{
  
  action_type = action_type?action_type:'form';
  
  data = {};

  if(action_type == 'process')
    data = $("#timesheet_edit").serialize();


  $.post(base_url+'timesheet/edit/'+edit_id,data,function(rdata){
          
      if(rdata.status == 'success')
      {
        $("#TimesheetEdit").modal('hide');
        refresh_grid();
        service_message(rdata.status,rdata.message);
        
      }
      else
      {
        $("#TimesheetEdit").html(rdata.content);
        $("#TimesheetEdit").modal('show');
      } 

  }, 'json');     
  
}

function export_timesheet(type){

	$("#advance_search_form").attr("action",base_url+'/'+current_controller+'/export/'+type);
	$("#advance_search_form").submit();
}

/* refresh grid after ajax submitting form */
function refresh_grid(data_tbl){
     
     data_tbl =(data_tbl)?data_tbl:"data_table";
     var cur_page = $("#base_url").val()+$("#cur_page").val();
     $.fn.init_progress_bar();
     $.fn.display_grid(cur_page,data_tbl);
}

function service_message(err_type,message,div_id){
    
    div_id = (div_id)?div_id:false; 	

    $("#div_service_message").remove();
    
    var str  ='<div id="div_service_message" class="alert alert-'+err_type+' alert-dismissible">';
        str +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
	    str +='<strong>'+capitaliseFirstLetter(err_type)+':&nbsp;</strong>';
	    str += message;
        str +='</div>';
        
        if(div_id){
             $("#"+div_id).html(str);
        }
        else
        {
            $(".blue-mat").after(str);
            scroll_to("div_service_message");
        }
            
}

function scroll_to(jump_id){
    //page scroll
    if(jump_id !=""){
       $(window).scrollTop($('#'+jump_id).offset().top); 
    }
}

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/* Start To Punitha**/
function sales_product_search()
{
    
    var fdata = $("#sales_order_search").serialize();
        
       $.ajax({
          url:base_url+"salesorder/productselection",
          type:"POST",
          data:fdata,
          dataType:'json',
          success:function(res)
          {
             var outpt = res.output;
             $("#sales_prod_select").html('');
             $("#sales_prod_select").html(outpt);
          }
    }); 
}

function product_add_to_shipment(prod_id)
{
//$(".product_to_ship").each(function(){
//       if($(this). prop("checked") == true){
//         prod_id += (prod_id!='')?","+$(this).val():$(this).val();
//      }
//    });
     
    var price = $("#selectAll-"+prod_id).attr("data-price");
    var qty   = $("#selectAll-"+prod_id).attr("data-qty");
   // alert(qty);
   // alert(price);
    
    $("#price").val(price);
    $("#quantity_available").val(qty);
    $("#cancel").attr("data-pid",prod_id); 
    $("#product_id").val(prod_id);
    $('#product_ship').modal();
    $("#product_ship").show();
    //alert(prod_id);
}

function modal_close(pid='')
{
     var pid = $("#cancel").attr("data-pid");
     $("#"+pid).find("label").removeClass("ui-checkboxradio-checked ui-state-active");
     $("#selectAll-"+pid).removeAttr("checked");
     $("#product_ship").hide();
}

function sales_prod_add_to_cart()
{
    
  
    var fdata  = $("#sales_add_to_cart").serialize();
    var qty    = $("#quantity_available").val();
   var ord_qty = $("#quantity_to_order").val();
  
    if(qty<ord_qty){
        alert("Quantity should be less than available quantity");
        $("#quantity_to_order").val('');
        $("#quantity_to_order").focus();
        return false;
    }
    
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
               $("#product_shipping_lists").html(res.viewlist);
               var pd_id = $("#cancel").attr("data-pid");
                modal_close(pd_id);
                $(window).scrollTop($('#product_shipping_lists').offset().top);
            }
            else
            {
              $("#inventory_add_section").html(output); 
            }
          }
      });
}


function inventory_sub()
{
    var fdata   = $("#inventory_sub_form").serialize();
    var edit_id = '';
        edit_id = $("#inventory_sub_form #edit_id").val();

      $.ajax({
          url:base_url+"inventory/add/"+edit_id,
          type:"POST",
          data:fdata,
          dataType:'json',
          success:function(res)
          {
            var status = res.status;
            var output = res.output;      
            if(status == 'success'){
              location.href = base_url+"inventory/add/"+res.edit_id;
            }
            else
            {
              $("#inventory_add_section").html(output); 
            }
          }
    });    
}

function add_vendor_price_lists(action,div_id)
{
    
     var fdata  = $("#form_vendor_add").serialize();
     var edit_id= '';
     
        edit_id = $("#form_vendor_add #edit_id").val();

      $.ajax({
          url:base_url+action,
          type:"POST",
          data:fdata,
          dataType:'json',
          success:function(res)
          {
            var status = res.status;
            var output = res.output;
                
            if(status == 'success'){
              location.href = base_url+"inventory/add/"+res.product_id;
            }
            else
            {
                $("#"+div_id).find("#myModalLabel").html('Add Vendor');
                $("#"+div_id).find(".modal-body").html(res.form_view);
                
                init_modal();
                //$('#'+div_id).modal();
               // $("#"+div_id).show();
               // $("#"+div_id).fadeIn();
            }
            
            
             //var status = res.status;
            // var output = res.output;
            //if(status == 'success') {
//                 $("#inventory_add_section").html(output);
//            }
//            else
//            {
//                $("#inventory_add_section").html(output);                           
//            }
          }
    });    
}


function check_product_id(event)
{
    var product_id = $("#edit_id").val();
    if(product_id==''){
        alert("Please Add Product first");
        return false;
    }
    else
    {
        $("#load_image_popup").attr({"data-toggle":"modal","data-target":"#myModal"}).trigger('click');
        return true;
    }
}

//product image delete
function product_image_delete(del_id,table_name)
{
      $.ajax({
          url:base_url+"inventory/product_image_delete/"+del_id+"/"+table_name,
          type:"POST",
          data:{},
          dataType:'json',
          success:function(res){
            service_message(res.status,res.message);
          }
    });    
}

function get_form(action,div_id,title,elm,popup,fn_to_call,call_fun_args){
     popup = (popup == false)?false:true;

     $.ajax({
          url:base_url+action,
          type: "POST",
          data: {},
          dataType:"json",
          success : function(data){
             //critical error
             if(data.status == "error" && data.error_msg) {
                    alert(data.error_msg);
                    return false;
                }
                if(data.form_view){
                    if(!popup){
                       $("#"+div_id).html(data.form_view);
                    }
                    else
                    {
                        $("#"+div_id).find("#myModalLabel").html(title);
                        $("#"+div_id).find(".modal-body").html(data.form_view);
                        
                        init_modal();
                        $('#'+div_id).modal();
                        $("#"+div_id).show();
                        $("#"+div_id).fadeIn();
                    } 
                } 
            },
           error : function(data) {
              after_ajax(elm,data);
           }
     });
}

/*The functions "before_ajax" is to avoid double-click on anchors or buttons.
 * It should be called before each ajax process start.
 * And also it replaces the original text or value by the argument 'content' passed by called function.
 */ 

function before_ajax(elm, content)
{
	if(!$(elm).length)
		return false;

	content=content?content:'Processing...';
	
	if($(elm).attr("disabled")=="disabled")
    {
		return false;
    }
	else
	{
		$(elm).attr("disabled","disabled");
		
		if(content)
		{
			var w1 = $(elm).width();
			
			if($(elm).is("a"))
			{
			 elm_old_text = $(elm).html();
             
			 if($(elm).hasClass("add_loader_class")){
			     $(elm).addClass($(elm).attr("data-add_loader_class"));
			 }
             else
             {
				$(elm).text(content);
             }
			
			}
			else if($(elm).is("button"))
			{
				elm_old_text = $(elm).text();
				$(elm).text(content);
			}
			else if($(elm).attr("type") == 'checkbox' && $(elm).parent().hasClass('add-on') && $(elm).parent().next().hasClass('add-on'))
			{
				elm_old_text = $(elm).parent().next().html();
				$(elm).parent().next().html(content);
			}
			
			var w2 = $(elm).width();
			
			if(w2<w1)
				$(elm).width(w1);
			
		}
			
		return true;
	}
	
}

/*The functions "after_ajax" should be called after ajax-process end.
 * It enables the button or anchor elemnts and resets thier original text.
 */ 

function after_ajax(elm,data)
{
    
	if($(elm).length)
	{
		if($(elm).is("a,span"))
		{
		    if($(elm).hasClass("add_loader_class")){
			     $(elm).removeClass($(elm).attr("data-add_loader_class"));
	        }
        
            $(elm).removeAttr("disabled");
            $(elm).html(elm_old_text);
			
		}
		else if($(elm).is("button"))
		{
			$(elm).removeAttr("disabled");
			$(elm).text(elm_old_text);
		}
		else if($(elm).attr("type") == 'checkbox' && $(elm).parent().hasClass('add-on') && $(elm).parent().next().hasClass('add-on'))
		{
			$(elm).removeAttr("disabled");
			$(elm).parent().next().html(elm_old_text);
		}
	}
	
    if(data.access_status && data.access_status == 'denied')
    {
    	if(data.access_message && data.access_message != '')
    		alert(data.access_message);
    	else
    		alert("Access denied.");
        
        return false;
        
    }
    else if(data.session_status && data.session_status == 'destroyed')
    {
        alert("Oops!! Your session has expierd.");
        location.href = base_url+'login';
        return false;
        
    }    
	return true;		
}

function init_modal()
{
  var wheight = $(window).height();
  var modal_height = wheight-200;
  
  //apply this style for all modal boxes
  $('.modal-body').css({'max-height':(modal_height+'px'),overflow:'auto'}); 
  
}

function form_utilities(div_id){
       // To display fancy select box.
    	$('select').not(".boot_select_false").selectpicker();
    	
    	//initiate datepickers with basic features.
    	//init_datepicker();
        
        //ck editor render for textarea which has the class name "ck_editor"
       // ck_editors_render(div_id);
        
    	//enable tooltip on button and anchor elements by default.
        $('a,button').tooltip();
        
}


function init_datepicker(selector)
{
  selector = selector?selector:'.datepicker';
	$(selector).datepicker({'format':'yyyy-mm-dd', 'autoclose':true, 'clearBtn':true});

  var d1 = $("input[name*='start_date']");
  var d2 = $("input[name*='end_date']");
  $(d1).datepicker({'format':'yyyy-mm-dd', 'autoclose':true, 'clearBtn':true});
  $(d2).datepicker({'format':'yyyy-mm-dd', 'autoclose':true, 'clearBtn':true});

}

function ck_editors_render(div_id){
    
    $("#"+div_id).find(".ck_editor").each(function() {
        
            var id = $(this).attr("id");                
            
            var editor_ins = CKEDITOR.instances[id];

            if (editor_ins ) { 
                CKEDITOR.remove(editor_ins);
            }
            
               editors[id] = CKEDITOR.replace( id, {height: 80});  
  
    });
}

function save_form(action,div_id,save_type,elm,call_back_fn,popup){

     call_back_fn = call_back_fn?call_back_fn:false;
     popup        = popup?popup:false;
     
     var loader_content = (popup)?"Saving..":"";       
     
     if(!before_ajax(elm, loader_content))
      return false;
     
     post_data =  $("#"+div_id).find("form").serializeArray();
     
     //$("#"+div_id).find("form").find("input,select").removeAttr("disabled");
 
     var obj = {
          url:base_url+action,
          type: "POST",
          data: $("#"+div_id).find("form").serialize(),
          dataType:"json",
          error : function(data) {
           after_ajax(elm,data);
      }
     };
    
     if(call_back_fn){
        obj.success = function(data){
        call_back_fn(data,div_id,elm,action,post_data,popup);
      };
     }   
     else
      obj.success = function(data){
        if(data.status == "success"){
            
            if(action == 'sales_rep/add' && div_id=='repForm'){

              bootbox.alert(data.msg);
              $('#auto_fillrep').html(data.repdrop);
              $('#repForm').modal('hide');
            }
            else if(action.search("user/cust_price_add")!=-1 && div_id=='cust_add_new_price')
            {
              bootbox.alert(data.msg); 
              $("#custom_mytab a[href='#price_list']").trigger('click');             
              $('#cust_add_new_price').modal('hide');
            }
            else
            {
              //success message set.
              var alert_msg = data.msg;
              service_message(data.status,alert_msg);
            
              //to close popupshow
              $('#'+div_id).modal('hide');
              
              //grid refresh
              refresh_grid();
            } 

        }
        else if(data.status == "error")
        {
            //critical error
            if(data.error_msg){
                 bootbox.alert(data.error_msg);
                 return false;
            }

            //price list error
            if(data.price_error) {
                bootbox.alert(data.price_error);
                $(elm).removeAttr("disabled"); 
                $(elm).text("Submit");
                return false;
            }
                
            //load validated form
            $("#"+div_id).find(".modal-body").html(data.form_view);
            //form_utilities(div_id);
        }
        
        if(! after_ajax(elm,data))
           return false;
        
      };
    
     $.ajax(obj);
}
/***End To Punitha **/


/*Ram */

$("#UploadModal").on("click",".cancel-file",function(){
  //$(".UploadDocForm")[0].reset();
  //$(".upload-doc").html("");
  rand = $(this).attr("data-rand");
  name = $(this).attr("data-name");
  id = $(this).attr("data-id");
  edit_id = $(this).attr("data-po-id");
  $.ajax({
     url:base_url+'purchase/del_upload',
    type:"POST",
    data:{rand:rand,name:name,edit_id:edit_id},
    success:function(data)
    {
      data = JSON.parse(data);
      $("#row_"+id).remove();
      $(".upload-msg").html("<div style="+style+">"+data.message+"</div>");
       setTimeout(function(){
        $(".upload-msg").html("");
      },2000);
    }
  });
});


$(".upload-doc").click(function(){
  var formData = new FormData();
  formData.append('file', $('.po_doc')[0].files[0]);
  formData.append('rand', $('.rand').val());
  formData.append('edit_id', $('.edit_id').val());
  $.ajax({
    url:base_url+'purchase/do_upload',
    type:"POST",
    data:formData,
    processData: false,  // tell jQuery not to process the data
    contentType: false,
    success:function(data)
    {
      console.log(data);
      data = JSON.parse(data);
      $(".rand").val(data.rand);
      if(data.status=="success")
      {
        style='color:green;'
        $(".UploadDocForm .po_doc").val('');
        var html='';
        for(var i=2;i < data.docs.length;i++)
        {
          html+= "<div id='row_"+i+"'>"+
                    data.docs[i]+
                  "<a href='javascript:void(0)' data-id='"+i+"' data-po-id='"+data.po_id+"' data-name='"+data.docs[i]+"' data-rand='"+data.rand+"' class='col-md-2 pull-right cancel-file'>x</a></div>";
        }
        $(".doc-uploaded").html(html);
      }
      else
        style='color:red;'

      $(".upload-msg").html("<div style="+style+">"+data.message+"</div>");
      setTimeout(function(){
        $(".upload-msg").html("");
      },2000);
    }
  });
   
});

$(".checkout-btn").click(function(){
  po_id = $(this).attr('data-po-id');
  $.ajax({
    url:base_url+'purchase/get_cart_count',
    type:"POST",
    data:{po_id:po_id},
    success:function(data)
    {
      data = JSON.parse(data);
     if(data.count == 0)
      {
        bootbox.alert("Your cart is empty.");
        return false;
      }
      else
        window.location.href = base_url+'purchase/checkout/'+po_id;
    }
  });
  
});


$(".warehouse_select").change(function(){
  val = $(this).val();
  $.ajax({
    type:"POST",
    url:base_url+'warehouse/get_warehouse_details',
    data:{val:val},
    success:function(data)
    {
      data = JSON.parse(data);
      $("form#checkoutForm #wname").val(data.name);
      $("form#checkoutForm #address1").val(data.address1);
      $("form#checkoutForm #address2").val(data.address2);
      $("form#checkoutForm #city").val(data.city);
      $("form#checkoutForm #phone").val(data.phone);
      $("form#checkoutForm #email").val(data.email);
      $("form#checkoutForm #state").val(data.state);
      $("form#checkoutForm #country").val(data.country);
    }
  });
});

function get_purchase_order(id,ele)
{
  $.ajax({
    type:"POST",
    url:base_url+'purchase/get_purchase_order',
    data:{id:id},
    success:function(data)
    {
      //console.log(data);
      $("#ViewPurchaseOrder .modal-ajax").html(data);
    }
  });
}

  


$(".role_id").change(function(){
  val = $(this).val();
  $.ajax({
    type:"POST",
    url:base_url+'admin/get_access_level',
    data:{id:val},
    success:function(data)
    {
      console.log(data);
      $("form#AccessLevel .ajax_module").html(data);
    }
  });
});

function customer_relation()
{
  var tab = $('.nav-tabs > .active').find('a').attr("href").replace("#","");
  form = $("form#CutomerRelation").serialize();
  edit_id = $(".edit_id").val() ? $(".edit_id").val() : 0;
  $.ajax({
    type:"POST",
    url:base_url+'salesorder/add_edit_customer/'+edit_id+'/'+tab,
    data:form,
    dataType:'json',
    success:function(data)
    {
      console.log(data);
      if(data.status=="success")
      {
        $(".customer_add_div").html(data.output);
        if(tab=="tab1primary")
        {        
          $('.nav-tabs > .active').next('li').find('a').trigger('click');
        }
        else if(tab=="tab2primary")
         {
           $('.nav-tabs li:nth-child(3)').find('a').trigger('click');          
         }
         else if(tab=="tab3primary")
         {
           location.href = base_url+"salesorder/customer_relation/";
         }
      }
      else
      {
        $(".customer_add_div").html(data.output);
        if(tab=="tab2primary")
        {
          $('.nav-tabs > .active').next('li').find('a').trigger('click');
        }
        else if(tab=="tab3primary")
        {
          $('.nav-tabs li:nth-child(3)').find('a').trigger('click');
        }
      }
    }
  });

}

 $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

// $('.singletime').wickedpicker({twentyFour: true, title:'Pick Time',beforeShow:''});

$('.singletime').timepicker({showCloseButton: true,closeButtonText: 'Done',showPeriod: true,  amPmText: ['AM', 'PM'],
    hours:{
        starts: 00,                // First displayed hour
        ends: 23                  // Last displayed hour
    }});


/*Ram*/