<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 20/08/2018
 * Time: 18:09
 */
?>

<?php ob_start(); ?>

<?= isset($notification) ? $notification->show() : '' ?>

<?php if(!isset($_SESSION['user'])) { ?>
<form method="POST">
    <input type="text" name="username" />
    <input type="password" name="userpass" />
    <input type="submit" name="submit" value="connexion" />
</form>
<?php } ?>


<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
