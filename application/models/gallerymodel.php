<?php

class GalleryModel extends CI_Model {

    public function getAll() {
        $query = $this->db->get("gallery");

        return $query->result_array();
    }

}
