
$(function(){

	$('.singledate').daterangepicker({
	  singleDatePicker: true,
	  showDropdowns: true,
      sautoUpdateInput: false,
	  locale: {
	    format: 'YYYY-MM-DD',
	  }
	});
  

  $('.datetime').daterangepicker({
    singleDatePicker: true,
      timePicker: true,
    showDropdowns: true,
      sautoUpdateInput: false,
    locale: {
      format: 'YYYY-MM-DD HH:mm',
    }
  });
  

  $('.singledate').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD'));
  });

  
    $('.datetime').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
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
    val = $(this).find("option:selected").val();
    type = $("select[name='table_type']").find("option:selected").val();
    
    $.ajax({
      type:"POST",
      url:base_url+'admin/get_dropdown_value',
      data:{val:val,type:type},
      dataType:'json',
      success:function(data)
      {
        $("form#dropdowns input[name='edit_id']").val(data.output.id);
        $("form#dropdowns input[name='table_value']").val(data.output.name);
        $("form#dropdowns input[name='status'][value="+ data.output.status+"]").prop('checked',true);
        console.log(data);
      },
      error:function(err)
      {
        alert("error");
        console.log(err);
      }

    });
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
     $(".select2_sample2").empty();
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
  // if($(".vendor_select").val()=='')
  // {
  //   bootbox.alert("Please Select Vendor");
  //   return false;
  // }

  b=b?b:0;
  d=d?d:"form";
  var e="#"+$(f).attr("id");
  var c=$(e).attr("data-original-title");
  if(d=="form")
  {
    if(!before_ajax(e,"Loading...."))
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
    if(!before_ajax(f,"Loading...."))
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
           $("#viewCart table tbody").html(data.content);
           $(".view_cart_count").html(data.count);
               // if(data.status=="success")
               //    location.reload();
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
  if(!before_ajax(a,"Loading...."))
  {
    return false;
  }
  $.ajax({
    url:base_url+"purchase/update_cart/",
    type:"POST",
    data:$("form#viewCart").serialize(),
    dataType:"json",
    success:function(b){
      console.log(b);
      after_ajax(a,b);
      $("form#viewCart table tbody,div#viewCart table tbody").html(b.content);
      $("span.cart_total").html(b.cart_total);
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
      $("#viewCart table tbody").html(c.content);
      bootbox.alert(c.message);
      if(c.count=="0")
      {
        bootbox.alert("Your cart is empty.",function(){
          location.href = base_url+"purchase/add";
        });
      }
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
        //To  enable tab index in firefox and mac.(TAB, Backspace and DEL from the keyboard)
      if(unicode==8 || unicode==46 || unicode == 37 || unicode == 39){
        return true
      }
      else
      {
         //bootbox.alert("Enter Number Only");
         return false //disable key press
       }  
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


function DeleteCheckedRow(e,cls,url)
{ 
  var rec_count = $(document).find('.'+cls+':checked').length, ids = '';
    
  if(rec_count <= 0 ) {
    alert("Please check atleast 1 record to delete!"); return false;
  }
   
  var conf = confirm("Are you sure want to delete "+ rec_count + " Record(s)?");
  
  if(!conf) return false;
  
     $(document).find("."+cls+":checked").each(function(){ 
        ids += (ids)?','+$(this).val():$(this).val();
     });
  
   url = base_url+url;
   before_ajax(e);
   $.ajax({
          type: "POST",
          url: url,
          data: {id:ids},
          dataType:"json",
          success: function(res){ 
            alert(rec_count+' record(s) deleted successfully');
            //after_ajax(e);
            if(res.status == 'success'){
                refresh_grid();
            }
          },
          error: function(e) {
            	//called when there is an error
            	console.log(e.message);
                after_ajax(e);
          }
    });
}


function modal_close(pid='')
{
     var pid = $("#cancel").attr("data-pid");
     $("#"+pid).find("label").removeClass("ui-checkboxradio-checked ui-state-active");
     $("#selectAll-"+pid).removeAttr("checked");
     $("#product_ship").hide();
  //   refresh_grid();
}

function popup_close(modal)
{
    $(modal).hide();
   if(modal == '#updat_cart'){
     $(modal).removeClass("show in");
   } 
    if(modal == '#inventory_form' || modal == '#updat_cart'){
        $(".modal-backdrop").removeClass("in");
        $(".modal-backdrop").remove();
       if(modal != '#updat_cart'){ 
         refresh_grid();
       } 
    }
    //$(".modal-backdrop").removeClass("in");
   // $(".modal-backdrop").remove();
   
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
     
     data_tbl     =  (data_tbl)?data_tbl:"data_table";
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

//delete cart



/***End To Punitha **/


/*Ram */

$("#UploadModal").on("click",".cancel-file",function(){
  //$(".UploadDocForm")[0].reset();
  //$(".upload-doc").html("");
  rand    = $(this).attr("data-rand");
  name    = $(this).attr("data-name");
  id      = $(this).attr("data-id");
  edit_id = $(this).attr("data-po-id");
  $.ajax({
     url:base_url+'purchase/del_upload',
    type:"POST",
    data:{rand:rand,name:name,edit_id:edit_id},
    success:function(data)
    {
      console.log(data);
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
  $(".purchase-loader").show();
  val = $(this).val();
  if(val!=''){
    $.ajax({
      type:"POST",
      url:base_url+'warehouse/get_warehouse_details',
      data:{val:val},
      success:function(data)
      {
        $(".purchase-loader").hide();
        data = JSON.parse(data);
        $("form#checkoutForm #wname").val(data.name);
        $("form#checkoutForm #address1").val(data.address1);
        $("form#checkoutForm #address2").val(data.address2);
        $("form#checkoutForm #city").val(data.city);
        $("form#checkoutForm #phone").val(data.phone);
        $("form#checkoutForm #email").val(data.email);
        $("form#checkoutForm #state").val(data.state);
        $("form#checkoutForm #country").val(data.country);
        $("form#checkoutForm #zipcode").val(data.zipcode);
      }
    });
  }
  else
  {
    $(".purchase-loader").hide();
    $("form#checkoutForm")[0].reset();
  }
});

function get_purchase_order(id,ele='')
{
  $.ajax({
    type:"POST",
    url:base_url+'purchase/get_purchase_order',
    data:{id:id},
    success:function(data)
    {
      console.log(data);
      $("#ViewPurchaseOrder .modal-ajax").html(data);
    }
  });
}

function getInvoice(id,ele)
{
  $.ajax({
    type:"POST",
    url:base_url+'accounting/get_invoice',
    data:{id:id},
    success:function(data)
    {
      console.log(data);
      $("#ViewInvoice .modal-ajax").html(data);
    }
  });
}


  $(".change_invoice_status").click(function(){
  id = $("select[name='invoice_status']").attr("data-id");
  val = $("select[name='invoice_status']").val();
  cmt = $("textarea[name='inv_comments']").val();

  $.ajax({
    type:"POST",
    url:base_url+'accounting/change_invoice_status',
    data:{id:id,val:val,comments:cmt},
    success:function(data)
    {
      data = JSON.parse(data);
      service_message(data.status,data.message);
      setTimeout(function(){
        location.reload();
      },2000);
    }
  });
});
  


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
  $.ajax({
    type:"POST",
    url:base_url+'salesorder/add_edit_customer/'+tab,
    data:form,
    dataType:'json',
    success:function(data)
    {
      
      console.log(data);
      if(data.status=="success")
      {
        $(".customer_add_div").html(data.output);
        if(tab=="tab1primary")
          $('.nav-tabs > .active').next('li').find('a').trigger('click');
        else if(tab=="tab2primary")
         {
           $('.nav-tabs li:nth-child(3)').find('a').trigger('click');          
         }
         else if(tab=="tab4primary")
         {
           location.href = base_url+"salesorder/customer_relation/";
         }
      }
      else
      {
        $(".customer_add_div").html(data.output);
        if(tab=="tab2primary")
          $('.nav-tabs > .active').next('li').find('a').trigger('click');
        else if(tab=="tab3primary")
          $('.nav-tabs li:nth-child(3)').find('a').trigger('click');
      }
      init_timepicker();
    }
  });

}
init_timepicker();


function init_timepicker()
{
  $('.singletime').timepicker({showCloseButton: true,closeButtonText: 'Done',showPeriod: true});
}



 $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

// $('.singletime').wickedpicker({twentyFour: true, title:'Pick Time',beforeShow:''});


function add_address()
{
  len = $(".ajax_address .new_address").length;
  $.ajax({
    type:"POST",
    url:base_url+'salesorder/add_new_address',
    data:{len:len},
    dataType:'json',
    success:function(data)
    {
      if(len==0)
      {
        html =  "<div class='col-md-2 pull-right'>"+
                    "<button type='button' class='btn' onclick='remove_address(this);'>Remove</button>"+
                  "</div>";
        $("#tab3primary .remove_div").html(html);
      }
      $(".ajax_address").append(data.output);
    }
  });
}

function remove_address(ele,id='')
{
  edit_id = $(".edit_id").val();
  len = $(".ajax_address .new_address").length;
  len1 = $(".edit_address").length;
  
   if((len + len1) > 1 )
   {
    $(ele).parent().parent().parent().remove();
     // $("#tab3primary .remove_div").remove();
   }
   else
    alert("Cannot able to remove");
  
}


$(".btnPrevious").click(function(){
  curr_tab = $(".nav-tabs li.active");
  prev_href = $(curr_tab).prev("li").find("a").attr("data-href");
  curr_href = $(curr_tab).find("a").attr("data-href");
  $(curr_tab).removeClass("active").prev("li").addClass("active");
  $(curr_href).removeClass("active in");
  $(prev_href).addClass("active in");
});


$(".vendor_select").change(function(){
  val = $(this).val();
  $(".vendor_input").val(val);
  $(".purchase_order_search").trigger("click");
});


$(".qty-ip").keypress(function (evt) {
  evt.preventDefault();
});

$(".save-recevived-qty").click(function(){
  form = $("form#ReceivedQtyForm").serialize();
  $.ajax({
    type:"POST",
    data:form,
    url:base_url+'purchase/purchase_modal_save',
    dataType:'json',
    success:function(data)
    {
      if(data.status=="success")
        bootbox.alert(data.message,function(){
          location.reload();          
        });
      // console.log(data);
    }
  });
});


$(".show_log_btn").click(function(){
  if($("#ShowLog").hasClass("hide"))
    $(this).text("Hide Log History");
  else
    $(this).text("Show Log History");
  $("#ShowLog").toggleClass("hide");
});


$(".add-product-modal").click(function(){

  form = $("#ModalAddProductForm").serialize();
  $.ajax({
    type:"POST",
    url:base_url+'purchase/add_product_modal_ajax',
    data:form,
    dataType:'json',
    success:function(data)
    {
      console.log(data);
      if(data.status=="success")
      {
        bootbox.alert(data.message,function(){
          location.reload();
        });
      }
    }
  });

});

/*Ram*/