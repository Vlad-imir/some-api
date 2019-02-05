<?php

namespace Model\Service;

use App\Exception\NotFoundHttpException;
use Model\Entity\Post;
use Model\Repository\PostRepositoryInterface;

class PostService
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $post->category_id = $array['category_id'];
        $post->title = $array['title'];
        $post->body = $array['body'];

        $this->repository->create($post);

        return $post;
    }

    /**
     * @return mixed
     */
    public function update($id, array $array)
    {
        $post = $this->failedIfNotFound($id);

        $post->category_id = $array['category_id'];
        $post->title = $array['title'];
        $post->body = $array['body'];

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