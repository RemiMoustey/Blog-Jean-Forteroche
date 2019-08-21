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
                    <p class="article-rest"><a href="chapters.php?action=post&id=<?= $data['id'] ?>">Lire la suite...</a></p>
                <?php
                }
                else
                {
                    echo $tagsContent . nl2br($textContent);
                }
                ?>
                
                <p class="link-comments"><a href="chapters.php?action=post&amp;id=<?= $data['id'] ?>#anchor-comments">Voir les commentaires</a></p>
            </p>
        </div>
    <?php
    }
    $posts->closeCursor();
    $pages = ceil($count / PER_PAGE);
    $page = (int)($_GET['p'] ?? 1);
    if ($pages > 1 && $page > 1)
    {
    ?>
        <a href="?p=<?= $page - 1 ?>">Chapitres précédants</a>
    <?php
    }
    if ($pages > 1 && $page < $pages)
    {
    ?>
        <a href="?p=<?= $page + 1 ?>">Chapitres suivants</a>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean() ?>
<?php require('./public/template.php') ?>