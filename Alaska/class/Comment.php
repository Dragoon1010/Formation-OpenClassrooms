<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:21
 */

class Comment
{
    private $_id;
    private $_post_id;
    private $_author_id;
    private $_date_Create;
    private $_date_Update;
    private $_text;

    /**
     * Comment constructor.
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
    public function getPostId()
    {
        return $this->_post_id;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->_author_id;
    }

    /**
     * @return mixed
     */
    public function GetDateCreate()
    {
        return $this->_date_Create;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->_date_Update;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->_text;
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
     * @param $postId
     */
    public function setPostId($postId)
    {
        $postId = (int) $postId;

        if($postId > 0)
            $this->_post_id = $postId;
    }

    /**
     * @param $authorId
     */
    public function setAuthorId($authorId)
    {
        $authorId = (int) $authorId;

        if($authorId > 0)
            $this->_author_id = $authorId;
    }

    /**
     * @param $date
     */
    public function setDateCreate($date)
    {
        if(is_string($date))
            $this->_date_Create = $date;
    }

    /**
     * @param $date
     */
    public function setDateUpdate($date)
    {
        if(is_string($date))
            $this->_date_Update = $date;
    }

    /**
     * @param $text
     */
    public function setText($text)
    {
        if(is_string($text))
            $this->_text = $text;
    }
}