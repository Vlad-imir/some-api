<?php

namespace Model\Repository;

use App\MysqlPDOConnection;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository
{
    /**
     * @var
     */
    protected $entityClass;

    /**
     * @var MysqlPDOConnection
     */
    protected $connection;

    /**
     * AbstractRepository constructor.
     * @param MysqlPDOConnection $connection
     */
    public function __construct(MysqlPDOConnection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    /**
     * @param array $record
     * @return AbstractRepository
     */
    protected function prepareEntity(array $record)
    {
        $class = $this->getEntityClass();
        $obj = new $class;
        $objVars = get_object_vars($obj);
/*var_dump($objVars);
var_dump($record);
        exit;*/
        foreach ($objVars as $k => $value) {
            $obj->{$k} = $record[$k];
        }
        return $obj;
    }

    /**
     * @param array $records
     * @return array
     */
    protected function prepareEntities(array $records)
    {
        $result = [];

        foreach ($records as $record) {
            $result[] = $this->prepareEntity($record);
        }

        return $result;
    }

    /**
     * @return mixed
     */
    protected function getEntityClass()
    {
        return $this->entityClass;
    }
}