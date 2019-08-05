<?php $title = htmlspecialchars($post['title']) ?>
<?php ob_start() ?>

<p><a href="index.php">Retour à la l'accueil</a>
<h1><?= $title ?></h1>
<h3>
	<?= htmlspecialchars($post['title']) ?>
	<?= htmlspecialchars($post['creation_date_fr']) ?>
</h3>

<p>
	<?= htmlspecialchars($post['content']) ?>
</p>

<h2>Commentaires</h2>
<h4>
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
<?php
}
$comments->closeCursor();
?>
</h4>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>