<?php
session_start();
require("connect_to_database.php");


$uname = $_POST['uname'];
$pword = $_POST['pword'];

$result = mysqli_query($conn, "SELECT username, password FROM users WHERE username = '$uname';");
$user = mysqli_fetch_assoc($result);
if ($user['password'] == md5($pword))
$_SESSION['cal_user'] = $user['username'];
else
die("Invalid Username or Password");

header("Location: /YogaCalendar");
exit;
?>