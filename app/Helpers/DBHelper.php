<?php

namespace App\Helpers;

use PDO;
use Illuminate\Support\Facades\Config;

class DBHelper
{
    private $connection;
    private static $connectionn;
    private $table;
    public $query;
    private $where;
    private static function connect($database, $connection = 'mysql1')
    {
        try {
            $host     = Config::get("database.connections.{$connection}.host", 'localhost');
            $user     = Config::get("database.connections.{$connection}.username", 'root');
            $password = Config::get("database.connections.{$connection}.password", '');
            $conn = new PDO("mysql:host={$host};dbname={$database}", $user, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connectionn = $conn;
            return $conn;
        } catch (\PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }
    public function setConnection($connection) {
         $this->connection = $connection;
         return $this;
    }
    public static function db($databases, $connection = 'mysql1')
    {
        $con = self::connect($databases, $connection);
        $self = new self();
        return $self->setConnection($con);
    }
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }
    public function update(array $array)
    {
        $query = "UPDATE " . $this->table . " SET";
        $bind = collect();
        foreach ($array as $key => $value) {
            $query .= " {$key}=?";
            $bind->push($value);
        }
        $query .= " WHERE";
        $i = 1;
        foreach ($this->where as $key => $value) {
            $query .= " {$key}=?";
            if (count($this->where) >= 2 && count($this->where) != $i) {
                $query .= " AND";
            }
            $bind->push($value);
            $i++;
        }
        $this->query = $query;
        $conn = self::$connectionn;
        // return $bind->toArray();
        // return $conn;
        // return $query;
        try {
            $conn->prepare($query)->execute($bind->toArray());
            return 'sucess';
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get()
    {
        $table = $this->table;
        $query = "SELECT * FROM " . $table;
        $conn = self::$connectionn;
        if (!empty($this->where)) {
            $i = 1;
            foreach ($this->where as $key => $value) {
                $query .= " WHERE";
                $query .= " {$key}=?";
                if (count($this->where) >= 2 && count($this->where) != $i) {
                    $query .= " AND";
                }
                $i++;
            }
        }
        $result = $conn->query($query);
        return $result->fetchAll(PDO::FETCH_CLASS);
    }
    public function where($column, $value)
    {
        $where = collect($this->where);
        $where->put($column, $value);
        $this->where = $where->toArray();
        return $this;
    }
    public function first()
    {
        $table = $this->table;
        $query = "SELECT * FROM " . $table;
        $conn = self::$connectionn;
        if (!empty($this->where)) {
            $i = 1;
            foreach ($this->where as $key => $value) {
                $query .= " WHERE";
                $query .= " {$key}=?";
                if (count($this->where) >= 2 && count($this->where) != $i) {
                    $query .= " AND";
                }
                $i++;
            }
        }
        $result = $conn->query($query);
        return $result->fetchObject();
    }
}
