<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

	public function index()
	{
//		$this->load->view('check');
			$this->load->model('Numbercheck_model','',TRUE);
			$data['query'] = $this->Numbercheck_model->check_this_number();
			$this->load->view('check',$data);		

    		if ($this->form_validation->run() == FALSE)
    		{
    			//set validation criteria
    						//validation successful
    			//show results
    
    		}
    		else
    		{
    			//validation successful
    			//show results
    		}
			



	}

	function form(){
	
	}


}

/* End of file check.php */
/* Location: ./application/controllers/check.php */