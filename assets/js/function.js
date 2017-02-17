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
        console.log(data);
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
      success:function(data)
      {
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

function init_checkbox(selval){


	selval = selval?selval:'';

	if(selval){		
		$.each(selval, function( index, value ) {
			$('#checkbox-'+value).attr('checked', true);
		});	
	}

	$(".checkbox").checkboxradio({ icon: false });

}

function numbersonly(e) {
  var unicode=e.charCode? e.charCode : e.keyCode
  //alert(unicode)
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
            // alert(status);
            if(status == 'success') {
                 $("#inventory_add_section").html(output);
            }
            else
            {
                $("#inventory_add_section").html(output);                           
            }
          }
    });
 
    
}

function product_image_add(action,div_id,save_type,elm,call_back)
{
    if(($("#product_image").val() == '' && $("#file_name").val() == '') || $("#product_image").val() != '') {
   
        $("#image_upload_loader").show();
                
        $.ajaxFileUpload
            		({
    				url:base_url+"product/image_upload/"+product_id,
    				secureuri:true,
    				fileElementId:"product_image",
    				dataType: 'json',
    				data:{},
    				success: function (data)
    				{
    				    if(data.status == "error"){
    				        alert(data.msg);
                            $("#image_upload_loader").hide();
                            return false; 
    				    }
    				    else if(data.status == "success")
                        {
                                                              
                              $("#file_name").val(product_id+"/"+data.file_name);
                              $("#image_upload_loader").html("Image Uploaded.");  
                            
                              save_form(action,div_id,save_type,elm,call_back,true);
                            
                        }
                        else
                        {
                             alert("Error Occured. Try again later!!");
                             $("#image_upload_loader").hide();
                             return false;
                        }
                    },
    				error: function (data,xml, status)
    				{
    				       alert("Critical Error Occured!!");
                           $("#image_upload_loader").hide();
                           return false;
    				}
    			});
       
    }
    else
    {
        save_form(action,div_id,save_type,elm,call_back,true);
    }
}

/***End To Punitha **/