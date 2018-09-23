<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:15
 */

spl_autoload_register('loadClass');

class PostManager extends Database
{
    private $_db;

    public function __construct()
    {
        $this->_db = parent::dbConnect();
        return $this->_db;
    }

    public function createPost(Post $post)
    {
        $req = $this->_db->prepare('INSERT INTO posts(title, description, category, authorId, thumbnail, text) VALUE(:title, :description, :category, :authorId, :thumbnail, :dateUpdate, :text)');

        $req->bindValue(':title', $post->getTitle());
        $req->bindValue(':description', $post->getDescription());
        $req->bindValue(':category', $post->getCategory());
        $req->bindValue(':authorId', $post->getAuthorId());
        $req->bindValue(':thumbnail', $post->getThumbnail());
        $req->bindValue(':text', $post->getText());

        return $req->execute();
    }

    public function updatePost(Post $post)
    {
        $req = $this->_db->prepare('UPDATE users SET title = :title, description = :description, category = :category, authorId = :authorId, thumbnail = :thumbnail, dateUpdate = :dateUpdate, text = :text WHERE id = ' . $post->getId());

        $req->bindValue(':title', $post->getTitle());
        $req->bindValue(':description', $post->getDescription());
        $req->bindValue(':category', $post->getCategory());
        $req->bindValue(':authorId', $post->getAuthorId());
        $req->bindValue(':thumbnail', $post->getThumbnail());
        $req->bindValue(':dateUpdate', new DateTime());
        $req->bindValue(':text', $post->getText());

        return $req->execute();
    }

    public function deletePost(Post $post)
    {
        return $req = $this->_db->exec('DELETE FROM posts WHERE id = ' . $post->getId());
    }

    public function getPostById($id)
    {
        $req = $this->_db->prepare('SELECT * FROM posts WHERE id = :id');
        $req->bindValue(':id', (int)$id);

        $req->execute();
        $data = $req->fetch();

        if(is_array($data))
            return new Post($data);
    }

    public function getAllPost()
    {
        $postsList = [];

        $req = $this->_db->query('SELECT * FROM posts');

        while($post = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($postsList, new Post($post));
        }

        return $postsList;
    }
}