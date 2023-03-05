<!DOCTYPE html>
<html>
<head>
	<title>Page SuperUser</title>
</head>
<body>
	<h1>Bienvenue sur la page Secrétaire</h1>
	<h2>Créer un nouveau secrétaire</h2>
<form method="post" action="">
	<label for="id">ID:</label>
	<input type="number" id="id" name="id" required>
	<input type="submit" name="create" value="Créer">
</form>

<!-- Form to delete a secretary -->
<h2>Supprimer un secrétaire</h2>
<form method="post" action="">
	<label for="id">ID:</label>
	<input type="number" id="id" name="id" required>
	<input type="submit" name="delete" value="Supprimer">
</form>

  <?php
      // Afficher la liste des secrétaires
	  $result = $conn->query("SELECT * FROM secretaire");
	  if ($result->num_rows > 0) {
		  echo "<h2>Liste des secrétaires</h2>";
		  echo "<table border='1'><tr><th>ID</th></tr>";
		  while ($row = $result->fetch_assoc()) {
			  echo "<tr><td>" . $row['id'] . "</td><td>";
			  echo "<form method='post' action=''>";
			  echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
			  echo "<input type='submit' name='delete' value='Supprimer'>";
			  echo "</form>";
			  echo "</td></tr>";
		  }
		  echo "</table>";
	  } else {
		  echo "<p>Aucun secrétaire n'a été trouvé.</p>";
	  }
  // Afficher la liste des demandes de consultation
  $result = $conn->query("SELECT * FROM demandeconsultation");
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['patient'] . "</td>";
      echo "<td>" . $row['date'] . "</td>";
      echo "<td>" . $row['prenom'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['temps'] . "</td>";
      echo "<td>" . $row['datedemande'] . "</td>";
      echo "<td>" . $row['tempsdemande'] . "</td>";
      echo "<td>" . $row['texte'] . "</td>";
      echo "<td>" . $row['accepte'] . "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='9'>Aucune demande de consultation n'a été trouvée.</td></tr>";
  }
  ?>
</table>
<!-- Logout button -->
<form method="post" action="">
	<input type="submit" name="logout" value="Déconnexion">
</form>

	<?php
		// Vérifier si l'utilisateur est connecté en tant que superuser
		session_start();
		if (!isset($_SESSION['superuser'])) {
			header("Location: login.php");
			exit();
		}

		// Traiter les actions de création et de suppression de secrétaire
		require_once('secretaire.php');
		if (isset($_POST['create'])) {
			$id = $_POST["id"];
			$stmt = $conn->prepare("INSERT INTO secretaire VALUES ($id)");
			$stmt->execute();
			echo "<p>Le secrétaire a été créé avec succès.</p>";
			$stmt->close();
		}
		if (isset($_POST['delete'])) {
			$id = $_POST['id'];
			$stmt = $conn->prepare("DELETE FROM secretaire WHERE id=?");
			$stmt->bind_param("i", $id);
			$stmt->execute();
			echo "<p>Le secrétaire a été supprimé avec succès.</p>";
			$stmt->close();
		}

		// Afficher la liste des secrétaires
		$result = $conn->query("SELECT * FROM secretaire");
		if ($result->num_rows > 0) {
			echo "<h2>Liste des secrétaires</h2>";
			echo "<table border='1'><tr><th>ID</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row['id'] . "</td><td>";
				echo "<form method='post' action=''>";
				echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
				echo "<input type='submit' name='delete' value='Supprimer'>";
				echo "</form>";
				echo "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "<p>Aucun secrétaire n'a été trouvé.</p>";
		}
?>