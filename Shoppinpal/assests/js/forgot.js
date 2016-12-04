$(document).ready(function(){

	$('#forgot-password').focusin(function(){
		$('#pwds_error').remove();
		//$('#pwds_error1').remove();
		$("#forgot-button").removeAttr('disabled');
	});

	//focus out for email
	$('#forgot-password').focusout(function(){
	var patt=/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	var str=$('#forgot-password').val();
	if(str!="") { 
	// {
	// 	$('#reg_password').after("<span id='pwds_error' style='font-size:12px;color:red'>*Password is Required</span>");
	// 	$("input[type=submit]").attr('disabled','disabled');
	// }
	//else 
		if(!str.match(patt))
		{
			$('#forgot-password').after("<span id='pwds_error' style='font-size:12px;color:red'>*Password contain atleast 1 number,1 character and 1 spetial character(lenght:6-16).</span>");
		    $("#forgot-button").attr('disabled','disabled');
		}
    }
	});

	$( "#forgot_form" ).submit(function( event ) {
        var patt=/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	    var str=$('#forgot-password').val();
	    if(!str.match(patt))
		{
			$('#forgot-password').after("<span id='pwds_error' style='font-size:12px;color:red'>*Password contain atleast 1 number,1 character and 1 spetial character(lenght:6-16).</span>");
		    $("#forgot-button").attr('disabled','disabled');
		    return false;
		}   
	});
});