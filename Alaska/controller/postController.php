<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 29/08/2018
 * Time: 01:18
 */

require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/UserManager.php');

/**********************
 * ARTICLE CLIENT
 *********************/

function user_ShowIndex()
{
    $postManager = new PostManager();
    $posts = $postManager->getAllPost();
    $userManager = new UserManager();

    $title = "Accueil";
    $bodyName = "main-body";

    $maxPosts = 5;

    require('view/frontend/home.php');
}

function user_ShowAllPost()
{
    $postManager = new PostManager();
    $posts = $postManager->getAllPost();
    $userManager = new UserManager();

    $title = "Articles";
    $bodyName = "main-body";

    $maxPosts = 10;

    require('view/frontend/posts.php');
}

function user_ShowPost($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPostById($postId);

    $userManager = new UserManager();
    $commentManager = new CommentManager();
    $comments = $commentManager->getAllCommentByPostId($postId);

    $title = "Article";
    $bodyName = "main-body";

    require('view/frontend/post.php');
}

/**********************
 * ERREUR
 *********************/

function user_ShowError()
{
    $title = "Erreur 404";
    $bodyName = "main-body";

    require('view/frontend/404.php');
}