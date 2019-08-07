<!DOCTYPE html>
<html>
	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="./public/css/styles.css" />
        <meta charset="utf-8" />
        <title>Connexion</title>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Accueil</a></li>
					<li class="active"><a href="login.php">Connexion</a></li>
				</ul>
			</div>
		</nav>
		<h1>Connexion</h1>
		<form method="post" action="index.php?action=connexion">
			<label for="login">Login :</label>
			<input type="text" name="login" required />
			<br />
			<label for="password">Mot de passe :</label>
			<input type="password" name="password" required />
			<button type="submit">Se connecter</button>
		</form>
	</body>
</html>