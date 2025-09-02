<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {
    public function index() {
        echo "<pre>";
        echo "Base URL: " . base_url() . "\n";
        echo "Site URL: " . site_url() . "\n";

        $this->load->database();
        $query = $this->db->query("SELECT session_id, ip_address, last_activity, user_data FROM tbl_sessions ORDER BY last_activity DESC LIMIT 1");
        $row = $query->row();

        echo "Session ID: " . $row->session_id . "\n";
        echo "IP Address: " . $row->ip_address . "\n";
        echo "Last Activity: " . $row->last_activity . "\n";
        echo "User Data Length: " . strlen($row->user_data) . " bytes\n";
        echo "User Data Preview: " . substr($row->user_data, 0, 500) . "...\n";
        echo "</pre>";
    }
}
