<?php

namespace App;
use App\Exception\HttpException;
use App\Exception\NotFoundHttpException;

/**
 * Class App
 */
class App
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
     * @var Router
     */
    private $router;

    /**
     * @var Container
     */
    private $container;

    /**
     * App constructor.
     * @param Request $request
     * @param Response $response
     * @param Router $router
     * @param Container $container
     */
    public function __construct(
        Request $request,
        Response $response,
        Router $router,
        Container $container
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->router = $router;
        $this->container = $container;
    }

    /**
     *
     */
    public function run()
    {
        try {
            $route = $this->router->getRoute();

            if ($route) {
                $this->setResponseSuccess($this->runAction($route));
            } else {
                throw new NotFoundHttpException();
            }
        } catch (HttpException $exception) {
            $this->setResponseError($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            $this->setResponseError($exception->getMessage());
        }

        $this->response->send();
    }

    /**
     * @param $route
     * @return mixed
     */
    private function runAction($route)
    {
        $controllerName = $route[0];
        //$controller = new $controllerName($this->request, $this->response);

        $controller = $this->container->get($controllerName, [$this->request, $this->response]);
        var_dump($controller);

        //var_dump($class->newInstanceArgs([$this->request, $this->response]));
        exit;

        $action = $route[1];
        return call_user_func_array([$controller, $action], $route[2]);
    }

    /**
     * @param $content
     */
    private function setResponseSuccess($content)
    {
        $this->response->setContent($content);
    }

    /**
     * @param $content
     * @param int $code
     */
    private function setResponseError($content, $code = 500)
    {
        $this->response->setContent(['message' => $content]);
        $this->response->setStatusCode($code);
    }
}