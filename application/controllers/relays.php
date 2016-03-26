<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relays extends CI_Controller {

    public function exec()
    {
        $ip = $this->input->post('ip');
        $relay_id = $this->input->post('relay_id');
        $state = $this->input->post('status');

        exec('/usr/bin/python ' . $_SERVER['DOCUMENT_ROOT'] . '/relay.py --ip ' . $ip . ' --relay ' . $relay_id . ' --state ' . $state);
    }

}