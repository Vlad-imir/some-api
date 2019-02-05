<?php

namespace Model\Repository;

use Model\Entity\Category;

/**
 * Class PostRepository
 */
class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     *
     */
    const TABLE_NAME = 'category';

    /**
     * @var
     */
    protected $entityClass = Category::class;

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
     * @param Category $cat
     * @return bool
     */
    public function create(Category $cat)
    {
        $sql = 'INSERT INTO ' . self::TABLE_NAME .
               '(name, created_at)  VALUES (?,?)';

        $result = $this->connection
            ->prepare($sql)
            ->execute([
                $cat->name,
                $cat->created_at,
            ]);

        $cat->id = $this->connection->lastInsertId();

        return $result;
    }

    /**
     * @param Category $cat
     * @return bool
     */
    public function update(Category $cat)
    {
        $sql = 'UPDATE ' . self::TABLE_NAME .
            ' SET name=? WHERE id=?';

        $result = $this->connection
            ->prepare($sql)
            ->execute([
                $cat->name,
                $cat->id,
            ]);

        return $result;
    }

    /**
     * @param Category $cat
     */
    public function remove(Category $cat)
    {
        $result = $this->connection
            ->prepare('DELETE FROM ' . self::TABLE_NAME . ' WHERE id=?');
        $result->execute([$cat->id]);
    }
}