$(function() {
	
	var signal = false;
	var regex = /^([a-zA-Z0-9])+\@([a-zA-Z0-9])+\.([a-zA-Z0-9]{3})+$/;
	var regex1 = /[0-9]+/;
	var regex2 = /[a-z]+/;
	var regex3 = /[A-Z]+/;
	
	$('#email').focusout(function() {
		var email_temp = $(this).val();
		if (email_temp == '')
			$('b').text('Email should not be empty');
		else if (!regex.test(email_temp)) 
			$('b').text('Please enter a valid email.');
		else {		
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (this.responseText == 'Used') {
						$('b').text('Thie email has already been used, please try another.');
						signal = false;
					}
					else if (this.responseText == 'Good') {
						$('b').text('This email is good');
						signal = true;
					} else $('b').text('Connection Error');
				} 
			}
			xmlhttp.open("GET", "validateEmail.php?email="+email_temp, true);
			xmlhttp.send();
		}
	});
	
	$('button').click(function(e) {
		
		var email = $('#email').val();
		var pass = $('#password').val();
		var repass = $('#retype').val();
		var name = $('#name').val();
		var address = $('#address').val;
		
		if (email=='' || pass=='' || repass=='' || name=='' || address=='') {
			alert('Please enter all required fileds!');
			e.preventDefault();
		} 
		else if (signal==false) {
			alert('Invalid email!');
			e.preventDefault();
		} 
		else if (pass.length < 6) {
			alert('Password length should be at least 6!');
			e.preventDefault();
		} 
		else if (pass != repass) {
			alert('Password should match!');
			e.preventDefault();
		} 
		else if (!regex1.test(pass) || !regex2.test(pass) || !regex3.test(pass)) {
			alert('Password should contain at least one number,' +
					'one lower-case characer and one upper-case character.');
			e.preventDefault();
		} 
		else
			alert('User signed up successfully!');
	});
	
});
