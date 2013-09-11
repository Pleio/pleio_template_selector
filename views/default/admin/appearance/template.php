<?php

	$plugin = elgg_get_plugin_from_id("pleio_template_selector");

	$allowed_colorsets = array(
		"navy" => elgg_echo("pleio_template_selector:settings:colorset:navy"),
		"mint" => elgg_echo("pleio_template_selector:settings:colorset:mint"),
		"magenta" => elgg_echo("pleio_template_selector:settings:colorset:magenta"),
		"yellow" => elgg_echo("pleio_template_selector:settings:colorset:yellow"),
		"purple" => elgg_echo("pleio_template_selector:settings:colorset:purple"),
		"violet" => elgg_echo("pleio_template_selector:settings:colorset:violet"),
		"pink" => elgg_echo("pleio_template_selector:settings:colorset:pink"),
		"orange" => elgg_echo("pleio_template_selector:settings:colorset:orange"),
		"sand" => elgg_echo("pleio_template_selector:settings:colorset:sand"),
		"green" => elgg_echo("pleio_template_selector:settings:colorset:green"),
		"custom" => elgg_echo("pleio_template_selector:settings:colorset:custom")
	);
	
	$colorset = $plugin->colorset;
	
	if (empty($colorset) || !array_key_exists($colorset, $allowed_colorsets)) {
		$colorset = "navy";
	}
	
	$allowed_logos = array("none", "blank", "defensie", "rijksoverheid", "custom");
	
	$logo_align_options = array(
		"center" => elgg_echo("pleio_template_selector:sitelogo:align:center"),
		"left" => elgg_echo("pleio_template_selector:sitelogo:align:left"),
		"right" => elgg_echo("pleio_template_selector:sitelogo:align:right"),
		"custom" => elgg_echo("pleio_template_selector:sitelogo:align:custom"),
	);
	
	$left_right_align = array (
		"left" => elgg_echo("pleio_template_selector:sitelogo:align:left"),
		"right" => elgg_echo("pleio_template_selector:sitelogo:align:right")
	);
	
	$yesno_options = array(
		"yes" => elgg_echo("option:yes"),
		"no" => elgg_echo("option:no")
	);
	
	elgg_load_css("colorpicker");
	elgg_load_js("colorpicker");

	// building form
	$form_body = "";
	
	// color settings
	$colorset_body = "<div id='pleio-template-selector-colorset-wrapper'>";
	
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[1]", "value" => THEME_COLOR_1, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => "background: #" . THEME_COLOR_1));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:1") . "<br />";
		
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[2]", "value" => THEME_COLOR_2, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => "background: #" . THEME_COLOR_2));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:2") . "<br />";
		
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[3]", "value" => THEME_COLOR_3, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => "background: #" . THEME_COLOR_3));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:3") . "<br />";
		
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[4]", "value" => THEME_COLOR_4, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => "background: #" . THEME_COLOR_4));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:4") . "<br />";
		
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[5]", "value" => THEME_COLOR_5, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => "background: #" . THEME_COLOR_5));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:5") . "<br />";

	$colorset_body .= "</div>";
	
	$colorset_body .= "<div id='pleio_template_selector_admin_colorset_options'>";
	$colorset_body .= elgg_view("input/radio", array("name" => "params[colorset]", "value" => $colorset, "options" => array_flip($allowed_colorsets)));
	$colorset_body .= "</div>";
	
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:colorset:header"), $colorset_body);
	
	// header settings
	$header = "<div id='pleio-template-selector-admin-logo-preview'><img src='" . pleio_template_selector_get_site_logo(). "' /></div>";
	
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:show_title") . "&nbsp;";
	$header .= elgg_view("input/dropdown", array("name" => "params[show_title]", "value" => $plugin->show_title, "options_values" => $yesno_options)) . "</label><br />";
	
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:show_login_dropdown") . "&nbsp;";
	$header .= elgg_view("input/dropdown", array("name" => "params[show_login_dropdown]", "value" => $plugin->show_login_dropdown, "options_values" => $yesno_options)) . "</label><br />";
	
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:layout_header_height") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[layout_header_height]", "value" => (int) $plugin->layout_header_height, "class" => "pleio-template-selector-setting-small-input")) . "px</label><br />";
	
	$header .= "<br />";
	
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:sitelogo") . "&nbsp;";
	$header .= elgg_view("input/dropdown", array("name" => "params[sitelogo]", "value" => $plugin->sitelogo, "options" => $allowed_logos, "onchange" => "elgg.pleio_template_selector.sitelogo_change(this)")) . "</label><br />";
	
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:sitelogo_align") . "&nbsp;";
	$header .= elgg_view("input/dropdown", array("name" => "params[sitelogo_align]", "value" => $plugin->sitelogo_align, "options_values" => $logo_align_options, "onchange" => "elgg.pleio_template_selector.sitelogo_change_align(this)")) . "</label>";
	
	// logo alignment
	$hidden = "";
	if ($plugin->sitelogo_align !== "custom") {
		$hidden = " hidden";
	}
	$header .= "<span id='pleio-template-selector-admin-logo-align-custom' class='plm$hidden'>";
	$header .= elgg_echo("top") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[sitelogo_align_top]", "value" => (int) $plugin->sitelogo_align_top, "class" => "pleio-template-selector-setting-small-input")) . "px &nbsp;";
	$header .= elgg_echo("pleio_template_selector:settings:header:sitelogo_align:left") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[sitelogo_align_left]", "value" => (int) $plugin->sitelogo_align_left, "class" => "pleio-template-selector-setting-small-input")) . "px";
	$header .= "</span><br />";
		
	// custom logo
	$hidden = "";
	if ($plugin->sitelogo !== "custom") {
		$hidden = " class='hidden'";
	}
	
	$header .= "<div id='pleio-template-selector-admin-logo-custom-wrapper'$hidden>";
	$header .= "<label>". elgg_echo("pleio_template_selector:settings:header:sitelogo:custom");
	$header .= elgg_view("input/file", array("name" => "custom_sitelogo")) . "</label>";
	$header .= "</div>";
	
	$header .= "<br />";
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:menu_bottom") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[menu_bottom]", "value" => (int) $plugin->menu_bottom, "class" => "pleio-template-selector-setting-small-input")) . "px</label><br />";
		
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:menu_align") . "&nbsp;";
	$header .= elgg_view("input/dropdown", array("name" => "params[menu_align]", "value" => $plugin->menu_align, "options_values" => $left_right_align)) . "</label><br />";

	$header .= "<br />";
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:show_search") . "&nbsp;";
	$header .= elgg_view("input/dropdown", array("name" => "params[show_search]", "value" => $plugin->show_search, "options_values" => $yesno_options)) . "</label><br />";
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:search_right") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[search_right]", "value" => (int) $plugin->search_right, "class" => "pleio-template-selector-setting-small-input")) . "px</label><br />";
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:search_bottom") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[search_bottom]", "value" => (int) $plugin->search_bottom, "class" => "pleio-template-selector-setting-small-input")) . "px</label><br />";
		
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:header:title"), $header);

	// footer settings
	$footer = "<label>" . elgg_echo("pleio_template_selector:settings:footer:show_logo_footer") . "&nbsp;";
	$footer .= elgg_view("input/dropdown", array("name" => "params[show_logo_footer]", "value" => $plugin->show_logo_footer, "options_values" => $yesno_options)) . "</label>";
					
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:footer:title"), $footer);
	
	// other settings
	$other = "<label>" . elgg_echo("pleio_template_selector:settings:other:disable_rounded_corners") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[disable_rounded_corners]", "value" => $plugin->disable_rounded_corners, "options_values" => $yesno_options)) . "</label>";
					
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:other:title"), $other);
	
	// custom css
	$custom_css = elgg_view("input/plaintext", array("name" => "params[custom_css]", "value" => $plugin->custom_css));
	$custom_css .= "<div class='elgg-subtext'>". elgg_echo("pleio_template_selector:settings:custom_css:disclaimer") . "</div>";
		
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:custom_css:title"), $custom_css);
	
	$form_body .= elgg_view("input/submit", array("value" => elgg_echo("save")));
	
	echo elgg_view("input/form", array("id" => "pleio-template-selector-admin-settings-form", "action" => "action/template_selector/settings", "enctype" => "multipart/form-data", "body" => $form_body));
	