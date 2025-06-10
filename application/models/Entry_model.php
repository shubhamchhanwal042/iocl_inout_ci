<?php
class Entry_model extends CI_Model {

    public function add_entry($name) {
        $this->db->insert('entries', ['person_name' => $name]);
    }
}
