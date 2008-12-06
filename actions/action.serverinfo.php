<?php
	
	$requests = $xml->createElement('requests');
	
	XMLDocument::setAttributeArray($requests, array(
		'total-requests' => $total_requests_made,
		'maximum-simultaneous-requests' => $max_simultaneous_requests,
		'currently-active' => $max_simultaneous_requests,
	));
	
	$response->appendChild($requests);
	
	$response->appendChild($xml->createElement('server-start-date', date("D, d M Y H:i:s T", $start)));
	$response->appendChild($xml->createElement('current-server-time', date("D, d M Y H:i:s T")));
	$response->appendChild($xml->createElement('request-string', htmlspecialchars($buffer)));
	


