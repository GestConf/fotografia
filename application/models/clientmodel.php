<?php

class ClientModel extends CI_Model {

    public function save($data) {
        return $this->db->insert("client", $data);
    }

    public function getAll() {
        $query = $this->db->get("client");
        return $query->result_array();
    }

    public function get($id) {
        $query = $this->db->get_where('client', array("Id" => $id));

        return $query->row_array();
    }

}
