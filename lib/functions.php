<?php 

	function pleio_template_selector_get_site_logo(){
		global $CONFIG;
		
		$result = false;
		
		if($sitelogo = elgg_get_plugin_setting("sitelogo", "pleio_template_selector")){
			switch($sitelogo){
				case "custom":
					if(file_get_contents($CONFIG->dataroot . "pleio_template_selector/site_logos/logo_" . $CONFIG->site_guid)){
						$result = $CONFIG->wwwroot . "pg/template_selector/custom_sitelogo/logo.jpg";
					}
					
					break;
				case "none":
					// nothing
					break;
				default:
					$result = $CONFIG->wwwroot . "mod/pleio_template_selector/_graphics/sitelogos/" . $sitelogo . ".png";
					break;
			}
		}
		
		return $result;
	}

	function pleio_template_selector_save_custom_logo($logo_contents){
		global $CONFIG;
		
		$result = false;
		
		if(!empty($logo_contents)){
			if(!is_dir($CONFIG->dataroot . "pleio_template_selector/")){
				mkdir($CONFIG->dataroot . "pleio_template_selector/");
			}
			
			if(!is_dir($CONFIG->dataroot . "pleio_template_selector/site_logos/")){
				mkdir($CONFIG->dataroot . "pleio_template_selector/site_logos/");
			}
			
			if(file_put_contents($CONFIG->dataroot . "pleio_template_selector/site_logos/logo_" . $CONFIG->site_guid, $logo_contents)){
				$result = true;
			}
		}
		
		return $result;
	}
	
	function pleio_template_selector_set_colors(){
		
		$colorset = elgg_get_plugin_setting("colorset", "pleio_template_selector");
				
		$colors = array("01689B", "CCE0F1", "E5F0F9", "154273", "0162CD"); //default color set
		
		switch($colorset){
			case "custom":
				
				for($i=0; $i < count($colors); $i++){
					if($custom_color = elgg_get_plugin_setting("custom_color_" . ($i + 1), "pleio_template_selector")){
						$colors[$i] = $custom_color;
					}
				}
				break;
			case "mint":
				$colors[0] = "6ED9AD";
				$colors[1] = "CBE6DB";
				$colors[2] = "E5F2ED"; 
				break;
			case "magenta":
				$colors[0] = "900079";
				$colors[1] = "E3B2DA";
				$colors[2] = "F1D9ED";
				break;
			case "yellow":
				$colors[0] = "F9E11E";
				$colors[1] = "FDF6BB";
				$colors[2] = "FEFBDD";
				break;
			case "purple":
				$colors[0] = "42145F";
				$colors[1] = "C6B8CF";
				$colors[2] = "E3DCE7";
				break;
			case "violet":
				$colors[0] = "A90061";
				$colors[1] = "E5B2CF";
				$colors[2] = "F2D9E7";
				break;
			case "pink":
				$colors[0] = "F092CD";
				$colors[1] = "FADEF0";
				$colors[2] = "FDEFF8";
				break;
			case "navy":
				$colors[0] = "01689B";
				$colors[1] = "CCE0F1";
				$colors[2] = "E5F0F9";
				$colors[3] = "154273";
				$colors[4] = "0162CD";
				break;
			case "orange":
				$colors[0] = "E17000";
				$colors[1] = "F6D4B2";
				$colors[2] = "FBEAD9";
				break;
			case "blue":
				$colors[0] = "007BC7";
				$colors[1] = "B2D7EE";
				$colors[2] = "D9EBF7";
				break;
			case "sand":
				$colors[0] = "F9B249";
				$colors[1] = "FDE4BE";
				$colors[2] = "FEF2DF";
				break;
			case "green":
				$colors[0] = "4E9625";
				$colors[1] = "CBE1BD";
				$colors[2] = "E1FECF";
				break;
			default:
				break;
		}
		
		define("PLEIO_TEMPLATE_SELECTOR_COLOR_1", strtoupper($colors[0]));
		define("PLEIO_TEMPLATE_SELECTOR_COLOR_2", strtoupper($colors[1]));
		define("PLEIO_TEMPLATE_SELECTOR_COLOR_3", strtoupper($colors[2]));
		define("PLEIO_TEMPLATE_SELECTOR_COLOR_4", strtoupper($colors[3]));
		define("PLEIO_TEMPLATE_SELECTOR_COLOR_5", strtoupper($colors[4]));
	}
