<?php 

// this is the file for all the helper functions in the contact us page.

//these are for the PHP Helper files
// include 'headers/databaseConn.php';

// for mandrill mail sending API.
require_once '../mandrill/Mandrill.php'; 

// for sending the message through mandrill API.
function SendMessage($to, $toName, $from, $fromName, $subject, $message) {
	try {
		$mandrill = new Mandrill('41ePKTnx5DEoaYJmC3EEjw');
		$message = array(
	        'html' => $message,
	        'subject' => $subject,
	        'from_email' => $from,
	        'from_name' => $fromName,
	        'to' => array(
	            array(
	                'email' => $to,
	                'name' => $toName,
	                'type' => 'to'
	            )
	        )
	    );
	    $async = false;
	    $ip_pool = 'Main Pool';
	    $send_at = null;
	    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
		return $result;
	} 
	catch(Mandrill_Error $e) {
		$res = $e . " --> " . $e->getMessage();
		return $res;
	}
}


?>