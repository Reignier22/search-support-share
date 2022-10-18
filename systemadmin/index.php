<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>System Admin Login</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<div class="box">
		<form action="adminController.php" method="POST" autocomplete="off">
			<h2>System Admin </h2>
		 	<span id="errorMsg" class="box-error glowing">Error Message</span>
			<div class="inputBox">
				<input type="text" name="email" id="email" required>
				<span>Email</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input type="password" name="password" id="password" required>
				<span>Password</span>
				<i></i>
			</div>
			<div class="links">
				<span> <input type="checkbox" id="checkb"> &nbsp;Show Password </span> 
				<a href="#">Forgot Password?</a>
			</div>
			<input type="submit" name="login" id="login" value="Login">
		</form>
	</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script>
$(document).ready(function(){
	$('#checkb').on('click', function(){
	var x = document.getElementById('password');
		if (x.type === "password"){
			x.type = 'text';
		} else{
			x.type = 'password';
		}
	});

	$('#login').on('click', function(e){
	e.preventDefault();
	var email = $('#email').val();
	var password = $('#password').val();
	
	$.ajax({
		url: 'adminController.php',
		method:"POST",
		data: {
			login: 1,
			emailPHP: email,
			passwordPHP: password
		},
			success: function (response){
				
				if (response == 'email_err') {
					$('#errorMsg').show().delay(3000).fadeOut(0);
					$('#errorMsg').html("Please enter a valid email address");
				}

				else if(response == 'No'){  
					$('#errorMsg').show().delay(3000).fadeOut(0);
					$('#errorMsg').html("Incorrect Email or Password");
				}  
				else if (response == "Yes"){  
					$('#errorMsg').show();
					$('#errorMsg').html("Login Successful");
					window.location.replace("sys-home.php");
				}  else{
					alert("Some error occured");
				}
			},
			dataType: 'text'
		});
	
	}); 

});
</script>


</body>
</html>