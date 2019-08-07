<?php $title = htmlspecialchars($post['title']) ?>
<?php ob_start() ?>

<p><a href="index.php">Retour à la l'accueil</a>
<h1><?= $title ?></h1>
<h3>
	<?= $post['title'] ?>
	<?= $post['creation_date_fr'] ?>
</h3>

<p>
	<?= $post['content'] ?>
</p>

<h2>Commentaires</h2>
<div class="comments">
	<?php
	while ($data = $comments->fetch())
	{
	?>
	<h4>
		<?= htmlspecialchars($data['author']) ?>
		<?= htmlspecialchars($data['creation_date_fr']) ?>
	</h4>
	<p>
		<?= htmlspecialchars($data['comment']) ?>
	</p>
	<p>
		<a href="index.php?action=notifyComment&amp;id=<?= $data['id'] ?>"><i class="fas fa-exclamation-circle"></i>Signaler</a>
	</p>
	<?php
	}
	$comments->closeCursor();
	?>
</div>

<div class="form_add_comment">
	<form method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
		<label for="author">Auteur :</label>
		<input type="text" name="author" />
		<label for="comment">Commentaire :</label>
		<textarea name="comment"></textarea>
		<button type="submit">Envoyer</button>
	</form>
</div>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>