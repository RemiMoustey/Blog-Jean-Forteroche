<?php $title = 'Liste des billets' ?>
<?php ob_start() ?>
<div class="bloc-page-index">
    <?php
    while ($data = $posts->fetch())
    {
    ?>
        <div class="news">
            <h3>
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a>
                <em><span class="news-date">le <?= $data['creation_date_fr'] ?></span></em>
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
                    <a href="index.php?action=post&id=<?= $data['id'] ?>">Lire la suite</a>
                <?php
                }
                else
                {
                    echo $tagsContent . nl2br($textContent);
                }
                ?>
                <br />
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="link-comments">Commentaires</a>
            </p>
        </div>
    <?php
    }
    $posts->closeCursor();
    ?>
</div>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>