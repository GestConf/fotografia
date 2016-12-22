<?php

class UserModel extends CI_Model {

    public function validateCredentials($credential) {
        // Set parameters
        $username = $credential->username;
        $password = $credential->password;

        $where = array(
            "email" => $username,
            "password" => $password
        );

        $result = $this->get($where);

        if (!empty($result)) {
            return $result;
        }

        return FALSE;
    }

    public function insert($dataInsert) {
        $this->db->insert("user", $dataInsert);
        return $this->db->insert_id();
    }

    public function get($where) {
        $query = $this->db->get_where('user', $where);

        return $query->row_array();
    }

    public function update($dataUpdate) {
        $this->db->where("id", $dataUpdate->id);
        unset($dataUpdate->id);
        return $this->db->update("user", $dataUpdate);
    }
    
    public function deleteSessions($ipUser) {
        $this->db->where("IpUser", $ipUser);
        $this->db->delete("session");
    }

}
