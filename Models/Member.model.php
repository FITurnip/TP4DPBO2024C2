<?php
class MemberModel extends Database {
    public function getAll() {
        $query = "SELECT * FROM members";
        return $this->execute($query);
    }

    public function getById($memberId) {
        $query = "SELECT * FROM members WHERE id = $memberId";
        return $this->execute($query);
    }

    public function store($data) {
        $data["joining_date"] = date("Y-m-d h:m:s");
        $query = "INSERT INTO members VALUES (null, '$data[name]', '$data[email]', $data[phone], '$data[joining_date]')";
        return $this->execute($query);
    }

    public function update($data, $memberId) {
        $query = "UPDATE members SET";
        foreach($data as $key => $value) {
            if(is_string($value)) $query .= " $key = '$value',";
            else $query .= " $key = $value,";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = $memberId";

        echo $query;
        return $this->execute($query);
    }

    public function delete($memberId) {
        $query = "DELETE FROM members WHERE id = $memberId";
        return $this->execute($query);
    }
}