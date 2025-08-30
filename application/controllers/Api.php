 
<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {
	 public function __construct() {
        parent::__construct();
	    $this->load->library('form_validation');
	   $this->load->database();
    }
    
    
    public function propertyData()
    {
        $query = $this->db->order_by('id', 'DESC')
                          ->get('tbl_property');  // Fetch all records, ordered by `id` DESC
        $data = $query->result();  // Return the result as an array of objects
        
        // Set the content type to JSON and return the data in JSON format
        // $this->output
        //      ->set_content_type('application/json')
        //      ->set_output(json_encode($data));
        
        $response = [
            'success' => true,
            'data' => $data
        ];
    
        // Set the content type to JSON and return the response as JSON
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }
	}
?>