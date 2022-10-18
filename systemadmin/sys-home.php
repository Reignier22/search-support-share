<?php 
session_start();
if(!isset($_SESSION['aid'])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>System Developer Home</title>
    <link rel="stylesheet" href="style_home.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="img" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title" style="text-transform: capitalize;">Hello, <?= $_SESSION['username']?> 👋 </h3>
          <p class="text">
            As a system administrator, one of your goal is to make an account for the 3S super user and staff.
            You can start now by filling out all the fields.
          </p>

          <div class="info">
            <div class="information">
              <img src="img/nier.png" class="icon" alt="" />
              <p>Enabore, Reignier D. -Programmer</p>
            </div>
            <div class="information">
              <img src="img/dha.png" class="icon" alt="" />
              <p>Dorado Dharel U. -Creative</p>
            </div>
            <div class="information">
              <img src="img/rish.png" class="icon" alt="" />
              <p>Bautista, Irish S. -Project Manager</p>
            </div>
          </div>

          <div class="social-media">
            <p>3S Administrators:</p>
            <div class="social-icons">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="add.php" id="addForm" autocomplete="off">
            <div class="headers">
            <h3 class="title">Add New Admin</h3>
            <a href="logout.php" class="logout">Logout</a>
            </div>
            <div class="input-container">
              <input type="text" name="username" id="username" class="input" />
              <label for="username">Username</label>
              <span>Username</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" id="email" class="input" />
              <label for="email">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="number" name="access_level" id="access_level" class="input" />
              <label for="access_level">Access Level</label>
              <span>Access level</span>
            </div>
            <div class="input-container">
              <input type="password" name="password" id="password" class="input" />
              <label for="password">Password</label>
              <span>Password</span>
            </div>

            <div class="input-container">
              <input type="password" name="confirm_password" id="confirm_password" class="input" />
              <label for="confirm_password">Confirm password</label>
              <span>Confirm Password</span>
            </div>

            <input type="submit" name="add" id="add" value="Add" class="btn" />

          </form>
        </div>
      </div>
    </div>

<script>
const inputs = document.querySelectorAll(".input");
  function focusFunc() {
  let parent = this.parentNode;
        parent.classList.add("focus");
      }

      function blurFunc() {
        let parent = this.parentNode;
        if (this.value == "") {
          parent.classList.remove("focus");
        }
      }

      inputs.forEach((input) => {
        input.addEventListener("focus", focusFunc);
        input.addEventListener("blur", blurFunc);
      });
    </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script>
$(document).ready(function() {

    $("#addForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response == "empty"){
                    alert('Please fill out all the fields');
                }
                else if (response == 'invalid email') {
                    alert('Please enter a valid email address');
                }
                else if (response == 'mismatch') {
                    alert('Password did not match, please try again.');
                }
                else if (response == 'ok') {
                    alert('A new admin has been added successfully');
                    $('#addForm')[0].reset();
                } else {
                    alert('An error has occured. Try messaging us again');
                }
            }
        });
    });
});
</script>


  </body>
</html>