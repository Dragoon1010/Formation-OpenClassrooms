<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:24
 */
?>

<section class="row col-xl-12 comments-list">
    <?php if (!is_null($comments)) { ?>
        <?php foreach($comments as $comment) { ?>
            <?php $user = $userManager->getUserByNameOrId($comment->getAuthorId()); ?>
            <section class="row col-xl-12 single-comment">
                <h4 class="col-xl-16 comment-author">Ecrit par <?= is_null($user) ?  'Auteur inconnu' : $user->getUsername(); ?></h4>
                <span class="col-xl-6 comment-date">le <?= $comment->getDateUpdate(); ?></span>
                <p class="col-xl-12 comment-text"><?= $comment->getText(); ?></p>
            </section>
        <?php } ?>
    <?php } else { ?>

    <span class="no-comment-error">Il n'y a aucun commentaire pour le moment. Ecrivez en un !</span>

    <?php } ?>
</section>

