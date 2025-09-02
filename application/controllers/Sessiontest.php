<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessiontest extends CI_Controller {
    public function index() {
        echo "<pre>";
        echo "Session ID: " . session_id() . "\n";

        if (isset($_COOKIE['sp_session'])) {
            echo "Cookie length: " . strlen($_COOKIE['sp_session']) . " bytes\n";
            echo "Cookie preview: " . substr($_COOKIE['sp_session'], 0, 200) . "...\n";
        } else {
            echo "No sp_session cookie found.\n";
        }

        $this->load->database();
        $query = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_sessions");
        echo "Rows in tbl_sessions: " . $query->row()->cnt . "\n";

        echo "</pre>";
    }
}
