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

    public function filterPosts($column,$keyword,$limit, $offset)
    {
        return $this->database->query('SELECT * FROM posts WHERE ?name LIKE "%"?"%" LIMIT ? OFFSET ?',$column,$keyword,$limit, $offset)->fetchAll();
    }

    public function sortPostsAsc($column, $limit, $offset)
    {
        return $this->database->query('SELECT * FROM posts ORDER BY ?name ASC LIMIT ? OFFSET ?',$column,$limit, $offset)->fetchAll();
    }

    public function sortPostsDesc($column, $limit, $offset)
    {
        return $this->database->query('SELECT * FROM posts ORDER BY ?name DESC LIMIT ? OFFSET ?',$column,$limit, $offset)->fetchAll();
    }

    public function getPostsFilterCount($column, $keyword)
    {
        return $this->database->query('SELECT COUNT(*) FROM posts WHERE ?name LIKE "%"?"%"',$column,$keyword)->fetchField();
    }

}