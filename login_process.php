<?php
session_start();
require "db.php";

$email= $_POST['email'];
$password = $_POST['password'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();
if(!$user || password_verify($password,$user['password']))
{
    die("Email ou mot de passe invalide");
}

$_SESSION['user_id']=$user['id'];
$_SESSION['username']=$user['username'];
$_SESSION['role']=$user['role'];

if($user['role']=='user'){
    header("Location: userdashboard.php");
}
else{
    header("Location: admindashboard.php");
}
