<?php

namespace Controller;

use App\Exception\BadRequestHttpException;
use App\Request;
use App\Response;
use Component\OutputFilter;
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

    /**
     * @var OutputFilter
     */
    private $outputFilter;

    /**
     * PostController constructor.
     * @param Request $request
     * @param Response $response
     * @param PostService $postService
     * @param PostValidator $postValidator
     * @param OutputFilter $outputFilter
     */
    public function __construct(
        Request $request,
        Response $response,
        PostService $postService,
        PostValidator $postValidator,
        OutputFilter $outputFilter
    ) {
        $this->postService = $postService;
        $this->postValidator = $postValidator;
        $this->outputFilter = $outputFilter;
        parent::__construct($request, $response);
    }

    /**
     * @return int
     */
    public function actionIndex()
    {
        $collection = $this->postService->getAll();

        return $this->outputFilter->filter($collection);
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        $post = $this->postService->getById($id);

        return $this->outputFilter->filter($post);
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

        $post = $this->postService->create($body);

        return $this->outputFilter->filter($post);
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

        $post = $this->postService->update($id, $this->parseJsonBody());

        return $this->outputFilter->filter($post);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        return $this->postService->remove($id);
    }
}