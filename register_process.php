<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
session_start();
require "db.php";

$username = $_POST['username'];
$numcontrat= $_POST['numcontrat'];
$email= $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$role="user";

$check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if($check->rowCount()>0)
{die("Email deja utilise");}

$stmt = $pdo->prepare("INSERT INTO users (username, num_contrat, email, pass, role) VALUES (?,?,?,?,?)");
$stmt->execute([$username, $numcontrat, $email, $password, $role]);

$_SESSION['user_id']=$pdo->lastInsertId();
$_SESSION['username']=$username;
$_SESSION['role']=$role;

header("Location: userdashboard.php");