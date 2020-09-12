<?php

$host = "localhost";
$user = "root";
$password = "root";
$db = "online_pizza";
$port = 3306;
$con = mysqli_connect($host, $user, $password, $db, $port);
if (!con) {
	echo "Connection failed";
	exit(1);
}

$email = $_GET['email'];
$query = "select * from users where email='" . $email . "';";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {echo 'Used';}
else {echo 'Good';}
mysqli_close($con);

?>
