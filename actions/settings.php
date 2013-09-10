<?php

	$params = get_input("params");
	
	if(!empty($params) && is_array($params)){
		$error_count = 0;
		
		foreach($params as $setting => $value){
			switch($setting){
				case "sitelogo":
					if($value == "custom"){
						if($logo_contents = get_uploaded_file("custom_sitelogo")){
							if(pleio_template_selector_save_custom_logo($logo_contents)){
								elgg_set_plugin_setting($setting, $value, "pleio_template_selector");
							} else {
								$error_count++;
								register_error(elgg_echo("pleio_template_selector:actions:settings:error:custom_logo:save"));
							}
						} elseif(file_exists(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/logo_" . elgg_get_site_entity()->getGUID())){
							elgg_set_plugin_setting($setting, $value, "pleio_template_selector");
						} else {
							$error_count++;
							register_error(elgg_echo("pleio_template_selector:actions:settings:error:custom_logo"));
						}
						break;
					}
				case "colorset":
					if($value == "custom"){
						$custom_colors = get_input("custom_color");
						
						if(!empty($custom_colors) && is_array($custom_colors)){
							$pattern = "[a-fA-F0-9]{6}";
							
							foreach($custom_colors as $index => $color){
								if(ereg($pattern, $color)){
									elgg_set_plugin_setting("custom_color_" . $index, $color, "pleio_template_selector");
								}
							}
							
							elgg_set_plugin_setting($setting, $value, "pleio_template_selector");
							break;
						}
					}
				default:
					if($setting == "custom_css"){
						$value = $_REQUEST["params"]["custom_css"];
					}
					elgg_set_plugin_setting($setting, $value, "pleio_template_selector");
					break;
			}
		}
		
		// reset cache
		elgg_regenerate_simplecache(); // update sc timestamps
		elgg_invalidate_simplecache(); // remove files
		elgg_filepath_cache_reset();
		
		if(empty($error_count)){
			system_message(elgg_echo("pleio_template_selector:actions:settings:success"));
		} else {
			register_error(elgg_echo("pleio_template_selector:actions:settings:error:save"));
		}
	} else {
		register_error(elgg_echo("pleio_template_selector:actions:settings:error:input"));
	}

	forward(REFERER);
	