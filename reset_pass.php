<?php 
include 'connections/config.php';
$page_title = '3S | Reset Page';

session_start();
if(!ISSET($_SESSION['token'])){
    header('location:forgot-pass.php');    
}

?>

<?php 
include 'includes/header.php'; 
$jumbo_title = 'Change Password';
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

#togglePassword{
    position: absolute;
    margin-top: 14px;
}

</style>

<div class="container">

<div class="grid-container">
    <div class="grid-item"></div>

    <div class="grid-item login-form">
        <img src="assets/home-plugins/img/reset.png" alt="">
        <h3>New Password</h3>
        <p>Please enter your password. This will serve as your new password when you login again to the system</p>

        <form action="reset_pass.php" method="POST" autocomplete="off">
            <input type="password" name="password" id="password" placeholder="Enter your new password"> 
            <br>
            <input type="submit" name="reset" class="submit" value="Continue" > <br>
            <a href="index.php">Back to home</a>
        </form>
        

    </div>

    <div class="grid-item"></div>
</div>

</div>


<br>


<?php include 'includes/footer.php'; ?>


<?php 

if(isset($_POST["reset"])){

    $token = $_SESSION['token'];
    $Email = $_SESSION['email'];

    $sql = mysqli_query($conn, "SELECT * FROM job_seekers WHERE email='$Email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if($Email){
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $query = mysqli_query($conn, "UPDATE job_seekers SET password='$password' WHERE email='$Email'");
        if($query){
            ?>
                <script>
                    alert("Your password has been successfully reset"); 
                    window.location.replace('index.php');
                </script>
            <?php
                session_unset();
                session_destroy();
        } else{
            ?>
            <script>
                alert("Some error occured. Please try again");
            </script>
        <?php
        }
    
    }else{
        ?>
        <script>
            alert("<?php echo "Please try again"?>");
        </script>
        <?php
    }
}

?>

