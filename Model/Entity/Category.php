<?php

namespace Model\Entity;

class Category
{
    public $id;
    public $name;
    public $created_at;

    public function __construct()
    {
        $this->created_at = (new \DateTime())->format('Y-m-d H:i:s');
    }
}