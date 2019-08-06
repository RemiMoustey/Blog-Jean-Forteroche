<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="./../public/css/styles.css" />
		<title> <?= $title ?></title>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Accueil</a></li>
					<li><a href="index.php">Se déconnecter</a></li>
				</ul>
			</div>
		</nav>
		<?= $content ?>
	</body>
</html>