<?php

class Calculatedistance_model extends CI_Model{

var $lookup_longitude = '';
var $lookup_latitude = '';
//Use longitude and latitude obtained from Getcoordinates 


	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


	function getdistance()
	{
		$lookup_latitude = ;
		$lookup_longitude = ;
		$rquery = "SELECT storename, address, city, postcode ( 3959 * acos( cos( radians(".$lookup_latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$lookup_longitude.") ) + sin( radians(".$lookup_latitude.") ) * sin( radians( latitude) ) ) ) AS distance FROM tstores HAVING distance < 100 ORDER BY distance LIMIT 0 , 5";
		$query = $this->db->query($rquery);
		return $query;
        }else{ echo "Cannot find any stores within 100 miles from your postcode location";}
	}
}