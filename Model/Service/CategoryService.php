<?php

namespace Model\Service;

use App\Exception\NotFoundHttpException;
use App\Exception\UnprocessableEntityHttpException;
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
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository, PostRepositoryInterface $postRepository)
    {
        $this->repository = $repository;
        $this->postRepository = $postRepository;
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
        $cat->name = htmlspecialchars(trim($array['name']));
        $this->repository->create($cat);

        return $cat;
    }

    /**
     * @return mixed
     */
    public function update($id, array $array)
    {
        $cat = $this->failedIfNotFound($id);
        $cat->name = htmlspecialchars(trim($array['name']));

        $this->repository->update($cat);

        return $cat;
    }

    /**
     * @return mixed
     */
    public function remove($id)
    {
        $cat = $this->failedIfNotFound($id);

        $posts = $this->postRepository->getAllByCatId($id);
        if ($posts) {
            throw new UnprocessableEntityHttpException('Cant remove category, some posts are using it');
        }

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