<?php

namespace App\Moel;

use Nette;

class PostRepository{

    private $database;

    public function __construct(Nette\Database\Connection $database)
    {
        $this->database = $database;
    }

    public function insertPost($post)
    {
        $this->database->query('INSERT INTO posts',$post);
    }

    public function getAllPosts($limit, $offset)
    {
        return $this->database->query('SELECT * FROM posts LIMIT ? OFFSET ?',$limit,$offset)->fetchAll();
    }

    public function getPostsCount()
    {
        return $this->database->query('SELECT COUNT(*) FROM posts')->fetchField();
    }
}