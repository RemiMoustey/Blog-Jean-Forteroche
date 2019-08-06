<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Rédaction d'un billet</title>
		<script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
		<script>
		tinymce.init({
		selector: '#mytextarea'
		});
		</script>
	</head>

	<body>
		<h1>Rédaction d'un billet</h1>
		<form method="post" action="adminIndex.php?action=updatePost&amp;id=<?= $_GET['id'] ?>">
			<label for="title">Titre :</label>
			<input type="text" name="title" value="<?php if(isset($_GET['id'])) echo $post['title'] ?>" />
			<br />
			<label for="content">Billet :</label>
			<textarea name="content" id="mytextarea"><?php if(isset($_GET['id'])) echo $post['content'] ?></textarea>
			<button type="submit">Publier</button>
		</form>
	</body>
</html>