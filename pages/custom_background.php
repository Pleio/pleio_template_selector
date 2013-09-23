<?php

	global $CONFIG;
	
	$etag = (int) $CONFIG->lastcache;
	
	if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
		header("HTTP/1.1 304 Not Modified");
		exit;
	}

	$file_location = elgg_get_config("dataroot") . "pleio_template_selector/site_logos/background_" . elgg_get_site_entity()->getGUID();
	
	if(file_exists($file_location)){
		if($contents = file_get_contents($file_location)){
			header("Content-type: image/jpeg");
			header('Expires: ' . date('r',time() + 864000));
			header("Pragma: public");
			header("Cache-Control: public");
			header("ETag: \"$etag\"");
			header("Content-Length: " . strlen($contents));
			
			$splitString = str_split($contents, 1024);
			foreach($splitString as $chunk) {
				echo $chunk;
			}
		}
	}