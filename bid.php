<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="cart_db";

$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{
	die("Connection Failed:" . mysql_connect_errors());
}

if(isset($_POST['save']))
{
	$pid = $_POST['pid'];
	$price = $_POST['price'];
	
	$sql_query="INSERT INTO bid(pid,price)
	VALUES('$pid','$price')";
	
	if (mysqli_query($conn, $sql_query))
	{
		echo "";
	}
	else
	{
		echo "Error: " . $sql . "" . mysqli_error($conn);
	}
	mysqli_close($conn);
}

header("Location: biddingsucc.html");
exit();
?>

