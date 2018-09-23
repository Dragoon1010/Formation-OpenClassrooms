<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:15
 */

class Post
{
    private $_id;
    private $_title;
    private $_description;
    private $_category; /* TODO CREATE TABLE ON DB */
    private $_author_Id;
    private $_thumbnail;
    private $_date_Create;
    private $_date_Update;
    private $_text;

    /**
     * Post constructor.
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
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->_author_Id;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->_thumbnail;
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
     * @param $title
     */
    public function setTitle($title)
    {
        if(is_string($title) && strlen($title) <= 255)
            $this->_title = $title;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        if(is_string($description) && strlen($description) <= 512)
            $this->_description = $description;
    }

    /**
     * @param $category
     */
    public function setCategory($category)
    {
        $category = (int) $category;

        if($category > 0)
            $this->_category = $category;
    }

    /**
     * @param $authorId
     */
    public function setAuthorId($authorId)
    {
        $authorId = (int) $authorId;

        if($authorId > 0)
            $this->_author_Id = $authorId;
    }

    /**
     * @param $thumbnailUrl
     */
    public function setThumbnail($thumbnailUrl)
    {
        if(is_string($thumbnailUrl) && strlen($thumbnailUrl) <= 255)
            $this->_thumbnail = $thumbnailUrl;
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