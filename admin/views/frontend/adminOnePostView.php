<?php $title = htmlspecialchars($post['title']) ?>
<?php ob_start() ?>

<div class="one-new-index">
	<p class="link-home"><a href="adminIndex.php">Retour à l'accueil</a>
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
			<h2 id="anchor-comments">Commentaires</h2>
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
			<p class="report-link">
				<a href="adminIndex.php?action=notifyComment&amp;id=<?= $data['id'] ?>"><i class="fas fa-exclamation-circle"></i> Signaler</a>
			</p>
			<?php
			}
			$comments->closeCursor();
			?>
			<div class="form_add_comment">
				<h2>Ajouter un commentaire</h2>
				<form method="post" action="adminIndex.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
					<label for="author">Auteur :</label>
					<input type="text" name="author" class="form-control" />
					<label for="comment">Commentaire :</label>
					<textarea name="comment" class="form-control" rows="4"></textarea>
					<button type="submit">Envoyer</button>
				</form>
			</div>
			<h2>Commentaires signalés</h2>
			<div class="notified_comments">
			<?php
				while ($data = $notifiedComments->fetch())
				{
				?>
					<div class="reported-comment">
						<h4>Commentaire signalé le <?= htmlspecialchars($data['notify_date_fr']) ?></h4>

						<h5>Auteur</h5>
						<p><?= htmlspecialchars($data['author']) ?></p>

						<h5>Commentaire</h5>
						<p><?= htmlspecialchars($data['comment']) ?></p>

						<p class="delete-comment-link"><a href="adminIndex.php?action=removeComment&amp;id=<?= $data['id'] ?>">Supprimer</a></p>
					</div>
				<?php
				}
				$comments->closeCursor();
				?>
			</div>
		</div>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('adminTemplate.php') ?>