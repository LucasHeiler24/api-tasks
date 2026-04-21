<?php
namespace src\db\connection;

use Exception;
use PDO;
use PDOException;

class Connection{
    private ?PDO $connection = null;

    public function getConnection(){
        if($this->connection) return $this->connection;

        try{
            $this->connection = new PDO("pgsql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']}", "{$_ENV['DB_USER']}", "{$_ENV['DB_PASSWORD']}");
            return $this->connection;
        }
        catch(PDOException $e){
            throw new Exception("Error in get connection: " . $e->getMessage());
        }
    }
}