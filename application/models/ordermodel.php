<?php

class OrderModel extends CI_Model {

    public function save($data) {
        return $this->db->insert("cashorder", $data);
    }

    public function getAll($idUser) {
        $where = (GetFromSession("UserType") == "User") ? "WHERE
	u.id = ?" : "";
        $sql = "SELECT
	u.Id as IdUser,
	u.user_name,
	e.name as evento
FROM
	cashorder co
INNER JOIN gallery g ON co.IdGallery = g.Id
INNER JOIN EVENTS e ON e.Id = g.IdEvent
INNER JOIN USER u ON u.id = co.IdUser
$where
GROUP BY
	u.id";

        $query = ($idUser != NULL) ? $this->db->query($sql) : $this->db->query($sql, array($idUser));

        return $query->result_array();
    }

    public function getPhotos($idUser) {
        $sql = "SELECT
	g.UrlImage
FROM
	cashorder co
INNER JOIN gallery g ON co.IdGallery = g.Id
INNER JOIN EVENTS e ON e.Id = g.IdEvent
INNER JOIN USER u ON u.id = co.IdUser
where co.IdUser = ?";

        $query = $this->db->query($sql, array($idUser));

        return $query->result_array();
    }

    public function get($data) {
        $query = $this->db->get_where('cashorder', $data);

        return $query->result_array();
    }

}
