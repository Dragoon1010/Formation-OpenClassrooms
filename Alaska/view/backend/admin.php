<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:11
 */

?>

<?php ob_start(); ?>

<?= isset($notification) ? $notification->show() : '' ?>

<?php if(isset($_SESSION['user']) && $_SESSION['user']->getGroupId() > 1) { ?>

    <a href="administration/articles">Consulter la liste des articles</a>
    <a href="administration/utilisateurs">Consulter la liste des utilisateurs</a>
    <a href="administration/commentaires">Consulter la liste des commentaires</a>

<?php } ?>



<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>

