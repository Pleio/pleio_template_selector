<?php 

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function pleio_template_selector_init(){
		// extend css
		elgg_extend_view("css/admin", "pleio_template_selector/css");
		
		// register pagehandler for nice URL's
		elgg_register_page_handler("template_selector", "pleio_template_selector_page_handler");
		
		// set colors for template
		pleio_template_selector_set_colors();
		
		// check for custom_css
		elgg_extend_view("css/elgg", "pleio_template_selector/custom_css", 9999); // place it at the end so it can easily override other css
	}

	function pleio_template_selector_pagesetup(){
		elgg_register_admin_menu_item("configure", "template", "appearance", 50);
	}
	
	function pleio_template_selector_page_handler($page){
		
		switch($page[0]){
			case "custom_sitelogo":
				include(dirname(__FILE__) . "/pages/custom_sitelogo.php");
				break;
			default:
				return false;
		}
	}
		
	// register default Elgg events
	elgg_register_event_handler("init", "system", "pleio_template_selector_init");
	elgg_register_event_handler("pagesetup", "system", "pleio_template_selector_pagesetup");
	
	// register actions
	elgg_register_action("template_selector/settings", dirname(__FILE__) . "/actions/settings.php", "admin");