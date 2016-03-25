<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boards extends CI_Controller {

	public function index()
	{
        $this->load->model(array('boards_model', 'relays_model'));

        $boards = $this->boards_model->index();

        foreach($boards as $board) {
            $data['boards'][$board['id']] = $board;
            $relays = array();

            foreach($this->relays_model->index($board['id']) as $relay){
                $relays[$relay['id']] = $relay;
                if($this->relays_model->check_event($relay['id']))
                    $relays[$relay['id']]['event'] = true;
            }

            $data['boards'][$board['id']]['relays'] = $relays;
        }

        $data['current_page'] = 'boards';

        $this->load->template('boards_view', $data);
	}

    public function edit($board_id)
    {
        if($board_id == 'new') {
            $data['cols'] = 1;
            $data['rows'] = 4;
            $data['number'] = 1;
            $data['current_page'] = 'new_board';
            $data['submit_value'] = 'Add';
            $data['action'] = '/boards/insert';

            $this->load->template('boards_edit_view', $data);
        } else {
            $this->load->model(array('boards_model', 'relays_model'));
            $board = $this->boards_model->get_board($board_id);

            $relays = array();
            foreach($this->relays_model->index($board_id) as $relay){
                $relays[$relay['relay_id']] = $relay;
            }

            $data['board'] = $board;
            $data['relays'] = $relays;
            $data['relays_count'] = count($relays);
            $data['cols'] = $data['relays_count'] / 4;
            $data['rows'] = 4;
            $data['number'] = 1;

            if($data['cols'] == 8) {
                $data['cols'] = 4;
                $data['rows'] = 8;
            }

            $data['current_page'] = 'edit_board';
            $data['submit_value'] = 'Edit';
            $data['action'] = '/boards/update/' . $board_id;

            $this->load->template('boards_edit_view', $data);
        }
    }

    public function insert()
    {
        $this->load->helpers('url');
        $this->load->model(array('boards_model', 'relays_model'));

        $data = array(
            'ip' => $this->input->post('ip-address'),
            'location' =>  $this->input->post('board-location'),
            'name' => $this->input->post('board-name')
        );

        $board_id = $this->boards_model->insert($data);

        if($board_id){
            $relays = $this->input->post('relays');

            foreach($relays as $key => $value){
                $data = array(
                    'relay_id' => $key,
                    'name' => $value,
                    'board_id' => $board_id
                );

                $this->relays_model->insert($data);
            }
        }

        redirect('/');
    }

    public function update($board_id)
    {
        $this->load->helpers('url');
        $this->load->model(array('boards_model', 'relays_model'));

        $data = array(
            'ip' => $this->input->post('ip-address'),
            'location' =>  $this->input->post('board-location'),
            'name' => $this->input->post('board-name')
        );

        $this->boards_model->update($data, $board_id);

        $relays = $this->input->post('relays');

        foreach($relays as $key => $value){
            $data = array(
                'relay_id' => $key,
                'name' => $value,
                'board_id' => $board_id
            );

            $this->relays_model->update($data, $key);
        }

        redirect('/boards/edit/' . $board_id);
    }

    public function delete($board_id)
    {
        $this->load->helpers('url');
        $this->load->model('boards_model');

        $this->boards_model->delete($board_id);

        redirect('/');
    }

}