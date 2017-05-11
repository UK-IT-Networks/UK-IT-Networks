<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results extends CI_Controller {

	public function index()
	{
			$this->load->model('Numbercheck_model','',TRUE);
			$data['query'] = $this->Numbercheck_model->check_this_number();
			$this->load->view('results',$data);
	}

}

/* End of file check.php */
/* Location: ./application/controllers/results.php */