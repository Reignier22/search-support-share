<?php
include 'dbController.php';

$jsQuery = mysqli_query($conn, "SELECT * FROM `job_Seekers` ");
$js = mysqli_num_rows($jsQuery);

$emQuery = mysqli_query($conn, "SELECT * FROM `employers` ");
$emp = mysqli_num_rows($emQuery);

$cmQuery = mysqli_query($conn, "SELECT * FROM `campaigns` ");
$cmp = mysqli_num_rows($cmQuery);

$jbQuery = mysqli_query($conn, "SELECT * FROM `jobs` ");
$jb = mysqli_num_rows($jbQuery);

$cnQuery = mysqli_query($conn, "SELECT * FROM `donations` ");
$cn = mysqli_num_rows($cnQuery);

$donate = mysqli_query($conn, "SELECT amount FROM donations");
$sum = 0;
while($donate_fetch = mysqli_fetch_assoc($donate)){
    $sum += $donate_fetch['amount'];
}

$rpQuery = mysqli_query($conn, "SELECT * FROM `reports` ");
$rp = mysqli_num_rows($rpQuery);

$stQuery = mysqli_query($conn, "SELECT * FROM `admin_table` WHERE access_level='2' ");
$st = mysqli_num_rows($stQuery);

$vsQuery = mysqli_query($conn, "SELECT * FROM `visitors` ");
$vs = mysqli_num_rows($vsQuery);

$apQuery = mysqli_query($conn, "SELECT * FROM `apply` WHERE status IN ('approved', 'short-listed') ");
$ap = mysqli_num_rows($apQuery);

$appQuery = mysqli_query($conn, "SELECT * FROM `apply`");
$app = mysqli_num_rows($appQuery);

$emcQuery = mysqli_query($conn, "SELECT jobs.empid AS 'empid', count(jobs.empid) as 'count_of_emp' FROM jobs INNER JOIN employers ON employers.empid = jobs.empid  group by empid;");
$emc = mysqli_num_rows($emcQuery);

$conQuery = mysqli_query($conn, "SELECT * FROM contact WHERE status='1' ");
$con = mysqli_num_rows($conQuery);

$catQuery = mysqli_query($conn, "SELECT * FROM categories");
$cat = mysqli_num_rows($catQuery);

$notif_query = mysqli_query($conn, "SELECT * FROM `audit` WHERE status='1'");
$notif = mysqli_num_rows($notif_query);

$fetch_query = mysqli_query($conn, "SELECT * FROM content_manage WHERE cmid = '1' ");
$fetch_slider = mysqli_fetch_array($fetch_query); 

$fetch_query1 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '1' ");
$fetch_fb = mysqli_fetch_array($fetch_query1); 

$fetch_query2 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '2' ");
$fetch_tw = mysqli_fetch_array($fetch_query2); 

$fetch_query3 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '3' ");
$fetch_in = mysqli_fetch_array($fetch_query3); 

$fetch_query4 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '4' ");
$fetch_tk = mysqli_fetch_array($fetch_query4); 

$fetch_query5 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '5' ");
$fetch_yt = mysqli_fetch_array($fetch_query5); 

$contact_query = mysqli_query($conn, "SELECT line_1, line_2 FROM content_manage WHERE cmid = '1' ");
$fetch_con = mysqli_fetch_array($contact_query);

