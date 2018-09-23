<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:19
 */
?>

<?php ob_start(); ?>

<?= isset($notification) ? $notification->show() : '' ?>

<?php if(isset($_SESSION['user'])) { ?>

    <?= var_dump($_SESSION['user']) ?>
    <section id="profile">Utilisateur connecté sous le pseudonyme de <?= $_SESSION['user']->getUsername() ?></section>

<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>

