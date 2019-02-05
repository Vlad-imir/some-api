<?php

namespace Model\Service;

use App\Exception\NotFoundHttpException;
use App\Exception\UnprocessableEntityHttpException;
use Model\Entity\Post;
use Model\Repository\CategoryRepositoryInterface;
use Model\Repository\PostRepositoryInterface;

class PostService
{
    private $repository;

    private $categoryRepository;

    public function __construct(PostRepositoryInterface $repository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @return mixed
     */
    public function getById($id)
    {
        $post = $this->failedIfNotFound($id);

        return $post;
    }

    /**
     * @return mixed
     */
    public function create(array $array)
    {
        $post = new Post();
        $post->category_id = (int) $array['category_id'];
        $post->title = trim($array['title']);
        $post->body = trim($array['body']);

        if (!$this->categoryRepository->getById($post->category_id)) {
            throw new UnprocessableEntityHttpException('Cant assign category, category doesnot exist');
        }

        $this->repository->create($post);

        return $post;
    }

    /**
     * @return mixed
     */
    public function update($id, array $array)
    {
        $post = $this->failedIfNotFound($id);

        $post->category_id = (int) $array['category_id'];
        $post->title = trim($array['title']);
        $post->body = trim($array['body']);

        if (!$this->categoryRepository->getById($post->category_id)) {
            throw new UnprocessableEntityHttpException('Cant assign category, category doesnot exist');
        }

        $this->repository->update($post);

        return $post;
    }

    /**
     * @return mixed
     */
    public function remove($id)
    {
        $post = $this->failedIfNotFound($id);

        return $this->repository->remove($post);
    }

    private function failedIfNotFound($id)
    {
        $post = $this->repository->getById($id);

        if (!$post) {
            throw new NotFoundHttpException('Post not found');
        }

        return $post;
    }
}