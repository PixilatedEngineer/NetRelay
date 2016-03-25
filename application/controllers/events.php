<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

    public function index($board_id)
    {
        $this->load->model(array('events_model', 'relays_model'));

        $events = $this->events_model->index($board_id);
        if($events) $data['events'] = $events;

        $relays = $this->relays_model->index($board_id);
        $data['relays'] = $relays;

        $data['board_id'] = $board_id;
        $data['current_page'] = 'edit_events';
        $this->load->template('events_edit_view', $data);
    }

    public function insert($board_id)
    {
        $this->load->helpers('url');
        $this->load->model('events_model');

        $days = $this->input->post('days');
        $days_arr = array();
        if($days)
            foreach($days as $key => $value)
                $days_arr[] = $key;


        $data = array(
            'time' => $this->input->post('time'),
            'days' => json_encode($days_arr),
            'state' =>  $this->input->post('state'),
            'relay_id' => $this->input->post('relay-id'),
            'board_id' => $board_id
        );

        $this->events_model->insert($data);

        redirect('/events/' . $board_id);
    }

    public function update($event_id)
    {
        $this->load->helpers('url');
        $this->load->model('events_model');

        $board_id = $this->input->post('board-id');
        $days = $this->input->post('days');
        $days_arr = array();
        if($days)
            foreach($days as $key => $value)
                $days_arr[] = $key;


        $data = array(
            'time' => $this->input->post('time'),
            'days' => json_encode($days_arr),
            'state' =>  $this->input->post('state'),
            'relay_id' => $this->input->post('relay-id')
        );

        $this->events_model->update($data, $event_id);

        redirect('/events/' . $board_id);
    }

    public function delete($event_id)
    {
        $this->load->library('user_agent');
        $this->load->helpers('url');
        $this->load->model('events_model');

        $this->events_model->delete($event_id);

        redirect($this->agent->referrer());
    }
}