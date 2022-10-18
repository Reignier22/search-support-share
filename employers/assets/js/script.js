$(document).ready(function() {

    const hover = document.getElementById('home');
    const show = document.getElementById('back');
    const i = document.getElementById('i');

    hover.addEventListener('mouseover', function handleMouseOver() {
        show.style.visibility = 'visible';
        hover.style.backgroundColor = '#fff';
        i.style.color = '#77A6F7';
    });

    hover.addEventListener('mouseout', function handleMouseOut() {
        show.style.visibility = 'hidden';
        hover.style.backgroundColor = '#77A6F7';
        i.style.color = '#c3c3c3';
    });


    $('#register').on('click', function(e) {
        e.preventDefault();
        var company = $('#company').val();
        var contactNumber = $('#cnumber').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirmPass = $('#cpassword').val();

        var validEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

        if (company == "" || contactNumber == "" || email == "" || password == "" || confirmPass == "") {
            alert('All input fields are required!');
        } else if (!validEmail.test(email)) {
            alert("Enter a valid email address");
        } else if (!validPassword.test(password)) {
            alert("Password should be minimum of eight characters, at least one uppercase letter, one lowercase letter and one number")
        } else if (password != confirmPass) {
            alert('Password Mismatched');
        } else if ($("#checkbox").prop('checked') == false) {
            alert('You did not check the box');
        } else {
            $.ajax({
                url: 'connections/register.php',
                method: 'POST',
                data: {
                    register: 1,
                    companyPHP: company,
                    contactNumberPHP: contactNumber,
                    emailPHP: email,
                    passwordPHP: password,
                    confirmPassPHP: confirmPass,
                },
                success: function(response) {
                    if (response == 'email') {
                        alert('Email already exist');
                    } else if (response == 'No') {
                        alert('Registration Failed');
                    } else {
                        alert("Register Successfully, OTP sent to your email, " + email);
                        window.location.replace('otp_verify.php');
                    }
                },
                dataType: 'text'
            });
        }
    });

    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/login.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response == 'Yes') {
                    alert('Login Successful');
                    window.location.replace('employer_profile.php');
                } else {
                    alert(response);
                }
            }
        });

    });

});