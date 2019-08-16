<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>
<div class="bloc-page-index">
    <p class="link-create-post"><a href="tinymce.php">Écrire un billet</a></p>
    <?php
    while ($data = $posts->fetch())
    {
    ?>
        <div class="news">
            <h3>
                <a href="adminIndex.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a><br />
                <span class="news-date">le <?= $data['creation_date_fr'] ?></span>
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
                    <p class="article-rest"><a href="adminIndex.php?action=post&id=<?= $data['id'] ?>">Lire la suite...</a></p>
                <?php
                }
                else
                {
                    echo $tagsContent . nl2br($textContent);
                }
                ?>
                
                <p class="link-posts modify-margin"><a href="adminIndex.php?action=modifyPost&amp;id=<?= $data['id'] ?>">Modifier</a></p>
                <p class="link-posts"><a href="adminIndex.php?action=removePost&amp;id=<?= $data['id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce billet ?'));">Supprimer</a></p>
                <p class="link-comments"><a href="adminIndex.php?action=post&amp;id=<?= $data['id'] ?>#anchor-comments">Voir les commentaires</a></p>
            </p>
        </div>
    <?php
    }
    $posts->closeCursor();
    ?>
</div>

<?php $content = ob_get_clean() ?>
<?php require('./../public/template.php') ?>