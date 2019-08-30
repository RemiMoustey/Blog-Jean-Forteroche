<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>
<div class="bloc-page-index">
    <?php
    $count = (int)$countPosts->fetch()['count'];
    while ($data = $posts->fetch())
    {
    ?>
        <div class="news">
            <h3>
                <a href="chapters.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a><br />
                <em><span class="news-date"> publié le <?= $data['creation_date_fr'] ?></span></em>
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
                <br /><a href="chapters.php?action=post&id=<?= $data['id'] ?>">Lire la suite...</a></p>
            <?php
            }
            else
            {
                echo $tagsContent . nl2br($textContent);
            }
            ?>
            
            <p class="link-comments"><a href="chapters.php?action=post&amp;id=<?= $data['id'] ?>#anchor-comments">Voir les commentaires</a></p>
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
            <a href="?p=<?= $page - 1 ?>">Chapitres précédents</a>
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
<?php require('./public/template.php') ?>