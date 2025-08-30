<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $user_data;

    public function __construct() {
        parent::__construct();
        $this->load->view('phpmailer/phpmailer');
        $this->load->library('encrypt');

        // --- HTTPS redirect: only in production, never on localhost/127.0.0.1 ---
        $host    = $_SERVER['HTTP_HOST'] ?? '';
        $isLocal = ($host === 'localhost' 
            || strpos($host, 'localhost:') === 0 
            || $host === '127.0.0.1' 
            || strpos($host, '127.0.0.1:') === 0);

        $isHttps = (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
            || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
        );

        if (ENVIRONMENT === 'production' && !$isLocal && !$isHttps) {
            $redirect = 'https://' . $host . $_SERVER['REQUEST_URI'];
            header('Location: ' . $redirect, true, 301);
            exit();
        }
        // --- end HTTPS redirect guard ---

        if (isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            // $this->output->enable_profiler(TRUE);
        }

        // your custom logic
        $config   = new SqlModel();
        $currency = $config->defaultCurrency();
        define("BTC","8");
        define("CURRENCY",$currency);
    }
	
	
	
    protected function isAdminLoggedIn() {
        return $this->session->userdata('oprt_id');
    }

    protected function checkAdminLogin() {
        if ($this->isAdminLoggedIn() === false) {
            redirect(ADMIN_PATH);
        }
    }
	
	protected function isMemberLoggedIn() {
        return $this->session->userdata('mem_id');
    }
	
	protected function checkMemberLogin() {
        if ($this->isMemberLoggedIn() === false) {
            redirect(BASE_PATH);
        }
    }

    protected function isAdmin() {
        return isset($this->user_data['admin']) && $this->user_data['admin'] === true;
    }

    protected function jhead() {
        header('Content-type: application/json');
    }

    protected function json($msg = '', $status = true) {
        $data = array();
        $data['status'] = ($status === true) ? 'true' : 'false';
        $message_key = ($status) ? 'data' : 'message';
        if ($msg != '')
            $data[$message_key] = $msg;
        echo json_encode($data);
        return;
    }

}
