<?php

namespace Component;

/**
 * Class OutputFilter
 */
class OutputFilter
{
    /**
     * @param $data
     * @return array
     */
    public function filter($data)
    {
        if (is_array($data)) {
            $res = [];
            foreach ($data as $one) {
                $res[] = $this->handleObject($one);
            }
            return $res;
        } elseif (is_object($data)) {
            return $this->handleObject($data);
        }
    }

    /**
     * @return array
     */
    private function getFields()
    {
        return [
            'id',
            'title' => function ($item) {
                return htmlspecialchars($item->title);
            },
            'body' => function ($item) {
                return htmlspecialchars($item->body);
            },
            'category' => function ($item) {
                return ['href' => 'http://localhost:8000/category/' . $item->id];
            },
            'created_at' => function ($item) {
                return (new \DateTime($item->created_at))->format('Y-m-d');
            },
        ];
    }

    /**
     * @param $data
     * @return array
     */
    private function handleObject($data)
    {
        $result = [];

        foreach ($this->getFields() as $k => $one) {
            if (is_callable($one)) {
                $result[$k] = $one($data);
            } else {
                $result[$one] = $data->{$one};
            }
        }

        return (object) $result;
    }
}