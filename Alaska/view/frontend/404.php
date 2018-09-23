<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 20/08/2018
 * Time: 22:23
 */
?>

<?php ob_start(); ?>

<?= 'ERROR' ?>

<?php $content = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
