<?php

namespace Model\Repository;

use Model\Entity\Category;

/**
 * Interface CategoryRepositoryInterface
 */
interface CategoryRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getById($id);

    /**
     * @return mixed
     */
    public function create(Category $category);

    /**
     * @return mixed
     */
    public function update(Category $category);

    /**
     * @return mixed
     */
    public function remove(Category $category);
}