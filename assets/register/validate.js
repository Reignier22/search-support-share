function validatefName() {

    const errorFname = document.getElementById('errorFname');
    const fname = document.getElementById('firstname').value;

    if (fname.length == 0) {
        $('#errspan').eq(0).show();
        $('#sucspan').eq(0).hide();
        errorFname.innerHTML = 'First name is required';
        return false;
    }
    if (!fname.match(/^[a-zA-Za _ ]*$/)) {
        errorFname.innerHTML = 'Write a valid first name';
        return false;
    }
    errorFname.innerHTML = '';
    $('#errspan').eq(0).hide();
    $('#sucspan').eq(0).show();
    return true;
}

function validatemName() {
    const errorMname = document.getElementById('errorMname');
    const mname = document.getElementById('middlename').value;

    if (mname.length == 0) {
        $('#merr').eq(0).show();
        $('#msuc').eq(0).hide();
        errorMname.innerHTML = 'Middle name is required';
        return false;
    }
    if (!mname.match(/^[a-zA-Za _ ]*$/)) {
        errorMname.innerHTML = 'Write a valid middle name';
        return false;
    }
    errorMname.innerHTML = '';
    $('#merr').eq(0).hide();
    $('#msuc').eq(0).show();
    return true;
}

function validatelName() {

    const errorLname = document.getElementById('errorLname');
    const lname = document.getElementById('lastname').value;

    if (lname.length == 0) {
        $('#lerr').eq(0).show();
        $('#lsuc').eq(0).hide();
        errorLname.innerHTML = 'Last name is required';
        return false;
    }
    if (!lname.match(/^[a-zA-Za _ ]*$/)) {
        errorLname.innerHTML = 'Write a valid last name';
        return false;
    }
    errorLname.innerHTML = '';
    $('#lerr').eq(0).hide();
    $('#lsuc').eq(0).show();
    return true;
}

function validateBday() {
    const errorBday = document.getElementById('errorBday');
    var month = document.getElementById('month').value;
    var day = document.getElementById('day').value;
    var year = document.getElementById('year').value;
    var birthDate = year + "/" + month + "/" + day;
    var dateOfBirth = new Date(birthDate);

    var differenceMs = Date.now() - dateOfBirth.getTime();
    var dateFromEpoch = new Date(differenceMs);
    var yearFromEpoch = dateFromEpoch.getUTCFullYear();
    var age = Math.abs(yearFromEpoch - 1970);

    if (year.length == 0) {
        $('#berr').eq(0).show();
        $('#bsuc').eq(0).hide();
        errorBday.innerHTML = 'Birthday is required';
        return false;
    }

    if (age < 18) {
        $('#berr').eq(0).show();
        $('#bsuc').eq(0).hide();
        errorBday.innerHTML = 'You must be 18 years old and above';
        return false;
    }

    errorBday.innerHTML = '';
    $('#berr').eq(0).hide();
    $('#bsuc').eq(0).show();
    return true;

}

function select() {
    var e = document.getElementById("civil_status");
    var value = e.value;

    $('#serr').eq(0).hide();
    $('#ssuc').eq(0).show();
    return true;
}

function selectGender() {
    var e = document.getElementById("civil_status");
    var value = e.value;

    $('#gerr').eq(0).hide();
    $('#gsuc').eq(0).show();
    return true;
}

function validateContact() {

    const errorContact = document.getElementById('errorContact');
    const contact = document.getElementById('contact').value;
    const validNumber = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;

    if (contact.length == 0) {
        $('#cerr').eq(0).show();
        $('#csuc').eq(0).hide();
        errorContact.innerHTML = 'Contact number is required';
        return false;
    }

    if (!validNumber.test(contact)) {
        $('#cerr').eq(0).show();
        $('#csuc').eq(0).hide();
        errorContact.innerHTML = 'Please enter a valid contact number';
        return false;
    }

    errorContact.innerHTML = '';
    $('#cerr').eq(0).hide();
    $('#csuc').eq(0).show();
    return true;

}

function selectEduc() {
    var e = document.getElementById("attainment");
    var value = e.value;

    $('#eerr').eq(0).hide();
    $('#esuc').eq(0).show();
    return true;
}

function validateAddress() {
    const errorAddress = document.getElementById('errorAddress');
    const address = document.getElementById('address').value;


    if (address.length == 0) {
        $('#aerr').eq(0).show();
        $('#asuc').eq(0).hide();
        errorAddress.innerHTML = 'Home Address is required';
        return false;
    }
    if (!address.match(/^[a-zA-Z0-9\s,.'-]{3,}$/)) {
        $('#aerr').eq(0).show();
        $('#asuc').eq(0).hide();
        errorAddress.innerHTML = 'Please enter a valid home address';
        return false;
    }

    errorAddress.innerHTML = '';
    $('#aerr').eq(0).hide();
    $('#asuc').eq(0).show();
    return true;
}

function validateWork() {
    const errorWork = document.getElementById('errorWork');
    const work = document.getElementById('work_experience').value;


    if (work.length == 0) {
        $('#werr').eq(0).show();
        $('#wsuc').eq(0).hide();
        errorWork.innerHTML = 'Work experience is required';
        return false;
    }

    errorWork.innerHTML = '';
    $('#werr').eq(0).hide();
    $('#wsuc').eq(0).show();
    return true;
}

function validateUsername() {
    const errorUsername = document.getElementById('errorUsername');
    const username = document.getElementById('username').value;

    if (username.length == 0) {
        $('#uerr').eq(0).show();
        $('#usuc').eq(0).hide();
        errorUsername.innerHTML = 'Username is required';
        return false;
    }
    if (!username.match(/^[a-zA-Z0-9](_(?!(\.|_))|\.(?!(_|\.))|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$/)) {
        $('#uerr').eq(0).show();
        $('#usuc').eq(0).hide();
        errorUsername.innerHTML = 'Username can only consist letters,numbers, and it should be atleast 8 characters long';
        return false;
    }
    errorUsername.innerHTML = '';
    $('#uerr').eq(0).hide();
    $('#usuc').eq(0).show();
    return true;
}

function validateEmail() {
    const errorEmail = document.getElementById('errorEmail');
    const email = document.getElementById('reg-email').value;

    if (email.length == 0) {
        $('#emerr').eq(0).show();
        $('#emsuc').eq(0).hide();
        errorEmail.innerHTML = 'Email is required';
        return false;
    }
    if (!email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
        $('#emerr').eq(0).show();
        $('#emsuc').eq(0).hide();
        errorEmail.innerHTML = 'Enter a valid email address';
        return false;
    }
    errorEmail.innerHTML = '';
    $('#emerr').eq(0).hide();
    $('#emsuc').eq(0).show();
    return true;
}

function validatePass() {
    const errorPass = document.getElementById('errorPass');
    const pass = document.getElementById('reg-password').value;

    if (pass.length == 0) {
        $('#perr').eq(0).show();
        $('#psuc').eq(0).hide();
        errorPass.innerHTML = 'Password is required';
        return false;
    }
    if (!pass.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/)) {
        $('#perr').eq(0).show();
        $('#psuc').eq(0).hide();
        errorPass.innerHTML = 'Password should be minimum of eight characters, at least one uppercase letter, one lowercase letter and one number';
        return false;
    }
    errorPass.innerHTML = '';
    $('#perr').eq(0).hide();
    $('#psuc').eq(0).show();
    return true;
}

function verifyPass() {
    const errorCon = document.getElementById('errorCon');
    const pass = document.getElementById('reg-password').value;
    const con = document.getElementById('confirm_password').value;

    if (con.length == 0) {
        $('#conerr').eq(0).show();
        $('#consuc').eq(0).hide();
        errorCon.innerHTML = 'Confirm password is required';
        return false;
    }
    if (con != pass) {
        $('#conerr').eq(0).show();
        $('#consuc').eq(0).hide();
        errorCon.innerHTML = 'Password did not match';
        return false;
    }
    errorCon.innerHTML = '';
    $('#conerr').eq(0).hide();
    $('#consuc').eq(0).show();
    return true;
}