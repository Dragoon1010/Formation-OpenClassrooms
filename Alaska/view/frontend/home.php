<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:05
 */
?>

<?php ob_start(); ?>

<section class="slider"></section>

<section class="row">
    <?php $count = 0;  ?>
    <?php if(isset($posts) && count($posts) > 0) { ?>
        <?php foreach ($posts as $post) { ?>
            <?php $count++; ?>
            <?php $user = $userManager->getUserByNameOrId($post->getAuthorId()); ?>

            <article  class="card col-xl-3 post" id="<?= $post->getId(); ?>">
                <h1 class="card-title post-title"><?= $post->getTitle(); ?></h1>
                <a href="article/<?= $post->getId(); ?>">
                    <img src="<?= $post->getThumbnail(); ?>" class="card-img-top post-img" />
                </a>
                <div class="card-body">
                    <p class="card-text post-description" ><?= $post->getDescription(); ?></p>
                    <div class="post-infos">
                        <span class="card-text post-date-posted">Publié le <?= $post->getDateCreate(); ?></span>
                        <span class="card-text post-author">par <?=  is_null($user) ?  'Auteur inconnu' : $user->getUsername(); ?></span>
                        <span class="card-text post-category">dans la catégorie <?= $post->getCategory(); ?></span>
                    </div>

                    <a href="article/<?= $post->getId(); ?>" class="btn btn-primary post-get-more-button">Lire l'article</a>
                </div>
            </article>

            <?php
            if($count == $maxPosts) break;
        }
    }
    ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
