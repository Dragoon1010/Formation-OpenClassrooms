<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:03
 */

require_once('utils.php');

//set_error_handler('errorToException');
//set_exception_handler('customException');

require('controller/postController.php');
require('controller/commentController.php');
require('controller/userController.php');
require ('controller/adminPanelController.php');


session_start();

$action = '';
if(isset($_GET['action']))
{
    $action = explode('/', strtolower($_GET['action']));

    if($action[0] == 'accueil')
    {
        user_ShowIndex();
    }
    else if($action[0] == 'inscription')
    {
        if(isset($_POST['submit']))
        {
            user_SendRegister($_POST);
        }
        else
        {
            user_ShowRegister();
        }
    }
    else if($action[0] == 'connexion')
    {
        if(isset($_POST['submit']))
        {
            user_SendLogin($_POST);
        }
        else
        {
            user_ShowLogin();
        }
    }
    else if($action[0] == 'deconnexion')
    {
        user_Disconnect();
    }
    else if($action[0] == 'article')
    {
        if(isset($action[1]) && is_int($action[1]) && isset($action[2]) && $action[2] == 'edition')
        {
            admin_EditPost($action[1]);
        }
        else if(isset($action[1]))
        {
            user_ShowPost($action[1]);
        }
        else
        {
            user_ShowError();
        }
    }
    else if($action[0] == 'articles')
    {
        user_ShowAllPost();
    }
    else if($action[0] == 'compte')
    {
        if(empty($action[1]) && isset($_SESSION['user']))
        {
            user_ShowAccount($_SESSION['user']);
        }
        else if(!empty($action[1]) && $action[1] == 'editer'  && isset($_SESSION['user']))
        {
            user_ShowAccountEdit($_SESSION['user']);
        }
        else
        {
            user_ShowErrorNotConnected();
        }
    }
    else if($action[0] == 'administration')
    {
        if(!isset($_SESSION['user']))
        {
            $notification = new Notification('Vous devez être connecté pour pouvoir accéder à cette section, vous allez être redirigé automatiquement...');
            require('view/backend/admin.php');

            return header('refresh:5;url=./connexion');
        }
        else if($_SESSION['user']->getGroupId() == 1)
        {
            $notification = new Notification('Vous ne pouvez pas accéder à cette section ! Vous allez être redirigé vers votre compte dans quelques instants...');
            require('view/backend/admin.php');

            return header('refresh:5;url=./compte');
        }

        if(empty($action[1]))
        {
            admin_ShowAdminPanel();
        }
        else if($action[1] == 'utilisateurs')
        {
            if(empty($action[2]))
            {
                admin_ShowUsersList();
            }
            else if($action[2] == 'ajouter')
            {
                if(isset($_POST['submit']))
                {
                    admin_SendUserAdd($_POST);
                }
                else
                {
                    admin_ShowUserAdd();
                }
            }
            else if(is_numeric($action[2]) && $action[3] == 'editer')
            {
                if(isset($_POST['submit']))
                {
                    admin_SendUserEdit($_POST);
                }
                else
                {
                    admin_ShowUserEdit($action[2]);
                }

            }
            else if(is_numeric($action[2]) && $action[3] == 'supprimer')
            {
                admin_DeleteUser($action[2]);
            }
            else
            {
                user_ShowError();
            }
        }
        else if($action[1] == 'articles')
        {
            if(empty($action[2]))
            {
                admin_ShowPostsList();
            }
            else if($action[2] == 'ajouter')
            {
                if(isset($_POST['submit']))
                {
                    admin_SendPostAdd($_POST);
                }
                else
                {
                    admin_ShowPostAdd();
                }
            }
            else if(is_numeric($action[2]) && $action[3] == 'editer')
            {
                if(isset($_POST['submit']))
                {
                    admin_SendPostEdit($_POST);
                }
                else
                {
                    admin_ShowPostEdit($action[2]);
                }

            }
            else if(is_numeric($action[2]) && $action[3] == 'supprimer')
            {
                admin_DeletePost($action[2]);
            }
            else
            {
                user_ShowError();
            }
        }
        else if($action[1] == 'commentaires')
        {
            if(empty($action[2]))
            {
                admin_ShowCommentsList();
            }
            else if(is_numeric($action[2]) && $action[2] == 'editer')
            {
                if(isset($_POST['submit']))
                {
                    admin_SendCommentEdit($_POST);
                }
                else
                {
                    admin_ShowCommentEdit($action[2]);
                }

            }
            else if(is_numeric($action[2]) && $action[2] == 'supprimer')
            {
                admin_DeleteComment($action[2]);
            }
            else
            {
                user_ShowError();
            }
        }
    }
    else
    {
        user_ShowError();
    }
}
else
{
    user_ShowIndex();
}