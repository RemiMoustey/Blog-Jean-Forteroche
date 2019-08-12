<?php $title = htmlspecialchars($post['title']) ?>
<?php ob_start() ?>

<div class="one-new-index">
	<p class="link-home"><a href="index.php">Retour à l'accueil</a>
	<div class="one-new">
		<div class="article">
			<h2 class="new-title"><?= $title ?></h2>
			<h3>
				Le <?= $post['creation_date_fr'] ?>
			</h3>

			<p>
				<?= $post['content'] ?>
			</p>
		</div>

		<div class="comments">
			<h2 id="anchor-comments">Commentaires</h2>
			<?php
			while ($data = $comments->fetch())
			{
				?>
				<h4>
					<span class="comments-author"><?= htmlspecialchars($data['author']) ?></span>
					<span class="comments-date"><?= htmlspecialchars($data['creation_date_fr']) ?></span>
				</h4>
				<p>
					<?= nl2br(htmlspecialchars($data['comment'])) ?>
				</p>
				<p class="report-link">
					<a href="index.php?action=notifyComment&amp;id=<?= $data['id'] ?>"><i class="fas fa-exclamation-circle"></i> Signaler</a>
				</p>
				<?php
			}
			$comments->closeCursor();
			?>
			<div class="form_add_comment">
				<h2>Ajouter un commentaire</h2>
				<form method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
					<label for="author">Auteur :</label>
					<input type="text" name="author" class="form-control" />
					<label for="comment">Commentaire :</label>
					<textarea name="comment" class="form-control" rows="4"></textarea>
					<button type="submit">Envoyer</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>