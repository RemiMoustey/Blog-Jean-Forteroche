<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name=viewport content="width=device-width, initial-scale=1.0" />
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous" />
		<?php
		if ($_SERVER['REQUEST_URI'] === '/projet4/public/jeanforteroche.php')
		{
		?>
			<link rel="stylesheet" href="css/styles.css" />
		<?php
		}
		elseif (preg_match("#^/projet4/admin[a-z0-9._\-/=&?]?#", $_SERVER['REQUEST_URI']))
		{
		?>
			<link rel="stylesheet" href="./../public/css/styles.css" />
		<?php
		}
		elseif (preg_match("#/projet4[a-z0-9._\-/=&?]?#", $_SERVER['REQUEST_URI']))
		{
		?>
			<link rel="stylesheet" href="./public/css/styles.css" />
		<?php
		}
		?>
		<title> <?= $title ?></title>
	</head>

	<body>
		<nav class="navbar-inverse navbar-fixed-top">
			<ul class="nav navbar-nav">
			<?php
				if ($_SERVER['REQUEST_URI'] === '/projet4/public/jeanforteroche.php')
				{
				?>
				<?php
					if (isAuthenticated())
					{
				?>
					<li><a href="./../admin/adminIndex.php">Accueil</a></li>
					<li><a href="#">Qui suis-je ?</a></li>
					<li><a href="./../admin/logout.php">Se déconnecter</a></li>
				<?php
					}
					else
					{
				?>
					<li><a href="../index.php">Accueil</a></li>
					<li><a href="#">Qui suis-je ?</a></li>
					<li><a href="../index.php?action=login">Connexion</a></li>
				<?php
					}
				}
				elseif (preg_match("#^/projet4/admin[a-z0-9._\-/=&?]?#", $_SERVER['REQUEST_URI']))
				{
				?>
				<li><a href="./adminIndex.php">Accueil</a></li>
				<li><a href="./../public/jeanforteroche.php">Qui suis-je ?</a></li>
				<li><a href="./logout.php">Se déconnecter</a></li>
				<?php
				}
				elseif (preg_match("#/projet4[a-z0-9._\-/=&?]?#", $_SERVER['REQUEST_URI']))
				{
				?>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="./public/jeanforteroche.php">Qui suis-je ?</a></li>
				<li><a href="index.php?action=login">Connexion</a></li>
				<?php
				}
				?>
			</ul>
		</nav>
		<div class="hero">
		<?php
		if ($_SERVER['REQUEST_URI'] === '/projet4/public/jeanforteroche.php')
		{
		?>
			<img src="img/hero.jpg" alt="Un paysage d'Alaska" />
		<?php
		}
		elseif(preg_match("#^/projet4/admin[a-z0-9._\-/=&?]?#", $_SERVER['REQUEST_URI']))
		{
		?>
			<img src="./../public/img/hero.jpg" alt="Un paysage d'Alaska" />
		<?php
		}
		elseif(preg_match("#/projet4[a-z0-9._\-/=&?]?#", $_SERVER['REQUEST_URI']))
		{
		?>
			<img src="./public/img/hero.jpg" alt="Un paysage d'Alaska" />
		<?php
		}
		?>
		</div>
		<div class="text-image">
			<h1><span class="main-title">Billet simple pour l'</span><span class="title-ending">Alaska</span></h1>
		</div>
		<?= $content ?>
	</body>
</html>