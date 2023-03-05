<!DOCTYPE html>
<html>
<head>
	<title>Supprimer un patient</title>
</head>
<body>
	<h2>Supprimer un patient existant</h2>
	<form method="post">
		<label for="id">ID du patient:</label>
		<input type="text" id="id" name="id" required>
		<br>
		<input type="submit" name="supprimer_patient" value="Supprimer patient">
	</form>
	<?php
		// connexion à la base de données
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "cabinet";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		  die("Connexion échouée: " . $conn->connect_error);
		}

		// afficher la liste des patients
		$sql = "SELECT * FROM personne";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		  echo "<table><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Téléphone</th><th>Email</th></tr>";
		  while($row = $result->fetch_assoc()) {
		    echo "<tr><td>".$row["id"]."</td><td>".$row["nom"]."</td><td>".$row["prenom"]."</td><td>".$row["naissance"]."</td><td>".$row["tel"]."</td><td>".$row["email"]."</td></tr>";
		  }
		  echo "</table>";
		} else {
		  echo "Aucun patient trouvé.";
		}
		// supprimer un patient existant
		if(isset($_POST['supprimer_patient'])) {
		  $id = $_POST['id'];
		  $sql = "DELETE FROM personne WHERE id='$id'";
		  if ($conn->query($sql) === TRUE) {
		    echo "Patient supprimé avec succès.";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
		  } else {
		    echo "Erreur: " . $sql . "<br>" . $conn->error;
		  }
		}
		$conn->close();
	?>
</body>
</html>