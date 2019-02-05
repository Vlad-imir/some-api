<?php

namespace Controller;

use App\Request;
use App\Response;
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
     * CategoryController constructor.
     * @param Request $request
     * @param Response $response
     * @param CategoryService $categoryService
     */
    public function __construct(Request $request, Response $response, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        return parent::__construct($request, $response);
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
        return $this->categoryService->create($this->parseJsonBody());
    }

    /**
     * @param $id
     */
    public function actionUpdate($id)
    {
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