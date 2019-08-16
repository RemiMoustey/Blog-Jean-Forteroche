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

		<div class="comments" id="anchor-comments">
		<?php
			$commentsArray = $comments->fetchAll();
			if(!empty($commentsArray))
			{
			?>
				<h2>Commentaires</h2>
			<?php
			}
			$notifiedCommentsArray = $notifiedComments->fetchAll();
			foreach ($commentsArray as $data)
			{
			?>
			<div class="bloc-comment">
				<h4>
					<span class="bold"><?= htmlspecialchars($data['author']) ?></span>
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
						<a href="index.php?action=notifyComment&amp;id=<?= $data['id'] ?>#anchor-comments" onclick="return(confirm('Êtes-vous sûr de vouloir signaler ce commentaire ?'));"><i class="fas fa-exclamation-circle"></i> Signaler</a>
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
							<p class="already-reported">Ce commentaire a été signalé.</p>
				<?php
							break;
						}
						elseif ($i === count($notifiedCommentsArray) - 1)
						{
				?>
							<p class="report-link">
							<a href="index.php?action=notifyComment&amp;id=<?= $data['id'] ?>#anchor-comments" onclick="return(confirm('Êtes-vous sûr de vouloir signaler ce commentaire ?'));"><i class="fas fa-exclamation-circle"></i> Signaler</a>
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
					<button class="btn btn-default" type="submit" onclick="return(confirm('Êtes-vous sûr de vouloir poster ce commentaire ?'));">Envoyer</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('./public/template.php') ?>