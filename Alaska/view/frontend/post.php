<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:05
 */
?>

<?php ob_start(); ?>

<?php if(!is_null($post)) { ?>
    <?php $user = $userManager->getUserByNameOrId($post->getAuthorId()); ?>

    <article class="single-post" id="<?= $post->getId(); ?>">
        <h1 id="post-title"><?= $post->getTitle(); ?></h1>
        <p id="post-description"><?= $post->getDescription(); ?></p>
        <span id="post-category"><?= $post->getCategory(); ?></span>
        <span id="post-author"><?= is_null($user) ?  'Auteur inconnu' : $user->getUsername(); ?></span>
        <img src="<?= $post->getThumbnail(); ?>" id="post-thumbnail"/>
        <span id="post-date-create"><?= $post->getDateCreate(); ?></span>
        <span id="post-date-update"><?= $post->getDateCreate(); ?></span>
        <p id="post-text"><?= $post->getText(); ?></p>
        <?php if($user->getGroupId() > 1) echo '<a href="' . $post->getId() . '/edition/">Editer l\'article</a>' ?>
    </article>

    <?php include('comments.php'); ?>

<?php } else { ?>

    <span id="no-post-error">Désolé, L'article demandé n'existe pas !</span>

<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
