$(function() 
{
  
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