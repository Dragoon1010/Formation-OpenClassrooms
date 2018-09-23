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
 * UTILISATEUR CLIENT
 *********************/

function user_ShowRegister()
{
    if(isset($_SESSION['user']))
        return user_ShowErrorAlreadyConnected();

    $title = "Inscription";
    $bodyName = "main-body";

    require('view/frontend/register.php');
}

function user_SendRegister($datas)
{
    if(isset($_SESSION['user']))
        return user_ShowErrorAlreadyConnected();

    if($datas['username'] != '' && $datas['userpass'] != '' && $datas['mail'] != '')
    {
        $userManager = new UserManager();

        if(preg_match('/\W/', $datas['username']))
        {
            $notification =  new Notification('Seuls des lettres et des chiffres peuvent composer votre pseudo', E_ERROR);
            require('view/frontend/register.php');
            return;
        }

        if($userManager->usernameExist($datas['username']))
        {
            $notification = new Notification('Ce pseudonyme existe déjà !', E_ERROR);
            require('view/frontend/register.php');
            return;
        }

        if($userManager->mailExist($datas['mail']))
        {
            $notification = new Notification('Cette adresse e-mail existe déjà !', E_ERROR);
            require('view/frontend/register.php');
            return;
        }

        $userInfos = Array(
            'username' => $datas['username'],
            'userpass' => password_hash($datas['userpass'], PASSWORD_DEFAULT),
            'mail' => $datas['mail']
        );

        $user = new User($userInfos);
        $userManager->createUser($user);

        $title = "Mon compte";
        $bodyName = "main-body";

        header('Location: ./compte');

    }
    else
    {
        $notification = new Notification('Vous devez entrer une valeur dans tout les champs !', E_ERROR);
        require('view/frontend/register.php');
    }
}

function user_ShowLogin($message = NULL)
{
    if(isset($_SESSION['user']))
        return user_ShowErrorAlreadyConnected();

    $title = "Connexion";
    $bodyName = "main-body";

    if(!is_null($message)) $notification = new Notification($message, E_ERROR);

    require('view/frontend/login.php');
}

function user_SendLogin($datas)
{
    if(isset($_SESSION['user']))
        return user_ShowErrorAlreadyConnected();

    if(isset($datas['username']) && isset($datas['userpass']))
    {
        $userManager = new UserManager();
        $user = $userManager->getUserByNameOrId($datas['username']);

        $verifyPassword = password_verify((string)$datas['userpass'], $user->getUserpass());

        if($verifyPassword)
        {
            $_SESSION['user'] = $user;

            $notification = new Notification('Connexion réussi ! Vous allez être redirigé automatiquement dans quelques instants...', E_NOTICE);
            require('view/frontend/login.php');

            header('refresh:5;url=./compte');
        }
        else
        {
            $notification = new Notification('Le pseudo ou le mot de passe ne sont pas correct', E_ERROR);
            require('view/frontend/login.php');
        }
    }
    else
    {
        $notification = new Notification('Vous devez remplir tout les champs pour vous connecter', E_ERROR);
        require('view/frontend/login.php');
    }
}

function user_Disconnect()
{
    if(!isset($_SESSION['user']))
        return user_ShowErrorNotConnected();

    session_destroy();
    header('Location: ./accueil');
}

function user_ShowAccount($user)
{
    if(!isset($_SESSION['user']))
        return user_ShowErrorNotConnected();

    $title = "Mon compte";
    $bodyName = "main-body";

    require('view/frontend/user.php');
}

function user_ShowAccountEdit($userId)
{
    if(!isset($_SESSION['user']))
        return user_ShowErrorNotConnected();

    /* TODO */
}

function user_EditAccount(User $user)
{
    if(!isset($_SESSION['user']))
        return user_ShowErrorNotConnected();

    /* TODO */
}

function user_ShowErrorNotConnected()
{
    header('Location: ./connexion');
}

function user_ShowErrorAlreadyConnected()
{
    header('Location: ./compte');
}