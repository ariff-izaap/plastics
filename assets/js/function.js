$(function(){
    
  //$('a,button').tooltip();

	$('.singledate').daterangepicker({
	  singleDatePicker: true,
	  showDropdowns: true,
    autoUpdateInput: false,
	  locale: {
	    format: 'YYYY-MM-DD',
	  }
	});
    
  
  $('.singledate').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD'));
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


 $('#select2_sample2').select2({
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

  $(".add-new-dropdown").click(function(){
    $("form#dropdowns")[0].reset();
     $("#select2_sample2").empty();
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
  $.post(base_url+v_url,{},function(data){
      $("form#addPurchase #vendor_name").val(data.business_name);
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

function inventory_sub()
{
    
     var fdata  = $("#inventory_sub_form").serialize();
     var edit_id= '';
     
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