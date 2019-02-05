<?php

namespace Model\Repository;

use Model\Entity\Post;

/**
 * Interface PostRepositoryInterface
 */
interface PostRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllByCatId($id);

    /**
     * @return mixed
     */
    public function getById($id);

    /**
     * @return mixed
     */
    public function create(Post $post);

    /**
     * @return mixed
     */
    public function update(Post $post);

    /**
     * @return mixed
     */
    public function remove(Post $post);
}