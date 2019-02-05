<?php

namespace Model\Service;

use App\Exception\NotFoundHttpException;
use Model\Entity\Category;
use Model\Entity\Post;
use Model\Repository\CategoryRepositoryInterface;
use Model\Repository\PostRepositoryInterface;

/**
 * Class CategoryService
 */
class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @return mixed
     */
    public function getById($id)
    {
        $cat = $this->failedIfNotFound($id);

        return $cat;
    }

    /**
     * @return mixed
     */
    public function create(array $array)
    {
        $cat = new Category();
        $cat->name = $array['name'];
        $this->repository->create($cat);

        return $cat;
    }

    /**
     * @return mixed
     */
    public function update($id, array $array)
    {
        $cat = $this->failedIfNotFound($id);
        $cat->name = $array['name'];

        $this->repository->update($cat);

        return $cat;
    }

    /**
     * @return mixed
     */
    public function remove($id)
    {
        $cat = $this->failedIfNotFound($id);

        return $this->repository->remove($cat);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    private function failedIfNotFound($id)
    {
        $cat = $this->repository->getById($id);

        if (!$cat) {
            throw new NotFoundHttpException('Category not found');
        }

        return $cat;
    }
}