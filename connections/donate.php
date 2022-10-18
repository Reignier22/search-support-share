<?php 
include 'config.php';

if (isset($_POST['donate'])) {
    $cid = mysqli_real_escape_string($conn, $_POST['cidPHP']);
    $jsid = mysqli_real_escape_string($conn, $_POST['jsidPHP']);
    $name = mysqli_real_escape_string($conn, $_POST['namePHP']);
    $amount = mysqli_real_escape_string($conn, $_POST['amountPHP']);
    $message = mysqli_real_escape_string($conn, $_POST['messagePHP']);
    $reference = mysqli_real_escape_string($conn, $_POST['refPHP']);

    $insert = $conn->query("INSERT donations (jsid, cid, name, amount, message, ref, status) VALUES ('" . $jsid . "', '" . $cid . "', '" . $name . "','" . $amount . "' ,'" . $message . "' ,'" . $reference . "' ,'". '1' ."' )");
    echo $insert ? 'ok' : 'err';
}

?>