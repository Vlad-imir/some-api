<?php

namespace Controller;

use App\Exception\BadRequestHttpException;
use App\Request;
use App\Response;
use Component\PostValidator;
use Model\Service\PostService;

/**
 * Class PostController
 */
class PostController extends AbstractController
{
    /**
     * @var PostService
     */
    private $postService;

    /**
     * @var PostValidator
     */
    private $postValidator;

    public function __construct(
        Request $request,
        Response $response,
        PostService $postService,
        PostValidator $postValidator
    ) {
        $this->postService = $postService;
        $this->postValidator = $postValidator;
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
        $body = $this->parseJsonBody();
        if (!$this->postValidator->validate($body)) {
            throw new BadRequestHttpException($this->postValidator->getError());
        }

        return $this->postService->create($body);
    }

    /**
     * @param $id
     */
    public function actionUpdate($id)
    {
        $body = $this->parseJsonBody();
        if (!$this->postValidator->validate($body)) {
            throw new BadRequestHttpException($this->postValidator->getError());
        }

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