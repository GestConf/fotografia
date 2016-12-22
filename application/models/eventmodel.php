<?php

class EventModel extends CI_Model {

    public function getEvents($idClient) {
        $sql = "select
            e.Id as IdEvent,
c.FullName,
e.Name
FROM
events e
inner join client c
on e.IdClient = c.Id
where c.Id = ?";

        $query = $this->db->query($sql, array($idClient));

        return $query->result_array();
    }

    public function gallery($idEvent) {
        $query = $this->db->get_where('gallery', array("IdEvent" => $idEvent));

        return $query->result_array();
    }

    public function insert($data) {
        return $this->db->insert("events", $data);
    }

    public function insertUserEvent($data) {
        $this->db->insert("user_event", $data);
    }

    public function getEventsUser($idUser) {
        $sql = "SELECT
	e.Id as IdEvent,
	c.FullName AS anfitrion,
	e.name AS evento
FROM
	events e
INNER JOIN user_event ue ON e.Id = ue.IdEvent
INNER JOIN client c ON c.Id = e.IdClient
WHERE
	ue.IdUser = ?
        group by ue.IdUser, ue.IdEvent";

        $query = $this->db->query($sql, array($idUser));

        return $query->result_array();
    }

}
