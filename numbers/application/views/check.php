<!DOCTYPE html>
<html lang="en" style="overflow:hidden;">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>check</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://www.ukitnetworks.com/sites/all/themes/businessclass/css/custom-theme/jquery-ui-1.10.0.custom.min.css" />
    <link rel="stylesheet" href="http://www.ukitnetworks.com/sites/all/themes/businessclass/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="colorbox.css" />
	<script src="js/jquery.colorbox.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#check_button').click(function(){
			var numberLength = $("#number").val().length;
			var numberContent = $("#number").val();
			if (numberLength>11 || numberLength<6){
				alert('not a valid number');
				return false;
			}

			//drop leading zero if there is one
			if (numberContent.indexOf('0')==0) {
				numberContent = numberContent.substring(1);
				/*if (numberContent.indexOf('0')<>8) {
					alert ('not a valid number');
					return false;
				}*/
				$("#number").val(numberContent);
				return true;
			}
		});

	});

	</script>
<script>
$(document).ready(function(){
$(".iframe").colorbox({iframe:true, width:"525", height:"300"});
$(".inline").colorbox({inline:true, width:"50%"});
          if ($('#tab3accordion').length){
            $.colorbox({href:"#tab3accordion",inline:true, width:"555", height:"620",onCleanup:function(){ window.close(); },});

          }
});
</script>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function($) {
    $( "#tab3accordion" ).accordion({
		icons: null,
	  	header: "h5", active: false, heightStyle: "content"
    });
});
//--><!]]>
</script>

	<style>
	body{13px 'Open Sans',Helvetica Neue,Helvetica,Arial,Sans-serif;color:#5a5a5a;background-color:white;}
    .content{font-size:14px; 'Open Sans',Helvetica Neue,Helvetica,Arial,Sans-serif;color:#5a5a5a;background-color:white;}
    #number{
      width: 160px;
      font-size:14px;
    }

	#portingnumber{background-color:#06aae8;color:#ffffff;font-weight:bold;}
    p{
      line-height:110%;
      color:#617078;
      font-family: 'Open Sans', Helvetica Neue, Helvetica, Arial, Free Sans, Sans-serif;
    }
    p.#tab3accordion{
      font-size: x-small;
    }
    span.tabnav2{
      font-size:14px;
      width: 130px;
      color:#01a5e6;
      display: inline-block;
    }
    input.form-text{
      width:200px;
      font-size: 18px;
    }
    div.portcontent{
      width:500px;
      padding:1em 2em;
      line-height:110%;
    }
    .form-textarea, .contact-form textarea, .comment-form textarea{

    width: 490px;
    height: 100px;
    margin:0px;
    padding:0px;
    }

	</style>
	</head>
<body class="ui-widget" style="overflow: hidden">

<?if ($this->input->post('thenumber')){?>
    <script type="text/javascript">
    alert('Thank you for contacting us, a member of our team shall be in touch soon');
    window.close();
    </script>
    <p>Thank you for contacting Sales, a member of our team shall be in touch soon.</p>
    <p>You may now close this window.</p>
    <p><input type='button' value='close' onclick='window.close()' /></p>

<?}else{?>
<? // exceptions list // ?>
<?
//$blocked_ip = array("93.97.180.229");
$blocked_ip = "93.97.180.229";
$ip_addr = $this->input->ip_address();

//if (in_array($ip_addr,$blocked_ip)){
if ($blocked_ip == $ip_addr){
  echo "We have noticed you have been using our number search facility a lot recently, please call 0844 324 8585 to speak to our sales team.";
}else{?>

<form action="http://www.ukitnetworks.com/numbers/index.php?check" method="post" accept-charset="utf-8" class="contact-form" style="padding:1em 2em;" target="_blank">
	<input type="text" name="number"  id="number" class="form-text" size="12" value="Enter your number" onclick="this.value='';" />
    <input type="submit" value="Check number" class="form-submit" id="check_button" />
</form>
<?
}// end block IPs
}
?>
<div style='display:none'>
<?php
if (isset($query)){?>

<div id="tab3accordion">



<h5>Details</h5>
<div class="portcontents">

<?            foreach ($query->result() as $row){
            	echo "<p><b>Number searched:</b> 0".$this->input->post('number');
            	echo "<br />";
                echo "<b>Ofcom registered range:</b> ".$row->number_range;
                //echo "<br /><b>Range holder:</b> ".$row->cp;
            	$message = "The following number was checked: 0".$this->input->post('number')."\n";
            	$message .= "\nNumber range: ".$row->number_range."\n";
                $message .= "\nCommunications provider: ".$row->cp."\n";
            	if ($row->tariff!=""){
	                $message .= "\nTariff: ".$row->tariff;
					echo "<br />";
                	echo " <b>Tariff:</b> ".$row->tariff;
                	echo " <font size='1'>(ex VAT)</font>";
            	}
                echo "</p>";
                echo "<p>";
            	$message .= "\n\nMessage to display\n";
                if ($row->ppm !=0){
               		echo "The message you need to advertise would be as follows:<br />";
                    echo "<br><i>&quot;Calls will cost ".$row->ppm."p per minute plus your telephone company's access charge.&quot;</i>";
            		$message .= "Calls will cost ".$row->ppm."p per minute plus your telephone company's access charge.";
            	}elseif ($row->ppmppc_start != " "){
               		echo "The message you need to advertise would be as follows:<br />";
                    echo "<br><i>&quot;Calls will cost ".$row->ppmppc_start." plus your telephone company's access charge.&quot;</i>";
            		$message .= "Calls will cost ".$row->ppmppc_start." plus your telephone company's access charge.";
            	}elseif ($row->ppc != " "){
               		echo "The message you need to advertise would be as follows:<br />";
                    echo "<br><i>&quot;Calls will cost ".$row->ppc." plus your telephone company's access charge.&quot;</i>";
            		$message .= "Calls will cost ".$row->ppc." plus your telephone company's access charge.";
            	}else{
            		echo "Sorry your number was not recognised.<br>";
            		echo "Please try again, try typing in your full 11 digit number. eg 08443248585";
            		$message .= "WTF!?";
            	}
                echo "</p>";
								echo "<p><font size='1'>Information sourced from Ofcom and last updated January 2015.</font></p>"; 
                $ip_addr = $this->input->ip_address();
                $message .= "\nIP Address: ". $ip_addr;


            }
?>

</div>
<h5 id="moredetails">Need more information?</h5>
<div class="portcontents" style="padding-left: 5px;">
<form action="http://www.ukitnetworks.com/numbers/index.php?check" method="post" class="contact-form">
    <div class="tabnav"><span class="tabnav2">Company name: </span><input type="text" class="form-text" name="company" /></div>
    <div class="tabnav"><span class="tabnav2">Number: </span><input type="text" class="form-text" name="thenumber" value="<?php echo '0'.$this->input->post('number');?>" /></div>
    <div class="tabnav"><span class="tabnav2">Your name: </span><input type="text" class="form-text" name="name" /></div>
    <div class="tabnav"><span class="tabnav2">E-mail: </span><input type="text" class="form-text" name="email" /></div>
    <div class="tabnav"><span class="tabnav2">Comments: </span></div>
    <div><textarea class="form-textarea" name="description" rows="3"></textarea></div>
    <div style="padding-left:130px"><input type="submit" value="Contact us" class="form-submit" id="check_button2" /></div>
<input type="hidden" class="form-text" name="rangeholder" value="<?php echo $row->cp;?>" />
</form>
<?

			$email_message = "A number was checked on our website \n";
			$email_message .= $message;
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$this->email->from('number_check@ukitnetworks.com', 'Number check');
            $this->email->to('steve@ukitnetworks.com');
//            $this->email->to('sales@ukitnetworks.com,dave@ukitnetworks.com');
//            $this->email->cc('steve@ukitnetworks.com');
            $this->email->subject('Number check');
            $this->email->message($email_message);
			$this->email->send();

			//echo $this->email->print_debugger();

?></div></div><?
}

            if ($this->input->post('thenumber')!=''){
    			$emessage = "A number port enquiry has been made from our website \n";
    			$emessage .= "\n Company name: ".$this->input->post('company');
                $emessage .= "\n Number searched: ".$this->input->post('thenumber');
    			$emessage .= "\n Company name: ".$this->input->post('name');
                $emessage .= "\n Email: ".$this->input->post('email');
    			$emessage .= "\n Range Holder: ".$this->input->post('rangeholder');
                $emessage .= "\n". " Service provider: ".$this->input->post('serviceprovider');
                $emessage .= "\n Comments: ".$this->input->post('description');


    			$config['protocol'] = 'sendmail';
    			$config['mailpath'] = '/usr/sbin/sendmail';
    			$config['charset'] = 'iso-8859-1';
    			$config['wordwrap'] = TRUE;

    			$this->email->initialize($config);

    			$this->email->from('number_check@ukitnetworks.com', 'Number check');
                $this->email->to('sales@ukitnetworks.com');
//                $this->email->cc('steve@ukitnetworks.com');
                $this->email->subject('Number range question');
                $this->email->message($emessage);
    			$this->email->send();
                echo "Thank you for contacting us, a member of our team shall be in touch soon.";
            }


?>
   </div>
</body>
</html>