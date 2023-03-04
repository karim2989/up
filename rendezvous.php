<style>
  body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
  }
  
  .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
  }
  
  h1 {
    font-size: 24px;
    margin-top: 0;
  }
  
  form {
    margin-top: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input[type="email"],
  input[type="password"] {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 20px;
  }
  
  button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  
  button[type="submit"]:hover {
    background-color: #0069d9;
  }
</style>

<?php
// Change these variables according to your database setup
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "<p>Error while logged in</p>";
}else{
  echo "<p>Logged in Succesfuly</p>";
}

// Check if user is logged in
session_start();
if (!isset($_SESSION["id"])) {
  echo '<div class="container">
          <h1>Login</h1>
          <p>Vous devez créer un compte ou vous connecter à un compte existant.</p>
          <br>
          <a href="../sign.html">Cliquez ici pour créer votre compte</a>
        </div>';
} else {
  echo '<div class="container">
          <h1>Login</h1>
          <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
            <div class="form-group">
              <label for="subject">Sujet</label>
              <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
              <label for="date">Demande de date</label>
              <input type="date" id="date" name="datedemande" required>
            </div>
            <button type="submit">Envoyer</button>
          </form>
        </div>';
}
//Send received data to the database
$subject = $_POST["subject"];
$requestedate = $_POST["datedemande"];
$subject = mysqli_real_escape_string($conn, $subject); // Escape the variable to prevent SQL injection
$requestedate = mysqli_real_escape_string($conn, $requestedate); // Escape the variable to prevent SQL injection
$requested = "INSERT INTO demandeconsultation (texte,date) VALUES ('$subject','$requestedate')";

// Close connection
$conn->close();
?>
