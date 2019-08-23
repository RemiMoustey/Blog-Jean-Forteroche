<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name=viewport content="width=device-width, initial-scale=1.0" />
		<title>Rédaction d'un billet</title>
		<script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
		<script>
		tinymce.init({
		selector: '#mytextarea'
		});
		</script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous" />
		<link rel="stylesheet" href="./../public/css/font-families.css" />
		<link rel="stylesheet" href="../public/css/main.css" />
		<link rel="stylesheet" href="../public/css/navbar.css" />
		<link rel="stylesheet" href="../public/css/hero.css" />
		<link rel="stylesheet" href="../public/css/body.css" />
		<link rel="stylesheet" href="../public/css/form-login.css" />
		<link rel="stylesheet" href="../public/css/links.css" />
		<link rel="stylesheet" href="../public/css/media-queries.css" />
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<ul class="nav navbar-nav">
				<li><a href="./../index.php">Accueil</a></li>
				<li><a href="./adminChapters.php">Chapitres</a></li>
				<li><a href="logout.php">Se déconnecter</a></li>
			</ul>
		</nav>
		<div class="hero">
			<img src="../public/img/hero.jpg" alt="Un paysage d'Alaska" />
		</div>
		<div class="text-image">
			<h1><span class="main-title">Billet simple pour l'</span><span class="title-ending">Alaska</span></h1>
		</div>
		<p class="link-home"><a href="adminChapters.php">Retour aux chapitres</a>

		<div class="redaction">
			<h2>Rédaction d'un chapitre</h2>
			<?php if(isset($_GET['id']))
			{ ?> <form method="post" action="adminChapters.php?action=updatePost&amp;id=<?= $_GET['id'] ?>"> <?php }
			else
			{ ?> <form method="post" action="adminChapters.php?action=addPost"> <?php } ?>
				<label for="title">Titre :</label>
				<input type="text" name="title" value="<?php if(isset($_GET['id'])) echo $post['title'] ?>" />
				<br />
				<label for="content">Billet :</label>
				<textarea name="content" id="mytextarea"><?php if(isset($_GET['id'])) echo $post['content'] ?></textarea>
				<button class="btn btn-default" type="submit" onclick="return(confirm('Êtes-vous sûr de vouloir poster ce billet ?'));">Publier</button>
			</form>
		</div>
	</body>
</html>