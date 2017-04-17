$(function(){
    if(namespace == 'inventory_add'){
        $('#ProductTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    
      var product_id = $("#edit_id").val();
      if(product_id==''){
        if(namespace == 'inventory_add'){
            $('#ProductTabs a').not(":first").unbind("click");
            $('#ProductTabs li').not(":first").click(function(){
                bootbox.alert("Please Enter General Info");
            });
        } 
      }
      else
      {
        //$("#ProductTabs a:first").trigger("click");
        //$('#ProductTabs a').attr("data-toggle",'tab').trigger('click');
      }
        $("#ProductTabs a:first").trigger("click");
    }
    
    if(namespace=='upload_inventory_index'){
        $("#upload_variations li a:first").trigger('click'); 
    }
});


function inventory_sub()
{
    var fdata   = $("#inventory_sub_form").serialize();
    var edit_id = '';
        edit_id = $("#inventory_sub_form #edit_id").val();
     alert(123);
      $.ajax({
          url:base_url+"inventory/add/"+edit_id,
          type:"POST",
          data:fdata,
          dataType:'json',
          success:function(res)
          {
            var status = res.status;
            var output = res.output;  
            $("#inventory_form .modal-body").html(output);
            $("#inventory_form").modal({
                backdrop:"static",
                keyboard: false
            });
                
            $("#inventory_form").show();    
            //if(status == 'success'){
              location.href = base_url+"inventory/add/"+res.edit_id;
           // }
            else
            {
              $("#inventory_add_section").html(output); 
            }
          }
    });    
}

function add_vendor_price_lists(action,div_id)
{
     var fdata   = $("#form_vendor_add").serialize();
     var edit_id = '';
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
            }
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
