<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous" />
		<link rel="stylesheet" href="../public/css/styles.css" />
		<title> <?= $title ?></title>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="adminIndex.php">Accueil</a></li>
					<li><a href="logout.php">Se déconnecter</a></li>
				</ul>
			</div>
		</nav>
		<div class="hero">
			<img src="../public/img/hero.jpg" alt="Un paysage d'Alaska" />
		</div>
		<div class="text-image">
			<h1><span class="title-principle">Billet simple pour l'</span><span class="title-ending">Alaska</span></h1>
		</div>
		<?= $content ?>
	</body>
</html>