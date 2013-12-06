<?php

	function pleio_template_selector_get_site_logo(){
		$result = false;
		
		if($sitelogo = elgg_get_plugin_setting("sitelogo", "pleio_template_selector")){
			switch($sitelogo){
				case "custom":
					if(file_get_contents(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/logo_" . elgg_get_site_entity()->getGUID())){
						$result = elgg_get_site_url() . "template_selector/custom_sitelogo/logo.jpg";
					}
					
					break;
				case "none":
					// nothing
					break;
				default:
					$result = elgg_get_site_url() . "mod/pleio_template_selector/_graphics/sitelogos/" . $sitelogo . ".png";
					break;
			}
		}
		
		return $result;
	}

	function pleio_template_selector_get_site_background(){
		$result = false;
		
		if(file_get_contents(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/background_" . elgg_get_site_entity()->getGUID())){
			$result = elgg_get_site_url() . "template_selector/custom_background/logo.jpg";
		}
				
		return $result;
	}

	function pleio_template_selector_save_custom_logo($logo_contents){
		$result = false;
		
		if(!empty($logo_contents)){
			if(!is_dir(elgg_get_config("dataroot") . "pleio_template_selector/")){
				mkdir(elgg_get_config("dataroot") . "pleio_template_selector/");
			}
			
			if(!is_dir(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/")){
				mkdir(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/");
			}
			
			if(file_put_contents(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/logo_" . elgg_get_site_entity()->getGUID(), $logo_contents)){
				$result = true;
			}
		}
		
		return $result;
	}
	
	function pleio_template_selector_save_background_image($contents){
		$result = false;
		
		if(!empty($contents)){
			if(!is_dir(elgg_get_config("dataroot") . "pleio_template_selector/")){
				mkdir(elgg_get_config("dataroot") . "pleio_template_selector/");
			}
			
			if(!is_dir(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/")){
				mkdir(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/");
			}
			
			if(file_put_contents(elgg_get_config("dataroot") . "pleio_template_selector/site_logos/background_" . elgg_get_site_entity()->getGUID(), $contents)){
				$result = true;
			}
		}
		
		return $result;
	}

	function pleio_template_selector_save_favicon($contents){
		$result = false;
		
		if(!empty($contents)){
			if(!is_dir(elgg_get_config("dataroot") . "pleio_template_selector/")){
				mkdir(elgg_get_config("dataroot") . "pleio_template_selector/");
			}
			
			if(!is_dir(elgg_get_config("dataroot") . "pleio_template_selector/favicon/")){
				mkdir(elgg_get_config("dataroot") . "pleio_template_selector/favicon/");
			}
			
			if(file_put_contents(elgg_get_config("dataroot") . "pleio_template_selector/favicon/favicon_" . elgg_get_site_entity()->getGUID(), $contents)){
				$result = true;
			}
		}
		
		return $result;
	}
	
	function pleio_template_selector_set_colors(){
		
		$colorset = elgg_get_plugin_setting("colorset", "pleio_template_selector");
				
		$colors = pleio_template_selector_get_colors("navy"); //default color set
		
		switch($colorset){
			case "custom":
				for($i=0; $i < count($colors); $i++){
					if($custom_color = elgg_get_plugin_setting("custom_color_" . ($i + 1), "pleio_template_selector")){
						$colors[$i] = $custom_color;
					}
				}
				break;
			default:
				if ($colorset) {
					if ($preset_colors = pleio_template_selector_get_colors($colorset)) {
						$colors = $preset_colors + $colors;
					}
				}
				break;
		}
		
		define("THEME_COLOR_1", strtoupper($colors[0]));
		define("THEME_COLOR_2", strtoupper($colors[1]));
		define("THEME_COLOR_3", strtoupper($colors[2]));
		define("THEME_COLOR_4", strtoupper($colors[3]));
		define("THEME_COLOR_5", strtoupper($colors[4]));
	}
	
	function pleio_template_selector_get_colors($color = ""){
		$result = array();
		
		$colors = array (
			"mint" => array ("6ED9AD", "CBE6DB", "E5F2ED"),
			"magenta" => array ("900079", "E3B2DA", "F1D9ED"),
			"yellow" => array ("F9E11E", "FDF6BB", "FEFBDD"),
			"purple" => array ("42145F", "C6B8CF", "E3DCE7"),
			"violet" => array ("A90061", "E5B2CF", "F2D9E7"),
			"pink" => array ("F092CD", "FADEF0", "FDEFF8"),
			"navy" => array ("01689B", "CCE0F1", "E5F0F9", "154273", "0162CD"),
			"orange" => array ("E17000", "F6D4B2", "FBEAD9"),
			"blue" => array ("007BC7", "B2D7EE", "D9EBF7"),
			"sand" => array ("F9B249", "FDE4BE", "FEF2DF"),
			"green" => array ("4E9625", "CBE1BD", "E1FECF"),
		);
		
		if (empty($color)) {
			$result = $colors;
		} elseif (array_key_exists($color, $colors)) {
			$result = $colors[$color];
		}
		
		return $result;
	}
