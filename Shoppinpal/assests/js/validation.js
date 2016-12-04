$(document).ready(function(){

	$('#reg_password').focusin(function(){
		$('#pwds_error').remove();
		//$('#pwds_error1').remove();
		$("#registration_button").removeAttr('disabled');
	});

	//focus out for email
	$('#reg_password').focusout(function(){
	var patt=/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	var str=$('#reg_password').val();
	if(str!="") { 
	// {
	// 	$('#reg_password').after("<span id='pwds_error' style='font-size:12px;color:red'>*Password is Required</span>");
	// 	$("input[type=submit]").attr('disabled','disabled');
	// }
	//else 
		if(!str.match(patt))
		{
			$('#reg_password').after("<span id='pwds_error' style='font-size:12px;color:red'>*Password contain atleast 1 number,1 character and 1 spetial character(lenght:6-16).</span>");
		    $("#registration_button").attr('disabled','disabled');
		}
    }
	});

	$('#reg_username').focusin(function(){
		$("#registration_button").removeAttr('disabled');
		$('#user_error').remove();
	});
	$('#reg_username').focusout(function(){
	var str=$('#reg_username').val();
	var patt=/^[a-z0-9_-]{6,15}$/;
	if(str!="")
	{
	// 	$('#reg_username').after("<span id='puser' style='font-size:12px;color:red'>*Username is Required</span>");
	// }
	// else 
		if(!str.match(patt))
		{
			$('#reg_username').after("<span id='user_error' style='font-size:12px;color:red'>characters and symbols in the list, a-z, 0-9, underscore, hyphen(length:6-15)</span>");
			$("#registration_button").attr('disabled','disabled');
		}
    }
	});

	$('#reg_email').focusin(function(){
		$('#email_error').remove();
		$("#registration_button").removeAttr('disabled');
		//$('#pem1').remove();
	});

	//focus out for email
	$('#reg_email').focusout(function(){
	var patt=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var str=$('#reg_email').val();
	if(str!="")
	{
	// 	$('#emailid').append("<span id='pem1' style='font-size:12px;color:red'>*email is Required</span>");
	// }
	// else 
		if(!str.match(patt))
		{
			$('#reg_email').after("<span id='email_error' style='font-size:12px;color:red'>*Enter Valid email</span>");
			$("#registration_button").attr('disabled','disabled');
		}
    }
	});

	$( "#register_form" ).submit(function( event ) {
		//event.preventDefault();
		//var self = this;
		$('#email_error').remove();
		$('#user_error').remove();
		$('#pwds_error').remove();
        var patt_usnm=/^[a-z0-9_-]{6,15}$/;
		var patt_psw=/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
        var patt_email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var str_usnm=$('#reg_username').val();
        var str_email=$('#reg_email').val();
        var str_psw=$('#reg_password').val();
        if(!str_usnm.match(patt_usnm))
		{
			$('#reg_username').after("<span id='user_error' style='font-size:12px;color:red'>characters and symbols in the list, a-z, 0-9, underscore, hyphen(lenght:6-15)</span>");
			$("#registration_button").attr('disabled','disabled');
			return false;
		} else if(!str_email.match(patt_email))
		    {
			    $('#reg_email').after("<span id='email_error' style='font-size:12px;color:red'>*Enter Valid email</span>");
			    $("#registration_button").attr('disabled','disabled');
			    return false;
		    } else if(!str_psw.match(patt_psw))
		        {
			        $('#reg_password').after("<span id='pwds_error' style='font-size:12px;color:red'>*Password contain atleast 1 number,1 character and 1 spetial character(length:6-16).</span>");
		            $("#registration_button").attr('disabled','disabled');
		            return false;
		        }
	});
});