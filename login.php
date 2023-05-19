<?php
if($_POST)
{
    $server_name="localhost";
$username="root";
$password="";
$database_name="cart_db";
    $conn=mysqli_connect($server_name,$username,$password,$database_name);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * from signup where username = '$username' and password = '$password'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1)
    {
        session_start();
        $_SESSION['auth'] = 'true';
        header('location:MAIN_PAGE.php');
    }
    else{
        echo 'wrong username or password';
        }
}