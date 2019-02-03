<?php

namespace Model\Repository;

use Model\Entity\Post;

class PostReposotory extends AbstractRepository implements PostRepositoryInterface
{
    const TABLE_NAME = 'post';

    public function getAll()
    {
        $this->connection->query('SELECT * FROM ' . self::TABLE_NAME);
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function create(Post $post)
    {
        // TODO: Implement create() method.
    }

    public function update(Post $post)
    {
        // TODO: Implement update() method.
    }

    public function remove(Post $post)
    {
        // TODO: Implement remove() method.
    }
}