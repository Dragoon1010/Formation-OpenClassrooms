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

    <article class="row single-post" id="<?= $post->getId(); ?>">
        <h1 class="col-xl-12 post-title"><?= $post->getTitle(); ?></h1>
        <img src="<?= $post->getThumbnail(); ?>" class="col-xl-12 post-thumbnail"/>
        <div class="row col-xl-12 post-infos">
            <span class="col-xl-4 post-category">Categorie - <?= $post->getCategory(); ?></span>
            <span class="col-xl-4 post-author">Rédigé par <?= is_null($user) ?  'Auteur inconnu' : $user->getUsername(); ?></span>
            <span class="col-xl-4 post-date-create"> le <?= $post->getDateCreate(); ?></span>
        </div>
        <p class="row col-xl-12 post-description"><?= $post->getDescription(); ?></p>
        <p class="row col-xl-12 post-text"><?= $post->getText(); ?></p>
        <?php if($user->getGroupId() > User::IS_ADMIN) echo '<a href="/alaska/article/' . $post->getId() . '/edition">Editer l\'article</a>' ?>
    </article>

    <?php include('comments.php'); ?>

<?php } else { ?>

    <span class="no-post-error">Désolé, L'article demandé n'existe pas !</span>

<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
