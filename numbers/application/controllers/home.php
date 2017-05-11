<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	 			 $mobile =  $this->input->post('mobile');
				 $postcode = $this->input->post('postcode');				 
	 			 if ($postcode)
				 {
				 			 // if postcode field has been POSTed to the controller then perform database lookup to get postcode longitude and latitude
							 $this->load->model('Getcoordinates','',TRUE);
							 $data['query'] = $this->Getcoordinates->check_this_postcode();
							 $this->load->library('curl');
							 $url = "http://http1.uk.oxygen8.com:8080/UK_IT_Networks_Relay"; 
							 // MSISDN phone number with 44 format, Mask is the keyword 
							 $post_data = array ( 
							 						"MSISDN" => "447779303999", 
													"Mask" => "UKIT", 
													"Content" => "MEssage body",
							 						"Channel" => "UK.BULK", 
													"Username" => "jdr509vji43", 
													"Password" => "jic943niuf2f",
													"Premium" => "0"													
								);
								$output = $this->curl->simple_post($url, $post_data);
				 
							 
         }else{
				 			 // testing form loaded if no information is posted to controller
							 // could add security here and limit access to this form for specific IP addresses after testing
							 $this->load->view('testform'); //load form for testing.  disable once store finder complete				 
				 }      
                
	}
	
	public function testform()
	{
	 			 $postode = $this->input->post('postcode');
				 $mobile =  $this->input->post('mobile');
				 $this->load->view('testform');
	}
        
        public function validatepost()
        {
            
                $this->load->helper('form');
                $this->load->library('form_validation');
                $data['postcode'] = 'seach this postcode';

                $this->form_validation->set_rules('keyword', 'keyword', 'required');
                $this->form_validation->set_rules('poscode', 'postcode', 'required');
                $this->form_validation->set_rules('mobile', 'mobile', 'required');
                
                if ($this->form_validation->run() === FALSE)
                {
                    $this->load->view('testform');

                }
                else
                {
                    $this->general_model->lookup();
                    $this->load->view('results');
                }               
            
        }
}
