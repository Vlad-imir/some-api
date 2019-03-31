<?php

namespace App;

class Router
{
    /**
     * @var Request
     */
    private $request;

    private $config;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config = require __DIR__ . '/../config/routing.php';
    }

    /**
     * Return route array with format [0 => controller name, 1 => action name, 2 => action params]
     *
     * @return bool|array
     */
    public function getRoute()
    {
        $uri = $this->request->getUri();
        $uri = explode('?', $uri)[0];

        foreach ($this->config as $item) {
            if ($route = $this->handle($item, $uri)) {
                return $route;
            }
        }

        return false;
    }

    /**
     * Create route
     *
     * @param $item
     * @param $uri
     * @return array|bool
     */
    private function handle($item, $uri)
    {
        $result = [
            $item['controller'][0],
            'action' . ucfirst($item['controller'][1]),
            [],
        ];

        if ($this->request->getMethod() !== $item['method']) {
            return false;
        }

        $path = $item['path'];
        $rawPattern = str_replace('/', '\\/', $path);
        $search = array_keys($item['params']);
        $replace = array_map(function ($item) {
            return '(' . $item . ')';
        }, $item['params']);
        $pattern = str_replace($search, $replace, $rawPattern);
        $pattern = '/' . $pattern . '$/';

        $res = preg_match($pattern, $uri, $matches);

        if ($res) {
            if (count($matches) > 1) {
                $values = array_slice($matches, 1);
                $result[2] = $this->prepareParams($values, $item['params']);
            }
            return $result;
        }
        return false;
    }

    /**
     * Prepare actions params
     *
     * @param $matches
     * @param $params
     * @return array
     */
    private function prepareParams($matches, $params)
    {
        $keys = array_map(function ($item) {
            return  str_replace(['}', '{'], '', $item);
        }, array_keys($params));

        return array_combine($keys, $matches);
    }
}