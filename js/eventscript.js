
function btnAddAuditor(){
//	if($('#optr').val() == "less" && (parseInt($('#selectedProductQty').val()) <= parseInt($('#newqty').val())) ){
//		alert("New Qty should not be Greater or Equal from previous Ordered Qty!");
//		return;
//	}

	jData = "funcname=newAuditor&auditor_name="+$('#auditor_name').val()+"&area="+$('#area').val();
	$.ajax({    //create an ajax request to display.php
		type: "POST",
		data: jData,
		url: "function.php",             
		dataType: "json",   //expect html to be returned                
		success: function(rdata){  
		//	alert('wew');
		} // EOD SUCCESS
	 });
}
