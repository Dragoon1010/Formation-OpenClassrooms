<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:03
 */

/**********************
 * BACK-END
 *********************/

function admin_ShowAdminPanel()
{
    $title = "Administration";
    $bodyName = "main-body";

    require('view/backend/admin.php');
}

/**********************
 * UTILISATEURS ADMIN
 *********************/

function admin_ShowUsersList()
{
    $userManager = new UserManager();
    $usersList = $userManager->getAllUser();

    require('view/backend/user-list.php');
}

function admin_ShowUserAdd()
{
    require('view/backend/user-add.php');
}

function admin_SendUserAdd(User $user)
{
    /* TODO */
}

function admin_ShowUserEdit($userId)
{
    $user = new UserManager();
    $user->getUserByNameOrId($userId);

    echo 'test';
    require('view/backend/user-edit.php');
}

function admin_SendUserEdit(User $user)
{
    /* TODO */
}

function admin_DeleteUser($userId)
{
    /* TODO */
}


/**********************
 * ARTICLES ADMIN
 *********************/

function admin_ShowPostsList()
{
    $postManager = new PostManager();
    $postsList = $postManager->getAllPost();

    require('view/backend/post-list.php');
}

function admin_ShowPostAdd()
{
    require('view/backend/post-add.php');
}

function admin_SendPostAdd(Post $post)
{
    /* TODO */
}

function admin_ShowPostEdit($postId)
{
    $post = new PostManager();
    $post->getPostById($postId);

    require('view/backend/post-edit.php');
}

function admin_SendPostEdit(Post $post)
{
    /* TODO */
}

function admin_DeletePost($postId)
{
    /* TODO */
}

/**********************
 * COMMENTAIRES ADMIN
 *********************/

function admin_ShowCommentsList()
{
    $commentManager = new CommentManager();
    $commentsList = $commentManager->getAllComment();

    require('view/backend/comment-list.php');
}

function admin_ShowCommentEdit($commentId)
{
    $comment = new CommentManager();
    $comment->getCommentById($commentId);

    require('view/backend/comment-edit.php');
}

function admin_SendCommentEdit(Comment $comment)
{
    /* TODO */
}

function admin_DeleteComment($commentId)
{
    /* TODO */
}


