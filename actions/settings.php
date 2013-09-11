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
					$custom_colors = get_input("custom_color");
						
					if(!empty($custom_colors) && is_array($custom_colors)){
						$pattern = "/^[a-f0-9]{6}$/i";
						
						foreach($custom_colors as $index => $color){
							if(preg_match($pattern, $color)){
								elgg_set_plugin_setting("custom_color_" . $index, $color, "pleio_template_selector");
							} elseif (empty($color)) {
								// reset to default
								elgg_unset_plugin_setting("custom_color_" . $index, "pleio_template_selector");
							}
						}
					}
					elgg_set_plugin_setting($setting, $value, "pleio_template_selector");
					break;
				default:
					if($setting == "custom_css"){
						$value = $_REQUEST["params"]["custom_css"];
					}
					elgg_set_plugin_setting($setting, $value, "pleio_template_selector");
					break;
			}
		}
		
		if ($background_image = get_uploaded_file("background_image")) {
			if (!pleio_template_selector_save_background_image($background_image)) {
				$error_count++;
				register_error(elgg_echo("pleio_template_selector:actions:settings:error:background_image:save"));
			}
		}
		
		// reset cache
		elgg_invalidate_simplecache();
		
		if(empty($error_count)){
			system_message(elgg_echo("pleio_template_selector:actions:settings:success"));
		} else {
			register_error(elgg_echo("pleio_template_selector:actions:settings:error:save"));
		}
	} else {
		register_error(elgg_echo("pleio_template_selector:actions:settings:error:input"));
	}

	forward(REFERER);
	