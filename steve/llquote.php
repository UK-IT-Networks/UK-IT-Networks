<html>
<head><title>xmlrpc</title></head>
<body>
<h1>Daisy test</h1>

<?php
	include("xmlrpc.inc");
	
	// Play nice to PHP 5 installations with REGISTER_LONG_ARRAYS off
	if(!isset($HTTP_POST_VARS) && isset($_POST))
	{
		$HTTP_POST_VARS = $_POST;
	}

	if(isset($HTTP_POST_VARS["password"]) && $HTTP_POST_VARS["password"]!="")
	{
		$password=(string)$HTTP_POST_VARS["password"];
		$username="ukit.api";
		//$username="username";
/*		$f=new xmlrpcmsg('examples.getStateName',
			array(php_xmlrpc_encode($username,$password))
		);
		print "<pre>Sending the following request:\n\n" . htmlentities($f->serialize()) . "\n\nDebug info of server data follows...\n\n";
*/
		$ukitkey = uniqid("ukit");
		/*
		$xmlData = '<?xml version="1.0"?>
<Request module="dwapi" call="self_test" id="'.$ukitkey.'" version="2.0.1">
  <block name="auth">
     <a name="username" format="text">'.$username.'</a>
     <a name="password" format="password">'.$password.'</a>
  </block>
</Request>';
*/

		$xmlData = '<?xml version="1.0"?>
		<Request module="dwapi" call="quote_request" id="'.$ukitkey.'" version="2.0.1">
  <block name="auth">
     <a name="username" format="text">'.$username.'</a>
     <a name="password" format="password">'.$password.'</a>
  </block>
  <a name="postcode" format="postcode">CW9 6PH</a>
  <a name="type" format="text">ethernet</a>
  <a name="line-cdr" format="text">20</a>
  <a name="bearer" format="text">100</a>
  <a name="technology-type" format="text">leasedlines</a>
</Request>';

		//print htmlentities($xmlData);

		
		$client=new xmlrpc_client("", "api.daisywholesale.com", 443);
		$client->setDebug(0);
		//$r=&$c->send($xmlData,0,'https');
		$response = $client->send($xmlData,0,'https');
		
		echo "This is a response from the server<br>";
		print_r ($response);
		echo "<p><br></p>";
		echo "This is XML data<br>";
//		var_dump($response);
		$something = $response->raw_data;
		$something= preg_replace('/HTTP(.*)gzip/s',"",$something);
		$something= substr( $text, strpos($something, "\n")+1 ); //strip out blank first line
		//$val = php_xmlrpc_decode_xml($response);
		echo "<p><br></p>";
		echo "<pre>";
		echo ($something);
		echo "</pre>";
		
		//$xml = new SimpleXMLElement($something) or die("Error: Cannot create object");

		//print_r($xml);

		//var_dump (xmlrpc_decode($response));
		//echo $something_else;

	/*	
		$xmlDoc = new DOMDocument();
		$xmlDoc->load("note.xml");

$x = $xmlDoc->documentElement;
foreach ($x->childNodes AS $item) {
  print $item->nodeName . " = " . $item->nodeValue . "<br>";

*/

					 
		
		/*$dom=new domDocument;
		$dom->loadXML($response);
		$x=simplexml_import_dom($dom);
		echo $x->module;*/
		echo "try again";

		/*
			$v=$r->value();
			print htmlspecialchars($v->scalarval());
			print htmlentities($r->serialize());
		
		if(!$r->faultCode())
		{
			$v=$r->value();
			//print htmlspecialchars($v->scalarval());
			//print htmlspecialchars($v->serialize());

		}
		else //error
		{
			/*
			print "An error occurred: ";
			print "Code: " . htmlspecialchars($r->faultCode())
				. " Reason: '" . htmlspecialchars($r->faultString());
			
		}
*/
	}



	
?>
<form action="llquote.php" method="POST">
<input type="hidden" name="password" value="password">
<input type="submit" value="go" name="submit">
</form>
<p>Press Go to test</p>
</body>
</html>	