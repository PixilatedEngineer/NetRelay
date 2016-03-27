<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relays_model extends CI_Model {

    public function index($board_id)
    {
        $this->db->where('board_id', $board_id);
        $query = $this->db->get('relays');

        return $query->result_array();
    }

    public function get_relay($relay_id)
    {
        $this->db->limit(1);
        $this->db->where('id', $relay_id);
        $query = $this->db->get('relays');

        return $query->row_array();
    }

    public function check_event($relay_id)
    {
        $this->db->where('relay_id', $relay_id);
        $query = $this->db->get('events');

        return $query->result_array();
    }

    public function insert($data)
    {
        $this->db->insert('relays', $data);
        return $this->db->insert_id();
    }

    public function update($data, $relay_id)
    {
        $this->db->where('relay_id', $relay_id);
        $this->db->where('board_id', $data['board_id']);

        $this->db->update('relays', $data);
    }

}