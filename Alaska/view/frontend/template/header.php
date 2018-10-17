<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:04
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($title) ? $title : 'Page inconnue' ?></title>

        <!-- TINYMCE INTEGRATION -->
        <script src="/alaska/public/inc/js/tinymce/tinymce.min.js"></script>

        <!-- BOOTSTRAP INTEGRATION -->
        <script src="/alaska/public/inc/js/bootstrap/bootstrap.min.js"></script>
        <link href="/alaska/public/inc/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- MY CSS/JS -->
        <link href="/alaska/public/css/style.css" rel="stylesheet" type="text/css" />
        <script src="/alaska/public/js/main.js"></script>
    </head>
    <body id="<?= isset($bodyName) ? $bodyName : 'body' ?>">
        <header  class="row">
            <img src="#" alt="Logo Billet simple pour l'Alaska" class="col-xl-4 float-left" />
            <ul class="row col-xl-6">
                <li class="col-xl-3"><a href="/alaska/accueil">Accueil</a></li>
                <li class="col-xl-3"><a href="/alaska/articles">Billets de blog</a></li>
                <?php if(isset($_SESSION['user'])) { ?>
                <ul class="col-xl-3">
                    <li><a href="/alaska/compte">Profil</a></li>
                    <li><a href="/alaska/deconnexion">déconnexion</a></li>
                </ul>
                <?php } else { ?>
                <li class="col-xl-3">
                    <a href="/alaska/connexion">Se connecter</a> ou <a href="/alaska/inscription">s\'inscrire</a>
                </li>
                <?php } ?>
                <form class="col-xl-3">
                    <input type="search" placeholder="rechercher" />
                </form>
            </ul>
        </header>
