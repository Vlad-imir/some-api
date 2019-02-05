<?php

namespace Model\Entity;

class Post
{
    public $id;
    public $title;
    public $body;
    public $category_id;
    public $created_at;

    public function __construct()
    {
        $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
    }
}