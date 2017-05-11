<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/quote
	 *	- or -
	 * 		http://example.com/index.php/quote/index
	 */
	public function index()
	{
		$this->load->helper('form');
		$this->load->view('quote_form');
	}
	
	public function send()
	{
		$this->load->library('xmlrpc'); //load XML RPC library
		$this->xmlrpc->set_debug(TRUE);
		//$this->output->enable_profiler(TRUE);

		//grab form results
		$type =  $this->input->post('type');
		$postcode = $this->input->post('postcode');
		
		//build xml string
		$my_request = '<?xml version="1.0"?>
		<Request module="dwapi" call="quote_request" id="9bd573349c64355a28487378b6dcd47f" version="2.0.1">
		<a name="postcode" format="postcode">CW10 9BG</a>
		<a name="type" format="text">ethernet</a>
		<a name="line-cdr" format="text">100</a>
		<a name="bearer" format="text">100</a>
		<a name="technology-type" format="text">leasedlines</a>
		<block name="auth">
			<a name="username" format="text">testtest</a>
			<a name="password" format="password">passwd</a>
			<a name="client-id" format="text">1</a>
		</block>
		</Request>';
		
		
		$phone_test = '<?xml version="1.0"?>
		<Request module="dwapi" call="mpf_line_status" id="5eca4ea7f49827a5d893d7de29a781c8" version="1.0">
		<block name="auth">
		<a name="username" format="text">testtest</a>
		<a name="password" format="password">passwrd</a>
		<a name="client-id" format="text">1</a>
		</block>
		<a name="cli" format="phone">01565733300</a>
		</Request>';


		//send xml string
		//$this->xmlrpc->server('http://api.daisywholesale.com',80);
		$this->xmlrpc->server('https://xml.DWAPI.daisywholesale.com',80);
		//$this->xmlrpc->method('quote_request');
		$this->xmlrpc->method('mpf_line_status');
		//$this->xmlrpc->request($my_request);
		$this->xmlrpc->request($phone_test);
		if (!$this->xmlrpc->send_request())
			{
					echo $this->xmlrpc->display_error();
			}
		
		//display xml result in results
		echo '<pre>';
			print_r($this->xmlrpc->display_response());
		echo '</pre>';
		
		
		$this->load->helper('form');
		$this->load->view('results');

	}
}
