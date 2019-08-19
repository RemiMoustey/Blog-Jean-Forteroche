<?php $title = htmlspecialchars($post['title']) ?>
<?php ob_start() ?>

<div class="one-new-index">
	<p class="link-home"><a href="adminChapters.php">Retour aux chapitres</a>
	<div class="one-new">
		<div class="article">
			<div class="header-article">
				<div class="title-date-one-post">
					<h2 class="new-title"><?= $title ?></h2>
					<h3>
						<?= $post['creation_date_fr'] ?>
					</h3>
				</div>
				<p class="modify-delete-one-post link-posts">
					<a href="adminChapters.php?action=modifyPost&amp;id=<?= $_GET['id'] ?>">Modifier</a> <br />
					<a href="adminChapters.php?action=removePost&amp;id=<?= $_GET['id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce billet ?'));">Supprimer</a>
				</p>
			</div>
			<p>
				<?= $post['content'] ?>
			</p>
			<p class="modify-delete-one-post-bottom link-posts">
				<a href="adminChapters.php?action=modifyPost&amp;id=<?= $_GET['id'] ?>">Modifier</a> <br />
				<a href="adminChapters.php?action=removePost&amp;id=<?= $_GET['id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce billet ?'));">Supprimer</a>
			</p>
		</div>
		
		<div class="comments" id="anchor-comments">
		<?php
			$notifiedCommentsArray = $notifiedComments->fetchAll();
			if(!empty($notifiedCommentsArray))
			{
			?>
			<h2>Commentaires signalés</h2>
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

					<p class="delete-comment-link"><a href="adminChapters.php?action=removeComment&amp;id=<?= $dataNotifiedComments['comment_id'] ?>&amp;post_id=<?= $dataNotifiedComments['post_id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?'));">Supprimer</a></p>
				</div>
			<?php
			}
			$notifiedComments->closeCursor();
			?>
			</div>
			<?php
			$commentsArray = $comments->fetchAll();
			if(!empty($commentsArray))
			{
			?>
				<h2 class="comment-title">Commentaires</h2>
			<?php
			}
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
						<a href="adminChapters.php?action=notifyComment&amp;id=<?= $data['id'] ?>#anchor-comments" onclick="return(confirm('Êtes-vous sûr de vouloir signaler ce commentaire ?'));"><i class="fas fa-exclamation-circle"></i> Signaler</a>
						<p class="delete-comment-link"><a href="adminChapters.php?action=removeComment&amp;id=<?= $data['id'] ?>&amp;post_id=<?= $data['post_id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?'));">Supprimer</a></p>
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
							<a href="adminChapters.php?action=notifyComment&amp;id=<?= $data['id'] ?>"><i class="fas fa-exclamation-circle"></i> Signaler</a>
							<p class="delete-comment-link"><a href="adminChapters.php?action=removeComment&amp;id=<?= $data['id'] ?>&amp;post_id=<?= $data['post_id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?'));">Supprimer</a></p>
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
				<form method="post" action="adminChapters.php?action=addComment&amp;id=<?= $_GET['id'] ?>">
					<label for="author">Auteur :</label>
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
<?php require('./../public/template.php') ?>