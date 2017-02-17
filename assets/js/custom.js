$(function(){
    
   $("#inventory").submit(function() {
         var fdata = $("#inventory").serialize();
          $.ajax({
              url:base_url+"inventory/add",
              type:"POST",
              data:fdata,
              dataType:'json',
              success:function(data)
              {
                 location.reload();
              }
        });
   });
    
    
});