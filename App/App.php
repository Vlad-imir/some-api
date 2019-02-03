<?php

namespace App;
use App\Exception\HttpException;

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
     * App constructor.
     * @param Request $request
     * @param Response $response
     * @param Router $router
     */
    public function __construct(Request $request, Response $response, Router $router)
    {
        $this->request = $request;
        $this->response = $response;
        $this->router = $router;
    }

    /**
     *
     */
    public function run()
    {
        try {
            $route = $this->router->getRoute();

            if ($route) {
                $this->response->setContent($this->runAction($route));
            }
        } catch (HttpException $exception) {
            $this->response->setStatusCode($exception->getStatusCode());
            $this->response->setContent(['message' => $exception->getMessage()]);
        } catch (\Exception $exception) {
            $this->response->setStatusCode(500);
            $this->response->setContent(['message' => $exception->getMessage()]);
        }

        $this->response->send();
    }

    /**
     * @param $route
     * @return mixed
     */
    private function runAction($route)
    {
        $controller = new $route[0]($this->request, $this->response);
        $action = $route[1];
        return call_user_func_array([$controller, $action], $route[2]);
    }
}