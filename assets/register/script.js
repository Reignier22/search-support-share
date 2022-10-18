$(document).ready(function() {

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        var firstName = $('#firstname').val();
        var middleName = $('#middlename').val();
        var lastName = $('#lastname').val();

        var month = $('#month').val();
        var day = $('#day').val();
        var year = $('#year').val();
        var birthDate = year + "/" + month + "/" + day;

        var civilStatus = $('#civil_status').val();
        var gender = $('#gender').val();
        var address = $('#address').val();
        var contactNumber = $('#contact').val();
        var workExperience = $('#work_experience').val();
        var attainment = $('#attainment').val();
        var userName = $('#username').val();
        var email = $('#reg-email').val();
        var password = $('#reg-password').val();
        var confirmPassword = $('#confirm_password').val();

        var validString = /^[a-zA-Za _ ]*$/;
        var validAddress = /^[a-zA-Z0-9\s,.'-]{3,}$/;
        var validNumber = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
        var validUsername = /^[a-zA-Z0-9](_(?!(\.|_))|\.(?!(_|\.))|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/;
        var validEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var validPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;


        var dateOfBirth = new Date(birthDate);
        var differenceMs = Date.now() - dateOfBirth.getTime();
        var dateFromEpoch = new Date(differenceMs);
        var yearFromEpoch = dateFromEpoch.getUTCFullYear();
        var age = Math.abs(yearFromEpoch - 1970);

        if (firstName == "" || middleName == "" || month == "" || day == "" || year == "" || lastName == "" || birthDate == "" || civilStatus == "" || gender == "" || address == "" || contactNumber == "" || workExperience == "" || attainment == "" || userName == "" || email == "" || password == "" || confirmPassword == "") {

            $('#error_reg').show();
            $('#sorry_msg').html('Incomplete');
            $('#err_msg').html('Some fields are left empty.');

        } else if (!validString.test(firstName)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Your first name is invalid.');

        } else if (!validString.test(middleName)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Your middle name is invalid.');

        } else if (!validString.test(lastName)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Your last name is invalid.');

        } else if (age < 18) {
            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('You must be 18 years old and above.');

        } else if (!validAddress.test(address)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Please enter a valid home address');

        } else if (!validNumber.test(contactNumber)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Please enter a valid contact number.');

        } else if (!validUsername.test(userName)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Username can only consist letters,numbers, and it should be atleast 8 characters long.');

        } else if (!validEmail.test(email)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Please enter a valid email address.');

        } else if (!validPassword.test(password)) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html(' Password should be minimum of eight characters, at least one uppercase letter, one lowercase letter and one number.');


        } else if (password != confirmPassword) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Password did not match.');

        } else if ($("#checkme").prop('checked') == false) {

            $('#error_reg').show();
            $('#sorry_msg').html('Invalid');
            $('#err_msg').html('Please agree to the terms and conditions and privacy policy.');

        } else {
            $.ajax({
                type: 'POST',
                url: 'connections/register.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response == 'Yes') {
                        $('#reg_success').fadeIn();
                    } else if (response == 'username') {
                        $('#error_reg').show();
                        $('#sorry_msg').html('Invalid');
                        $('#err_msg').html('Username is already taken. Please enter another one');
                    } else if (response == 'email') {
                        $('#error_reg').show();
                        $('#sorry_msg').html('Invalid');
                        $('#err_msg').html('Email is already taken. Please enter another one');
                    } else {
                        $('#error_reg').show();
                    }
                }
            });
        }
    });

    $('#r_button').on('click', function(e) {
        e.preventDefault();
        $('#reg_success').fadeOut();
        window.location.replace("register.php");
    });

    $('#error_reg_button').on('click', function(e) {
        e.preventDefault();
        $('#error_reg').fadeOut();
    });

});