<?php
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$conn = new mysqli('localhost', 'root', 'root', 'cabinet');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
session_start();

$subject = $_POST["subject"];
$temps = $_POST["temps"];
$requestedate = $_POST["datedemande"];
$conn->query("insert into demandeconsultation (patient,temps,texte,date) VALUES ('".$_SESSION['id']."','".$temps."','".$subject."','".$requestedate."')");
header('Location: ./espaceclient.php');
print($conn->error);
?>
