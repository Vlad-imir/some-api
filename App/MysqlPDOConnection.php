<?php

namespace App;

/**
 * Class MysqlPDOConnection
 */
class MysqlPDOConnection
{
    /**
     * @var
     */
    private static $instance;

    /**
     * @var
     */
    private $dbname;
    /**
     * @var
     */
    private $host;
    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $port;
    /**
     * @var
     */
    private $connection;

    /**
     * @return MysqlPDOConnection
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * MysqlPDOConnection constructor.
     */
    public function __construct()
    {
        $config = require __DIR__ . '/../config/db.php';
        $this->dbname = $config['dbname'];
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->port = $config['port'];
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        if (!$this->connection) {
            $this->connection = new \PDO(
                $this->getDsn(),
                $this->username,
                $this->password,
                $options
            );
        }

        return $this->connection;
    }

    /**
     * @return string
     */
    private function getDsn()
    {
        $dsn = "mysql:dbname={$this->dbname};host={$this->host}";

        if ($this->port) {
            $dsn .= ';port=' . $this->port;
        }

        return $dsn;
    }
}