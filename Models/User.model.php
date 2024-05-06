<?php
class UserModel extends Database {
    public function getAll() {
        $query = "SELECT users.id, users.username, users.password, members.name AS member_name, types.type_name
            FROM users INNER JOIN members ON users.member_id = members.id INNER JOIN types ON types.id = users.type_id";
        return $this->execute($query);
    }

    public function getById($userId) {
        $query = "SELECT * FROM users WHERE id = $userId";
        return $this->execute($query);
    }

    public function store($data) {
        $data["joining_date"] = date("Y-m-d h:m:s");
        $query = "INSERT INTO users VALUES (null, '$data[username]', '$data[password]', $data[member_id], $data[type_id])";
        return $this->execute($query);
    }

    public function update($data, $userId) {
        $query = "UPDATE users SET";
        print_r($data);
        foreach($data as $key => $value) {
            if(is_string($value)) $query .= " $key = '$value',";
            else $query .= " $key = $value,";
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = $userId";

        echo $query;
        return $this->execute($query);
    }

    public function delete($userId) {
        $query = "DELETE FROM users WHERE id = $userId";
        return $this->execute($query);
    }
}