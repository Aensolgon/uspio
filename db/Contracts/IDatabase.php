<?php
namespace app\DB\Contracts;

interface IDatabase
{
    public function Insert($query = "", $params = []);

    public function Select($query = "", $params = []);

    public function Update($query = "", $params = []);

    public function Remove($query = "", $params = []);
}
