<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function sign()
    {
        $this->load->view('sign');
    }
}
