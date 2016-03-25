<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events_model extends CI_Model {

    public function index($board_id)
    {
        $this->db->select('events.*, relays.name, relays.relay_id, relays.id AS relay_u_id');
        $this->db->from('events');
        $this->db->join('relays', 'events.relay_id = relays.id');
        $this->db->where('events.board_id', $board_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function insert($data)
    {
        $this->db->insert('events', $data);
        return $this->db->insert_id();

    }

    public function update($data, $event_id)
    {
        $this->db->where('id', $event_id);
        $this->db->update('events', $data);
        return $this->db->insert_id();
    }

    public function delete($event_id)
    {
        $this->db->where('id', $event_id);
        $this->db->delete('events');
    }

}