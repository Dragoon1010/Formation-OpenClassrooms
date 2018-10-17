<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:15
 */

require_once('utils.php');
spl_autoload_register('loadClass');

class UserManager extends Database
{
    private $_db;

    public function __construct()
    {
        $this->_db = parent::dbConnect();
        return $this->_db;
    }

    public function createUser(User $user)
    {
        $req = $this->_db->prepare('INSERT INTO users(username, userpass, dateSignin, groupId, mail, avatar) VALUE(:username, :userpass, NOW(), :groupId, :mail, :avatar)');

        $req->bindValue(':username', $user->getUsername());
        $req->bindValue(':userpass', $user->getUserpass());
        $req->bindValue(':groupId', $user->getGroupId());
        $req->bindValue(':mail', $user->getMail());
        $req->bindValue(':avatar', $user->getAvatar());

        return $req->execute();
    }

    public function updateUser(User $user)
    {
        $req = $this->_db->prepare('UPDATE users SET username = :username, userpass = :userpass, dateSignin = :dateSignin, groupId = :groupId, mail = :mail, avatar = :avatar WHERE id = ' . $user->getId());

        $req->bindValue(':username', $user->getUsername());
        $req->bindValue(':userpass', $user->getUserpass());
        $req->bindValue(':groupId', $user->getGroupId());
        $req->bindValue(':mail', $user->getMail());
        $req->bindValue(':avatar', $user->getAvatar());

        $req->execute();
    }

    public function deleteUser(User $user)
    {
        return $req = $this->_db->exec('DELETE FROM users WHERE id = ' . $user->getId());
    }

    public function getUserByNameOrId($param)
    {
        if(is_numeric($param))
        {
            $req = $this->_db->prepare('SELECT * FROM users WHERE id = :id');
            $req->bindValue(':id', (int)$param);
        }
        else
        {
            $req = $this->_db->prepare('SELECT * FROM users WHERE username = :username');
            $req->bindValue(':username', (string)$param);
        }

        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if(is_array($data))
            return new User($data);
    }

    public function usernameExist($username)
    {
        $req = $this->_db->prepare('SELECT * FROM users WHERE username = :username');
        $req->bindValue(':username', (string)$username);

        $req->execute();

        if($req->rowCount() > 0)
            return true;
        else return false;
    }

    public function mailExist($mail)
    {
        $req = $this->_db->prepare('SELECT * FROM users WHERE mail = :mail');
        $req->bindValue(':mail', (string)$mail);

        $req->execute();

        if($req->rowCount() > 0)
            return true;
        else return false;
    }

    public function getAllUser()
    {
        $usersList = [];

        $req = $this->_db->query('SELECT * FROM users');

        while($user = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($usersList, new User($user));
        }
        $req->closeCursor();

        return $usersList;
    }
}