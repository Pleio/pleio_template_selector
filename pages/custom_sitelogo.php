<?php 

	global $CONFIG;
	
	if($contents = file_get_contents($CONFIG->dataroot . "pleio_template_selector/site_logos/logo_" . $CONFIG->site_guid)){
		header("Content-type: image/jpeg");
		header('Expires: ' . date('r',time() + 864000));
		header("Pragma: public");
		header("Cache-Control: public");
		header("Content-Length: " . strlen($contents));
		
		$splitString = str_split($contents, 1024);
		foreach($splitString as $chunk) {
			echo $chunk;
		}
	}

?>