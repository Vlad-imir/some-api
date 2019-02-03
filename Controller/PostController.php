<?php

namespace Controller;

use App\Exception\BadRequestHttpException;
use App\MysqlPDOConnection;
use Model\Repository\PostRepository;

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
        $rep = new PostRepository(MysqlPDOConnection::getInstance());
        $posts = $rep->getAll();
        return $posts;
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        $rep = new PostRepository(MysqlPDOConnection::getInstance());
        $post = $rep->getById($id);
        return $post;
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