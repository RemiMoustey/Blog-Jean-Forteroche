<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>

<h1>Test de blog</h1>

<a href="tinymce.php">Ajouter un billet</a>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= $data['title'] ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br($data['content']) ?>
            <br />
            <a href="adminIndex.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a>
            <br />
            <a href="adminIndex.php?action=modifyPost&amp;id=<?= $data['id'] ?>">Modifier</a>
            <br />
            <a href="adminIndex.php?action=removePost&amp;id=<?= $data['id'] ?>">Supprimer</a>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean() ?>
<?php require('adminTemplate.php') ?>