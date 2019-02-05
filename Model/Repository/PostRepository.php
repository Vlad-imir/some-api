<?php

namespace Model\Repository;

use Model\Entity\Post;

/**
 * Class PostRepository
 */
class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    /**
     *
     */
    const TABLE_NAME = 'post';

    /**
     * @var
     */
    protected $entityClass = Post::class;

    /**
     * @return array
     */
    public function getAll()
    {
        $result = $this->connection
            ->query('SELECT * FROM ' . self::TABLE_NAME . ' ORDER BY id DESC')
            ->fetchAll();

        $result = $this->prepareEntities($result);
        return $result;
        //print_r($result);exit;
    }

    /**
     * @param $id
     * @return AbstractRepository|null
     */
    public function getById($id)
    {
        $result = $this->connection
            ->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE id=?');
        $result->execute([$id]);
        $result = $result->fetch(\PDO::FETCH_ASSOC);

        return $result ? $this->prepareEntity($result) : null;
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function create(Post $post)
    {
        $sql = 'INSERT INTO ' . self::TABLE_NAME .
               '(title, body, category_id, created_at)' .
               ' VALUES (?,?,?,?)';

        $result = $this->connection
            ->prepare($sql)
            ->execute([
                $post->title,
                $post->body,
                $post->category_id,
                $post->created_at,
            ]);

        $post->id = $this->connection->lastInsertId();

        return $result;
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function update(Post $post)
    {
        $sql = 'UPDATE ' . self::TABLE_NAME .
            ' SET title=?, body=?, category_id=?' .
            ' WHERE id=?';

        $result = $this->connection
            ->prepare($sql)
            ->execute([
                $post->title,
                $post->body,
                $post->category_id,
                $post->id,
            ]);

        return $result;
    }

    /**
     * @param Post $post
     */
    public function remove(Post $post)
    {
        $result = $this->connection
            ->prepare('DELETE FROM ' . self::TABLE_NAME . ' WHERE id=?');
        $result->execute([$post->id]);
    }
}