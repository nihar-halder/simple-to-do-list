<?php

namespace App\Models;

use App\Config\Database;

class Modal
{
    protected $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $config = (new Database)->config;
        if ($connect = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database'])) {
            $this->connection = $connect;
        } else {
            die("Database Connection failed: " . mysqli_connect_errno());
        }
    }
}
