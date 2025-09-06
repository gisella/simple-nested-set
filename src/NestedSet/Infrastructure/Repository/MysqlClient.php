<?php

namespace NestedSet\Infrastructure\Repository;

use NestedSet\Domain\Model\Exception\DatabaseConnectionException;
use PDO;

class MysqlClient
{
    private $conn;

    /**
     * @param string $dbUrl
     * @param string $username
     * @param string $password
     * @throws DatabaseConnectionException
     */
    public function __construct(string $dbUrl, string $username, string $password)
    {
        $this->open($dbUrl, $username, $password);
    }

    /**
     * @param string $dbUrl
     * @param string $username
     * @param string $password
     * @throws DatabaseConnectionException
     */
    private function open(string $dbUrl, string $username, string $password)
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $this->conn = new PDO($dbUrl, $username, $password, $options);
        } catch (\PDOException $e) {
            throw new DatabaseConnectionException($e->getMessage());
        }
    }

    /**
     * @param string $preparedQuery
     * @param array $params
     * @return array
     */
    function execPreparedStatement(string $preparedQuery, array $params): array
    {
        $stmt = $this->conn->prepare($preparedQuery);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }


}