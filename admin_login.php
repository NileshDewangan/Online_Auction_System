<?php
if($_POST)
{
    $server_name="localhost";
$username="root";
$password="";
$database_name="cart_db";
    $conn=mysqli_connect($server_name,$username,$password,$database_name);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * from admin_login where email = '$email' and password = '$password'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==1)
    {
        session_start();
        $_SESSION['auth'] = 'true';
        header('location:admin_page.php');
    }
    else{
        echo 'wrong username or password';
        }
}