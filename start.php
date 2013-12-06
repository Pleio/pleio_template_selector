<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function pleio_template_selector_init(){
		// set colors for template
		pleio_template_selector_set_colors();
		
		// extend css
		elgg_extend_view("css/admin", "css/pleio_template_selector/admin");
		elgg_extend_view("css/elgg", "css/pleio_template_selector/custom", 9999); // place it at the end so it can easily override other css
		
		// extend js
		elgg_extend_view("js/admin", "js/pleio_template_selector/admin");
		
		// register pagehandler for nice URL's
		elgg_register_page_handler("template_selector", "pleio_template_selector_page_handler");
		
		elgg_register_plugin_hook_handler("public_pages", "walled_garden", "pleio_template_selector_walled_garden_hook");
		
		elgg_register_admin_menu_item("configure", "template", "appearance", 50);
		
		// register libraries
		elgg_register_js("colorpicker", elgg_get_site_url() . "mod/pleio_template_selector/vendors/colorpicker/js/colorpicker.js");
		elgg_register_css("colorpicker", elgg_get_site_url() . "mod/pleio_template_selector/vendors/colorpicker/css/colorpicker.css");
		
		// theme header will control display of search
		elgg_unextend_view('page/elements/header', 'search/header');
	}

	function pleio_template_selector_page_handler($page){
		
		switch($page[0]){
			case "custom_sitelogo":
				include(dirname(__FILE__) . "/pages/custom_sitelogo.php");
				break;
			case "custom_background":
				include(dirname(__FILE__) . "/pages/custom_background.php");
				break;
			case "favicon":
				include(dirname(__FILE__) . "/pages/favicon.php");
				break;
			default:
				return false;
		}
	}
	
	function pleio_template_selector_walled_garden_hook($hook_name, $entity_type, $return_value, $params){
		$result = $return_value;
		
		// add site logo to the public pages
		$result[] = "template_selector/custom_sitelogo/.*";
		$result[] = "template_selector/custom_background/.*";
				
		return $result;
	}
		
	// register default Elgg events
	elgg_register_event_handler("init", "system", "pleio_template_selector_init");
	
	// register actions
	elgg_register_action("template_selector/settings", dirname(__FILE__) . "/actions/settings.php", "admin");