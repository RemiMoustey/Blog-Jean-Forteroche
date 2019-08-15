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
				<form method="post" action="adminIndex.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
					<label for="author">Auteur :</label>
					<input type="text" name="author" class="form-control" required />
					<label for="comment">Commentaire :</label>
					<textarea name="comment" class="form-control" rows="4" required></textarea>
					<button type="submit">Envoyer</button>
				</form>
			</div>
			<?php
			if(!empty($notifiedCommentsArray))
			{
			?>
			<h2 class="reported-comment-title">Commentaires signalés</h2>
			<?php
			}
			?>
			<div class="notified_comments">
			<?php
			foreach ($notifiedCommentsArray as $key => $dataNotifiedComments)
			{
			?>
				<div class="reported-comment">
					<h4>Commentaire signalé le <span class="comment-date"><?= htmlspecialchars($dataNotifiedComments['notify_date_fr']) ?></span></h4>

					<h5>Auteur</h5>
					<p><?= htmlspecialchars($dataNotifiedComments['author']) ?></p>

					<h5>Commentaire</h5>
					<p><?= htmlspecialchars($dataNotifiedComments['comment']) ?></p>

					<p class="delete-comment-link"><a href="adminIndex.php?action=removeComment&amp;id=<?= $dataNotifiedComments['comment_id'] ?>&amp;post_id=<?= $dataNotifiedComments['post_id'] ?>">Supprimer</a></p>
				</div>
			<?php
			}
			$notifiedComments->closeCursor();
			?>
			</div>
		</div>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('adminTemplate.php') ?>