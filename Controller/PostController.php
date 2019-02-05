<?php

namespace Controller;

use App\Exception\BadRequestHttpException;
use App\MysqlPDOConnection;
use App\Request;
use App\Response;
use Model\Repository\PostRepository;
use Model\Service\PostService;

/**
 * Class PostController
 */
class PostController extends AbstractController
{
    private $postService;

    public function __construct(Request $request, Response $response)
    {
        $postRepo = new PostRepository(MysqlPDOConnection::getInstance());
        $this->postService = new PostService($postRepo);

        return parent::__construct($request, $response);
    }

    /**
     * @return int
     */
    public function actionIndex()
    {
        return $this->postService->getAll();
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        return $this->postService->getById($id);
    }

    /**
     *
     */
    public function actionCreate()
    {
        return $this->postService->create($this->parseJsonBody());
    }

    /**
     * @param $id
     */
    public function actionUpdate($id)
    {
        return $this->postService->update($id, $this->parseJsonBody());
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        return $this->postService->remove($id);
    }
}