<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:06
 */

class User
{
    private $_id;
    private $_username;
    private $_userpass;
    private $_dateSignin;
    private $_groupId;
    private $_mail;
    private $_avatar;

    CONST IS_USER = 1;
    CONST IS_AUTHOR = 2;
    CONST IS_ADMIN = 3;

    /**
     * User constructor.
     * @param $datas
     */
    public function __construct($datas)
    {
        if(!empty($datas))
        {
            $this->hydrate($datas);
        }
    }

    public function hydrate($datas)
    {
        foreach($datas as $key => $value)
        {
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method))
                $this->$method($value);
            else throw new Exception(" | " . $method . "() : La méthode invoquée n'existe pas");
        }
    }

    /**
     * GETTERS
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return mixed
     */
    public function getUserpass()
    {
        return $this->_userpass;
    }

    /**
     * @return mixed
     */
    public function getDateSignin()
    {
        return $this->_dateSignin;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        if($this->_groupId != NULL)
            return $this->_groupId;
        else return 1;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->_mail;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->_avatar;
    }

    /**
     * SETTERS
     */

    /**
     * @param $id
     */
    public function setId($id)
    {
        $id = (int) $id;

        if($id > 0)
            $this->_id = $id;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        if(is_string($username) && strlen($username) < 50)
            $this->_username = $username;
    }

    /**
     * @param $password
     */
    public function setUserpass($userpass)
    {
        if(is_string($userpass))
            $this->_userpass = $userpass;
    }

    public function setDateSignin($date)
    {
        if(is_string($date))
            $this->_dateSignin = $date;
    }

    /**
     * @param $groupId
     */
    public function setGroupId($groupId)
    {
        $groupId = (int) $groupId;

        if($groupId === 3)
            $this->_groupId = $this::IS_ADMIN;
        else if ($groupId === 2)
            $this->_groupId = $this::IS_AUTHOR;
        else  $this->_groupId = $this::IS_USER;
    }

    /**
     * @param $mail
     */
    public function setMail($mail)
    {
        if(is_string($mail) && strlen($mail) < 255)
            $this->_mail = $mail;
    }

    /**
     * @param $avatar
     */
    public function setAvatar($avatar)
    {
        if(is_string($avatar) && strlen($avatar) < 255)
            $this->_avatar = $avatar;
    }

}