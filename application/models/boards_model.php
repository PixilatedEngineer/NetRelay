<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boards_model extends CI_Model {

    public function index()
    {
        $query = $this->db->get('boards');

        return $query->result_array();
    }

    public function get_board($board_id)
    {
        $this->db->limit(1);
        $this->db->where('id', $board_id);
        $query = $this->db->get('boards');

        return $query->row_array();
    }

    public function insert($data)
    {
        $this->db->insert('boards', $data);
        return $this->db->insert_id();
    }

    public function update($data, $board_id)
    {
        $this->db->where('id', $board_id);
        $this->db->update('boards', $data);
    }

    public function delete($board_id)
    {
        $this->db->where('id', $board_id);
        $this->db->delete('boards');
    }

}