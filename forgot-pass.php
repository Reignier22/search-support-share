<?php 
$page_title = '3S | Forgot Password Page';
include 'connections/config.php';
?>

<?php 
include 'includes/header.php'; 
$jumbo_title = 'Forgot Password';
include 'includes/pages.php'
?>   

<style>

.grid-container {
    display: grid;
    grid-template-columns: auto auto auto;
}
.grid-item {
    text-align: center;
}

.grid-item.login-form{
    background-color: #fff;
    border-radius: 5px;
    padding: 30px;
    width: 100%;
    height: 470px;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}

.login-form img{
    width: 300px;
    height: 200px;
}

.login-form input{
    border: 1px solid #ccc;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 3px 3px 0px;
    width: 250px;
    height: 30px;
    padding-left: 5px;
    transition: ease-in-out 0.3s;
    margin: 5px;
}

.login-form input:focus{
    box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    outline: none;
}

.login-form input.submit{
    background-color: #77A6F7 ;
    font-size: 15px;
    color: #fff;
    height: 40px;
}

.login-form a{
    color: #ccc;
    text-decoration: none;
}

.login-form a:hover{
    color: #77A6F7;
}

</style>

<div class="container">

<div class="grid-container">
    <div class="grid-item"></div>

    <div class="grid-item login-form">
        <img src="assets/home-plugins/img/forgot.png" alt="">
        <h3>Reset your password?</h3>
        <p>Please enter your email address. You will receive an email message <br> with instructions on how to reset your password.</p>
        <form action="connections/recover.php" method="POST" autocomplete="off">
        <input type="text" name="email"  placeholder="Enter your email address"> <br>
        <input type="submit" name="recover" class="submit" value="Continue" > <br>
        <a href="index.php">Back to home</a>
        </form>
        

    </div>

    <div class="grid-item"></div>
</div>

</div>


<br>


<?php include 'includes/footer.php'; ?> 

