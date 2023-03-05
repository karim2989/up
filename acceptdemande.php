<?php
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$conn = new mysqli('localhost', 'root', 'root', 'cabinet');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();

$uid = mysqli_fetch_array($conn->query("select id from presonne where nom='".$_POST["name1"]."' and prenom='".$_POST["name2"]."'"))[0];

$date = $_POST["date"];
$temps = $_POST["temps"];
$conn->query("insert into consultation (patient,date,tempsdebut) VALUES ('".$uid."','".$date."','".$temps."')");
header('Location: ./espaceclient.php');
print($conn->error);
?>
