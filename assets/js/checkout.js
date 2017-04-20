function get_customer_details(so_id)
{
    var cus_id = $("#customer_id").val();
    
    $.ajax({
    type:"POST",
    url:base_url+'salesproductselection/get_customer_information/'+so_id,
    data:{id:cus_id},
    dataType:"json",
    success:function(data)
    {
      var status = data.status;
      //alert(status);
      //if(status == 'success'){
        $("#customer_details_view").html(data.customer_view);
        $(window).scrollTop($('#customer_details_view').offset().top);
     // }
    } 
  });
}
