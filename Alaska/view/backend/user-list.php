<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:13
 */
?>

<?php ob_start(); ?>

<?= isset($notification) ? $notification->show() : '' ?>

<?php if(count($usersList) > 1) { ?>

    <table class="users-list">
        <thead>
            <tr>
                <th>Id</th>
                <th>Groupe</th>
                <th>Nom d'utilisateur</th>
                <th>Adresse mail</th>
                <th>Date d'inscription</th>
                <th>Editer</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usersList as $user) { ?>
            <tr class="user">
                <td class="user-id"><?= $user->getId() ?></td>
                <td class="user-group-id"><?= $user->getGroupId() ?></td>
                <td class="user-username"><?= $user->getUsername() ?></td>
                <td class="user-mail"><?= $user->getMail() ?></td>
                <td class="user-date"><?= $user->getDateSignin() ?></td>
                <td class="user-edit-link"><a href="utilisateurs/<?= $user->getId() ?>/editer">Editer l'utilisateur</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else { ?>
    <?= 'Il n\'y a aucun utilisateur à afficher ici.' ?>
<?php } ?>


<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>