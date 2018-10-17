<?php
/**
 * Created by PhpStorm.
 * User: Dragoon
 * Date: 18/08/2018
 * Time: 16:21
 */

require_once('utils.php');
spl_autoload_register('loadClass');

class CommentManager extends Database
{
    private $_db;

    public function __construct()
    {
        $this->_db = parent::dbConnect();
        return $this->_db;
    }

    public function createComment(Comment $comment)
    {
        $req = $this->_db->prepare('INSERT INTO comments(postId, userId, text) VALUE(:postId, :userId, :text)');

        $req->bindValue(':postId', $comment->getPostId());
        $req->bindValue(':userId', $comment->getUserId());
        $req->bindValue(':text', $comment->getText());

        return $req->execute();
    }

    public function updateComment(Comment $comment)
    {
        $req = $this->_db->prepare('UPDATE comments SET postId = :postId, userId = :userId, text = :text WHERE id = ' . $comment->getId());

        $req->bindValue(':postId', $comment->getPostId());
        $req->bindValue(':userId', $comment->getUserId());
        $req->bindValue(':text', $comment->getText());

        return $req->execute();
    }

    public function deleteComment(Comment $comment)
    {
        return $req = $this->_db->exec('DELETE FROM posts WHERE id = ' . $comment->getId());
    }

    public function getOneCommentById($commentId)
    {
        $req = $this->_db->prepare('SELECT * FROM comments WHERE id = :commentId');
        $req->bindValue(':commentId', (int)$commentId);

        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if(is_array($data))
            return new Comment($data);
    }

    public function getAllCommentByPostId($postId)
    {
        $commentsList = [];

        $req = $this->_db->prepare('SELECT * FROM comments WHERE postId = :postId');
        $req->bindValue(':postId', (int)$postId);

        $req->execute();

        while($comment = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($commentsList, new Comment($comment));
        }
        $req->closeCursor();

        if(!empty($commentsList))
            return $commentsList;
        else return NULL;
    }

    public function getAllComment()
    {
        $commentsList = [];

        $req = $this->_db->query('SELECT * FROM comments');

        while($comment = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($commentsList, new Comment($comment));
        }
        $req->closeCursor();

        return $commentsList;
    }
}