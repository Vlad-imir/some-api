<?php

namespace Controller;

use App\Request;
use App\Response;

/**
 * Class AbstractController
 */
abstract class AbstractController
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * AbstractController constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     *
     */
    public function getRequest()
    {
        $this->request;
    }

    /**
     *
     */
    public function getResponse()
    {
        $this->response;
    }

    /**
     * @return mixed
     */
    public function parseJsonBody()
    {
        $content = json_decode($this->request->getBody(), true);
        return $content;
    }

    /**
     * @return mixed
     */
    abstract public function actionIndex();

    /**
     * @param $id
     * @return mixed
     */
    abstract public function actionView($id);

    /**
     * @return mixed
     */
    abstract public function actionCreate();

    /**
     * @param $id
     * @return mixed
     */
    abstract public function actionUpdate($id);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function actionDelete($id);

}