<?php

namespace app\DB;

use app\DB\Contracts\IDatabase;
use Exception;
use Throwable;
use mysqli;

class MySQLDatabase implements IDatabase
{
    private string $host = DB_HOST;
    private string $username = DB_USERNAME;
    private string $password = DB_PASSWORD;
    private string $db_name = DB_NAME;
    private ?mysqli $connection = null;

    /**
     * @throws Throwable
     */
    public function __construct()
    {
        try {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }

        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

    /**
     * @throws Throwable
     */
    public function Insert($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $stmt->close();

            return $this->connection->insert_id;
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function Select($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Throwable
     */
    public function Update($query = "", $params = [])
    {
        try {
            $this->executeStatement($query, $params)->close();
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Throwable
     */
    public function Remove($query = "", $params = [])
    {
        try {
            $this->executeStatement($query, $params)->close();
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Throwable
     */
    private function executeStatement($query = "", $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }

            if ($params) {
                call_user_func_array(array($stmt, 'bind_param'), $params);
            }

            $stmt->execute();

            return $stmt;
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws Throwable
     */
    public function real_escape_string($string): string
    {
        try {
            return $this->connection->real_escape_string($string);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
