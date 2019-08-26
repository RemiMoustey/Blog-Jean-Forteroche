<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>

<?php $error = null;
if(!empty($_POST['login']) AND !empty($_POST['password']))
{
	if ($_POST['login'] === $logs['login'] AND (password_verify($_POST['password'], $logs['hashed_password'])))
	{
		session_start();
		$_SESSION['authenticated'] = 1;
		header('Location: ./admin/adminChapters.php');
	}
	else
	{
		$error = "Identifiants incorrects";
	}
}

require_once 'admin/auth.php';
if(isAuthenticated())
{
	header('Location: ./admin/adminChapters.php');
}

?>

<?php if ($error)
{ ?>
<div class="alert alert-danger incorrect-ids">
	<?= $error ?>
</div>
<?php } ?>

<div class="form-login">
	<h2>Connexion</h2>
	<form method="post" action="#" >
		<label for="login">Login :</label>
		<input type="text" name="login" id="login" class="form-control" required />
		<br />
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" id="password" class="form-control" required />
		<button class="btn btn-default" type="submit">Se connecter</button>
	</form>
</div>

<?php $content = ob_get_clean() ?>
<?php require('./public/template.php') ?>