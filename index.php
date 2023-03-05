<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cabinet Dr.Sliman Labiedh</title>
	<link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>
<body>
	<header class="flexh">
		<nav class="flexh">
			<ul class="flexh jleft">
				<li><a href="#home">Accueil</a></li>
				<li><a href="#info">Information</a></li>
				<li><a href="#testimonials">Témoignages</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
			<div class="flexh jright">

				
				<?php
					session_start();
					ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

					//print_r($_SESSION);
					if (!isset($_SESSION["id"])) {
						print("<button><a href='./sign.html'>Sign in/Sign up</a></button>");
					}
					else {
						
						$ispat = false;
						$issec = false;
						$issuper = false;
						
						print("<button><a href='./logout.php'>Log out</a></button>");

						$conn = new mysqli('localhost', 'root', 'root', 'cabinet');
						if ($conn->connect_error) {
							die("server error: " . $conn->connect_error);
						}
						
						$res = $conn->query("select * from patient p, personne e where p.id = e.id and e.email='".$_SESSION["email"]."' and e.pwd='".hash("md5",$_SESSION["pwd"])."'");
						$ispat = $res->num_rows > 0;

						$res = $conn->query("select * from secretaire p, personne e where p.id = e.id and e.email='".$_SESSION["email"]."' and e.pwd='".hash("md5",$_SESSION["pwd"])."'");
						$issec = $res->num_rows > 0;

						$res = $conn->query("select * from superuser p, personne e where p.id = e.id and e.email='".$_SESSION["email"]."' and e.pwd='".hash("md5",$_SESSION["pwd"])."'");
						$issuper = $res->num_rows > 0;
						
						
						if($ispat){
							print("<button><a href='./espaceclient.php'>espace patient</a></button>");
						}
						if ($issec) {
							print("<button><a href='./secretaire.php'>espace secritaire</a></button>");
						}
						if ($issuper) {
							print("<button><a href='./superuser.php'>espace medcin</a></button>");
						}
						
						echo($conn->error);
					}		
					?>
	</div>
		</nav>
	</header>
	
	<main>
		<section class="flexh" id="home">
			<img src="slimane.png" alt="">
			<div class="flexv">
				<h1>Dr. Slimane labiedh</h1>
				<p>Docteur specialisé psychothérapeute.</p>
				<p>Professeur a l universite de Manouba.</p>
				<br>
			</div>
		</section>

		<section id="info">
			<h2>Information</h2>
			<p>Voici toutes les informations dont vous avez besoin pour votre consultation sont bien presenté ici :</p>
			<ul>
				<li>Horaires d'ouverture : lundi au vendredi de 8h à 19h</li>
				<li>Adresse : 123 rue virtuelle, 1000 Grand Tunis</li>
				<li>Téléphone : +216 20 123 456</li>
				<li>E-mail : slimen@labiedh.com</li>
			</ul>
		</section>

		<section id="testimonials">
			
		<section id="contact">
			<h2>Contactez-nous</h2>
            <form>
                <div class="form-group">
                  <label for="name">Nom et prénom :</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                  <label for="email">E-mail :</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                  <label for="message">Message :</label>
                  <textarea class="form-control" id="message" name="message" required></textarea>
                </div>
                <div class="form-group d-flex justify-content-end">
                  <button type="reset" class="btn btn-secondary mr-2">Annuler</button>
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
              </form>
		</section>
	</main>

	<footer>
		<p>© 2023 Dr. Labiedh - Tous les droits sont reserves</p>
    </footer>
</body>
</html>

