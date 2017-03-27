$(document).ready(function(){
	$("form#CustomerRelation").validate({
		
		rules:{
			'name':"required",
			'bill_name':"required",
			"address_1":"required",
			"city":"required",
			"state":"required",
			"country":"required",
			"zipcode":
				{
					required:true,
					number:true,
					maxlength:5,
					minlength:5,
				},
			"credit_type":"required",
			"contact_name":'required',
			"contact_value":{
				required:true,
				number:true
			},
			"contact_type":"required",
			"contact_email":{
				required:true,
				email:true
			},
			"loc_name[]":{
					required:true
				},
			"loc_address_1[]":{
					required:true
				},
			"loc_city[]":{
					required:true
				},
			"loc_state[]":{
					required:true
				},
			"loc_country[]":{
					required:true
				},
			"loc_zipcode[]":{
					required:true,
					maxlength:5,
					minlength:5,
					number:true
				},
			"start_time[]":{
					required:true
				},
			"end_time[]":{
					required:true
				},
			"timezone[]":{
					required:true
				},
			"weeks[]":{
					required:true
				},
			"loc_type[0][]":{
					required:true
				},
		},
		messages:{
			'name':"Please Enter Customer Name",
			'bill_name':"Please Enter Bill To name",
			'address_1':"Please Enter Address 1",
			'city':"Please Enter city",
			'state':"Please Select State",
			'country':"Please Select Country",
			'zipcode':
			{
				required:"Please Enter Zipcode",
				number:"Only Numeric Digits are allowed",
				maxlength:"Maximum 4 Numbers are allowed",
				minlength:"Need 5 Digits to be Entered",
			},
			credit_type:"Please Select Credit Type",
			"contact_name":"Please Enter Contact Name",
			"contact_value":
				{
					required:"Please Enter Contact Value",
					number:"Please Enter Number Only",
				},
				"contact_type":"Please Select Contact Type",
				"contact_email":{
					required:"Please Enter Contact Email-ID",
					email:"Please Enter Valid Email-ID"
				},
				"loc_name[]":{
					required:"Please Enter Lcoation Name"
					},
				"loc_address_1[]":{
					required:"Please Enter Address 1"
					},
				"loc_city[]":{
						required:"Please Enter City"
					},
				"loc_state[]":{
						required:"Please Select State"
					},
				"loc_country[]":{
						required:"Please Select Country"
					},
				"loc_zipcode[]":{
						required:"Please Enter Zipcode",
						maxlength:"Maximum 5 characters are allowed",
						minlength:"Minimum 5 characters need to enter",
						number:"Only Numbers are allowed"
					},
				"start_time[]":{
						required:"Please Select Start Time"
					},
				"end_time[]":{
						required:"Please Select End Time"
					},
				"timezone[]":{
						required:"Please Select Timezone"
					},
				"weeks[]":{
						required:"Please Select Days of Weeks"
					},
				"loc_type[0][]":{
						required:"Please Select Location Type"
					},
				

		},
		submitHandler:function(form)
		{
			curr = $(".nav-tabs li.active a").attr("data-href");
			$(".nav-tabs li.active").removeClass("active").next("li").addClass("active");
			tab = $(".nav-tabs li.active a").attr("data-href");
			$(".tab-pane").removeClass("active in");
			$(tab).addClass("active in");
			if(curr=="#tab3primary")
				return true;
			else
				return false;
		}
	});

});