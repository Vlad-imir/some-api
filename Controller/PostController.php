<?php

namespace Controller;

use App\Exception\BadRequestHttpException;
use App\MysqlPDOConnection;
use Model\Repository\PostReposotory;

/**
 * Class PostController
 */
class PostController extends AbstractController
{

    /**
     * @return int
     */
    public function actionIndex()
    {
        $rep = new PostReposotory(MysqlPDOConnection::getInstance());
        $posts = $rep->getAll();
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {

    }

    /**
     *
     */
    public function actionCreate()
    {

    }

    /**
     * @param $id
     */
    public function actionUpdate($id)
    {

    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {

    }
}