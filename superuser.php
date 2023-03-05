<!DOCTYPE html>
<html>
<head>
	<title>Page Secrétaire</title>
</head>
<body>
	<h1>Bienvenue sur la page medcine</h1>

	<?php
		// Vérifier si l'utilisateur est connecté en tant que superuser
		session_start();
		

		// Traiter les actions de création et de suppression de secrétaire
		require_once('config.php');
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

		// Afficher la liste des demandes de consultation
		$result = $conn->query("SELECT * FROM demandeconsultation");
		if ($result->num_rows > 0) {
			echo "<h2>Liste des demandes de consultation</h2>";
			echo "<table border='1'><tr><th>Patient</th><th>Date</th><th>Prénom</th><th>Email</th><th>temps</th><th>Date de demande</th><th>temps</th><th>texte</th><th>accepte</th></tr>";
			while ($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row['patient'] . "</td><td>" . $row['Date'] . "</td><td>". $row['temps'] ."</td><td>" . $row['texte'] . "</td><td>" . $row['accepte'] . "</td></tr>";
			}
			if (isset($_POST['logout'])) {
				session_destroy();
				header('Location: index.php');
                }
            } else {
                echo "<p>Veuillez vous connecter pour accéder à cette page.</p>";
            }
            $conn->close();
?>