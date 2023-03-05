<?php
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$conn = new mysqli('localhost', 'root', 'root', 'cabinet');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
session_start();

$text = $_POST["text"];
$conn->query("insert into remarques (ecrivant,date,texte) VALUES ('".$_SESSION['id']."','".date('y-m-d')."','".$text."')");
print($conn->error);
//header('Location: ./espaceclient.php');
print($conn->error);
?>
