<?php

namespace Controller;

use App\Exception\BadRequestHttpException;
use App\Request;
use App\Response;
use Component\CategoryValidator;
use Model\Service\CategoryService;

/**
 * Class CategoryController
 */
class CategoryController extends AbstractController
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @var CategoryValidator
     */
    private $categoryValidator;

    /**
     * CategoryController constructor.
     * @param Request $request
     * @param Response $response
     * @param CategoryService $categoryService
     */
    public function __construct(
        Request $request,
        Response $response,
        CategoryService $categoryService,
        CategoryValidator $categoryValidator
    ) {
        $this->categoryService = $categoryService;
        $this->categoryValidator = $categoryValidator;
        parent::__construct($request, $response);
    }

    /**
     * @return int
     */
    public function actionIndex()
    {
        return $this->categoryService->getAll();
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        return $this->categoryService->getById($id);
    }

    /**
     *
     */
    public function actionCreate()
    {
        $body = $this->parseJsonBody();
        if (!$this->categoryValidator->validate($body)) {
            throw new BadRequestHttpException($this->categoryValidator->getError());
        }

        return $this->categoryService->create($this->parseJsonBody());
    }

    /**
     * @param $id
     */
    public function actionUpdate($id)
    {
        $body = $this->parseJsonBody();
        if (!$this->categoryValidator->validate($body)) {
            throw new BadRequestHttpException($this->categoryValidator->getError());
        }

        return $this->categoryService->update($id, $this->parseJsonBody());
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        return $this->categoryService->remove($id);
    }
}