<?php

class Numbercheck_model extends CI_Model{

var $check_this = '';
//Format number for query
//Drop leading zero
//truncate number to

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


	function check_this_number()
	{
		$check_this = $this->input->post('number');

		if ($check_this!=''){
        if (strlen($check_this)>=6){
			$rquery = "SELECT cp, number_range, tariff, ppm, ppmppc_start, ppmppc_60, ppc FROM service_charges2 WHERE number_range LIKE '".$check_this."%'";
			$query = $this->db->query($rquery);
			$i=0;
			while ($query->num_rows()!=1){
				$check_this = substr($check_this,0,-1);
				$rquery = "SELECT cp, number_range, tariff, ppm, ppmppc_start, ppmppc_60, ppc FROM service_charges2 WHERE number_range LIKE '".$check_this."%'";
				$query = $this->db->query($rquery);
				$i++;
				if ($i>=7){
					echo "error: invalid number";
					break;
				}

			}

			return $query;
            }else{ echo "Number too small";}
		}
	}
}