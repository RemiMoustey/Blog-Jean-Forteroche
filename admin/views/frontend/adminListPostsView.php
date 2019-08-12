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
            <a href="adminIndex.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a>
            <em>le <?= $data['creation_date_fr'] ?></em>s
        </h3>
        
        <p>
            <?php
            $textContent = $data['content'];
            $tagsContent = "";
            while(true)
            {
                while($textContent[0] === " " || $textContent[0] === "\r" || $textContent[0] === "\n")
                {
                    $textContent = substr($textContent, 1);
                }
                if($textContent[0] === "<")
                {
                    $tagsContent .= substr(strstr($textContent, ">", true) . ">", 0);
                    $textContent = substr(strstr($textContent, ">"), 1);
                }
                else
                {
                    break;
                }
            }
            
            if(strlen($textContent) > 500)
            {
                echo $tagsContent . nl2br(substr($textContent, 0, 500)). "..."; ?>
                <a href="adminIndex.php?action=post&id=<?= $data['id'] ?>">Lire la suite</a>
            <?php
            }
            else
            {
                echo $tagsContent . nl2br($textContent);
            }
            ?>
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