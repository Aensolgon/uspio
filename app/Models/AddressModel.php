<?php

namespace app\Models;

use app\DB\MySQLDatabase;

class AddressModel
{
    private MySQLDatabase $db;
    protected string $table = 'addresses';

    public function __construct()
    {
        $this->db = new MySQLDatabase();
    }

    /**
     * @throws \Exception
     */
    public function saveAddress($address)
    {
        try {
            $address = $this->db->real_escape_string($address);
            return $this->db->Insert("INSERT INTO {$this->table} (address) VALUES ( ? )", ['s', $address]);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws \Exception
     */
    public function getHistory()
    {
        try {
            return $this->db->Select("SELECT * FROM {$this->table} ORDER BY id DESC");
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
