/**
 * This function checks if a password input field is filled and if the two strings match
 */
jQuery(function(){
	$("#submit").click(function(){
		$(".help-block").hide();
		var hasError = false;
		var passwordOld = $("#password-old").val();
		var passwordVal = $("#password").val();
		var checkVal = $("#password-check").val();
		if (passwordOld == '') {
			$("#password-old").after('<span class="help-block">Please your old password.</span>');
			hasError = true;
		}
		if (passwordVal == '') {
			$("#password").after('<span class="help-block">Please enter a password.</span>');
			hasError = true;
		} else if (checkVal == '') {
			$("#password-check").after('<span class="help-block">Please re-enter your password.</span>');
			hasError = true;
		} else if (passwordVal != checkVal ) {
			$("#password-check").after('<span class="help-block">Passwords do not match.</span>');
			hasError = true;
		}
		if(hasError == true) {return false;}
	});
});