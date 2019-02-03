<?php

namespace Model\Repository;

use App\MysqlPDOConnection;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository
{
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
}