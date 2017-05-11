<?php

class Postcodelookup_model extends CI_Model{

var $check_this = '';
//Format postcode for lookup.  remove & trim any whitespaces

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


	function check_this_postcode()
	{
		//might be work inserting a check referrer or to limit referrer on the post
		$check_this = $this->input->post('postcode');

		if ($check_this!=''){
        	$rquery = "SELECT latitude, longitude FROM tpostcodes WHERE postcode='".$check_this."'";
			$query = $this->db->query($rquery);
			return $query;
            }else{ echo "I am sorry we cannot find this postcode.";}
		}
	}
}