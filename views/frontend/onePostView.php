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
		<?php
			$commentsArray = $comments->fetchAll();
			if(!empty($commentsArray))
			{
			?>
				<h2 id="anchor-comments">Commentaires</h2>
			<?php
			}
			$notifiedCommentsArray = $notifiedComments->fetchAll();
			foreach ($commentsArray as $data)
			{
			?>
			<div class="bloc-comment">
				<h4>
					<?= htmlspecialchars($data['author']) ?>
					<span class="comment-date"><?= htmlspecialchars($data['creation_date_fr']) ?></span>
				</h4>
				<p>
					<?= htmlspecialchars($data['comment']) ?>
				</p>
				<?php

				if (empty($notifiedCommentsArray))
				{
					?>
					<p class="report-link">
						<a href="adminIndex.php?action=notifyComment&amp;id=<?= $data['id'] ?>"><i class="fas fa-exclamation-circle"></i> Signaler</a>
					</p>
				<?php
				}
				else
				{
					for($i = 0; $i < count($notifiedCommentsArray); $i++)
					{
						if (in_array($data['id'], $notifiedCommentsArray[$i]))
						{
				?>
							<p>Ce commentaire a déjà été signalé.</p>
				<?php
							break;
						}
						elseif ($i === count($notifiedCommentsArray) - 1)
						{
				?>
							<p class="report-link">
							<a href="adminIndex.php?action=notifyComment&amp;id=<?= $data['id'] ?>"><i class="fas fa-exclamation-circle"></i> Signaler</a>
						</p>
				<?php
						}
					}
				}
				?>
			</div>
			<?php
			}
			$comments->closeCursor();
			?>
			<div class="form_add_comment">
				<h2>Ajouter un commentaire</h2>
				<form method="post" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
					<label for="author" required>Auteur :</label>
					<input type="text" name="author" class="form-control" required />
					<label for="comment">Commentaire :</label>
					<textarea name="comment" class="form-control" rows="4" required></textarea>
					<button type="submit" id="submit-comment">Envoyer</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>