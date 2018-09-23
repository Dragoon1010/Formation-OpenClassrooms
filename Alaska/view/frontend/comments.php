<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:24
 */
?>

<section id="comments-list">
    <?php if (!is_null($comments)) { ?>
        <?php foreach($comments as $comment) { ?>
            <?php $user = $userManager->getUserByNameOrId($comment->getAuthorId()); ?>
            <section id="single-comment">
                <h2 id="comment-author"><?= is_null($user) ?  'Auteur inconnu' : $user->getUsername(); ?></h2>
                <span id="comment-date"><?= $comment->getDateUpdate(); ?></span>
                <p id="comment-text"><?= $comment->getText(); ?></p>
            </section>
        <?php } ?>
    <?php } else { ?>

    <span id="no-comment-error">Il n'y a aucun commentaire pour le moment. Ecrivez en un !</span>

    <?php } ?>
</section>

