<?php
class TypeModel extends Database {
    public function getAll() {
        $query = "SELECT * FROM types";
        return $this->execute($query);
    }

    public function getById($typeId) {
        $query = "SELECT * FROM types WHERE id = $typeId";
        return $this->execute($query);
    }

    public function store($data) {
        $query = "INSERT INTO types VALUES (null, '$data[type_name]', '$data[information]')";
        return $this->execute($query);
    }

    public function update($data, $typeId) {
        $query = "UPDATE types SET";
        print_r($data);
        foreach($data as $key => $value) {
            if(is_string($value)) $query .= " $key = '$value',";
            else $query .= " $key = $value,";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = $typeId";

        echo $query;
        return $this->execute($query);
    }

    public function delete($typeId) {
        $query = "DELETE FROM types WHERE id = $typeId";
        return $this->execute($query);
    }
}