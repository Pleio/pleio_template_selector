<?php

	$file_location = elgg_get_config("dataroot") . "pleio_template_selector/favicon/favicon_" . elgg_get_site_entity()->getGUID();
	
	if (!file_exists($file_location)) {
		$file_location = elgg_get_root_path() . "_graphics/favicon.ico";
	}
	
	if(file_exists($file_location)){
		if($contents = file_get_contents($file_location)){
			header("Content-type: image/x-icon");
			header('Expires: ' . date('r',time() + 864000));
			header("Pragma: public");
			header("Cache-Control: public");
			header("Content-Length: " . strlen($contents));
				
			$splitString = str_split($contents, 1024);
			foreach($splitString as $chunk) {
				echo $chunk;
			}
		}
	}