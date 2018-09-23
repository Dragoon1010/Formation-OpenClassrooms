<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 20/08/2018
 * Time: 18:08
 */
?>

<?php ob_start(); ?>

<?= isset($notification) ? $notification->show() : '' ?>

<form method="POST">
    <input type="text" name="username" />
    <input type="password" name="userpass" />
    <input type="password" name="userpass-confirm" />
    <input type="email" name="mail" />
    <input type="submit" name="submit" value="valider l'inscription"/>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
