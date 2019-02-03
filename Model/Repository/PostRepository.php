<?php

namespace Model\Repository;

use Model\Entity\Post;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    const TABLE_NAME = 'post';

    protected $entityClass = Post::class;

    public function getAll()
    {
        $result = $this->connection
            ->query('SELECT * FROM ' . self::TABLE_NAME . ' ORDER BY id DESC')
            ->fetchAll();

        $result = $this->prepareEntities($result);
        return $result;
        //print_r($result);exit;
    }

    public function getById($id)
    {
        $result = $this->connection
            ->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE id=1');
        $result->execute();
        $result = $result->fetch(\PDO::FETCH_ASSOC);

        return $this->prepareEntity($result);
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