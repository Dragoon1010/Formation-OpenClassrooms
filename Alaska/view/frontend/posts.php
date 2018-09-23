<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:24
 */
?>

<?php ob_start(); ?>

<section id="posts-list">
    <?php $count = 0;  ?>
    <?php if(isset($posts) && count($posts) > 0) { ?>
        <?php foreach ($posts as $post) { ?>
            <?php $count++; ?>
            <?php $user = $userManager->getUserByNameOrId($post->getAuthorId()); ?>

            <article  class="single-post" id="<?= $post->getId(); ?>">
                <a href="article/<?= $post->getId(); ?>">
                    <h1 id="post-title"><?= $post->getTitle(); ?></h1>
                </a>
                <p id="post-description"><?= $post->getDescription(); ?></p>
                <span class="post-category"><?= $post->getCategory(); ?></span>
                <span class="post-author"><?= is_null($user) ?  'Auteur inconnu' : $user->getUsername(); ?></span>
                <img src="<?= $post->getThumbnail(); ?>" id="post-thumbnail"/>
                <span id="post-date-create"><?= $post->getDateCreate(); ?></span>
            </article>

            <?php
            if($count == $maxPosts) break;
        }
    }
    ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>

