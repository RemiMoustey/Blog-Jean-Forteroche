<?php $title = htmlspecialchars($post['title']) ?>
<?php ob_start() ?>

<div class="one-new-index">
	<p class="link-home"><a href="index.php">Retour à l'accueil</a>
	<div class="one-new">
		<div class="article">
			<h2 class="new-title"><?= $title ?></h2>
			<h3>
				<?= $post['creation_date_fr'] ?>
			</h3>

			<p>
				<?= $post['content'] ?>
			</p>
		</div>

		<div class="comments">
			<h2>Commentaires</h2>
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
	</div>
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