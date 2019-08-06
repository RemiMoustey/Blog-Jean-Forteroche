<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8" />
        <title>Connexion</title>
	</head>

	<body>
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