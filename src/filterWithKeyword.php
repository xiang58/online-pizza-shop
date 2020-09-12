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

$keyword = $_POST['keyword'];
$output = [];

$query="SELECT * FROM pizza WHERE deleted=0";

if ($keyword != "") {
	$query .= " AND category='".$keyword."'";
}

$result = mysqli_query($con, $query);


while($row = mysqli_fetch_array($result)) {
	$myObj->id = $row["pizza_id"];
	$myObj->name = $row["pizza_name"];
	$myObj->description = $row["description"];
	$output[] = json_encode($myObj);
}

echo json_encode($output);

mysqli_close($con);

?>
