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
        <script src="/Projects/Alaska/public/inc/js/tinymce/tinymce.min.js"></script>

        <!-- BOOTSTRAP INTEGRATION -->
        <script src="/Projects/Alaska/public/inc/js/bootstrap/bootstrap.min.js"></script>
        <link href="/Projects/Alaska/public/inc/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- MY CSS/JS -->
        <link href="/Projects/Alaska/public/css/style.css" rel="stylesheet" type="text/css" />
        <script src="/Projects/Alaska/public/js/main.js"></script>
    </head>
    <body id="<?= isset($bodyName) ? $bodyName : 'body' ?>">
        <header>
            <img src="#" alt="Logo Billet simple pour l'Alaska" />
            <ul>
                <li><a href="/Projects/Alaska/accueil">Accueil</a></li>
                <li><a href="/Projects/Alaska/articles">Billets de blog</a></li>
                <li>
                    <?php
                    if(isset($_SESSION['user']))
                        echo '<a href="/Projects/Alaska/compte">Profil</a> ou <a href="/Projects/Alaska/deconnexion">déconnexion</a>';
                    else
                        echo '<a href="/Projects/Alaska/connexion">Se connecter</a> ou <a href="/Projects/Alaska/inscription">s\'inscrire</a>';
                    ?>
                </li>
            </ul>
            <form id="search-module">
                <input type="search" placeholder="rechercher" />
            </form>
        </header>
