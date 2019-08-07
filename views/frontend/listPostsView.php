<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>

<h1>Test de blog</h1>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br($data['content']) ?>
            <br />
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>