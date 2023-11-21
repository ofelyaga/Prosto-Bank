<?php

namespace db;

class MySQL implements \Database
{
    private $table;
    private $db;
    public function __construct(string $table){
        $this->table = $table;
        $this->db = new \mysqli('localhost','root','','prostobank', 3306);
    }

    public function getTable(): string{
        return $this->table;
    }

    public function get(array $where): ?array{
        $sql = "SELECT * FROM " . $this->getTable();
        if(count($where) > 0){
            $w = [];
            foreach($where as $key => $value){
                if(is_null($value)) $value = 'NULL';
                else if(is_string($value)) $value = '"' . $value . '"';

                $w[] = $key . '=' . $value;
            }

            $sql .= ' ' . implode(' AND', $w);
        }

        $result = $this->db->query($sql);
        if(is_bool($result)) return null;

        if($result->num_rows == 0) return null;
        else if($result->num_rows == 1) return $result->fetch_assoc();

        return $result->fetch_array();
    }

    public function insert(array $data): void{

    }
    public function update(array $updateData, array $where): void{

    }
    public function delete(array $where): void{

    }
}