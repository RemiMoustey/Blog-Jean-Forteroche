<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>
<div class="bloc-page-index">
    <p class="link-create-post"><a href="tinymce.php">Écrire un billet</a></p>
    <?php
    $count = (int)$countPosts->fetch()['count'];
    while ($data = $posts->fetch())
    {
    ?>
        <div class="news">
            <h3>
                <a href="adminChapters.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a><br />
                <span class="news-date">le <?= $data['creation_date_fr'] ?></span>
            </h3>
            
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
            
            if(mb_strlen($textContent) > 500)
            {
                echo $tagsContent . nl2br(substr($textContent, 0, 500)). "..."; ?>
                <br /><a href="adminChapters.php?action=post&id=<?= $data['id'] ?>">Lire la suite...</a></p>
            <?php
            }
            else
            {
                echo $tagsContent . nl2br($textContent);
            }
            ?>
            
            <p class="link-posts modify-margin"><a href="adminChapters.php?action=modifyPost&amp;id=<?= $data['id'] ?>">Modifier</a></p>
            <p class="link-posts"><a href="adminChapters.php?action=removePost&amp;id=<?= $data['id'] ?>" onclick="return(confirm('Êtes-vous sûr de vouloir supprimer ce billet ?'));">Supprimer</a></p>
            <p class="link-comments"><a href="adminChapters.php?action=post&amp;id=<?= $data['id'] ?>#anchor-comments">Voir les commentaires</a></p>
        </div>
    <?php
    }
    $posts->closeCursor();
    $pages = ceil($count / PER_PAGE);
    $page = (int)($_GET['p'] ?? 1);
    if ($pages > 1 && $page > 1)
    {
    ?>
        <p class="link-page">
            <a href="?p=<?= $page - 1 ?>">Chapitres précédants</a>
        </p>
    <?php
    }
    if ($pages > 1 && $page < $pages)
    {
    ?>
        <p class="link-page">
            <a href="?p=<?= $page + 1 ?>">Chapitres suivants</a>
        </p>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean() ?>
<?php require('./../public/template.php') ?>