<?php

namespace App\Helpers;

use PDO;
use PDOException;

class DB
{
    const CREATE = "CREATE";
    protected $db;
    protected $query = "SELECT * FROM %TBL%";
    
    public function __construct()
    {
        $host = config('database.host');
        $db = config('database.database');
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$db", config('database.username', 'root'), config('database.password'));
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw $e;
            die;
        }
    }

    public function setQueryTo(string $mode)
    {
        if($mode === 'CREATE') {
            $this->query = "INSERT INTO %TBL% (%FIELDS%) VALUES (%VAL%)";
        }
        return $this;
    }

    public function create(array $data, string $table)
    {
        $keys = stringify(array_keys($data));
        $this->query = str_replace('%FIELDS%', $keys, $this->query);
        $vals = stringify(array_values($data), true);
        $this->query = str_replace('%VAL%', $vals, $this->query);
        $this->table($table);
        echo $this->query;
        $statement = $this->db->prepare($this->query);
        return $statement->execute();
    }

    public function table(string $table)
    {
        $this->query = str_replace("%TBL%", $table, $this->query);
        return $this;
    }

    /**
     * Fetch query result as object
     */
    public function get()
    {
        $statement = $this->db->prepare($this->query);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }
    
}