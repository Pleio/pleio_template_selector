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
	
	$background_image_position_options = array(
		"left top" => elgg_echo("pleio_template_selector:settings:other:background_image_position:left_top"),
		"left center" => elgg_echo("pleio_template_selector:settings:other:background_image_position:left_center"),
		"left bottom" => elgg_echo("pleio_template_selector:settings:other:background_image_position:left_bottom"),
		"right top" => elgg_echo("pleio_template_selector:settings:other:background_image_position:right_top"),
		"right center" => elgg_echo("pleio_template_selector:settings:other:background_image_position:right_center"),
		"right bottom" => elgg_echo("pleio_template_selector:settings:other:background_image_position:right_bottom"),
		"center top" => elgg_echo("pleio_template_selector:settings:other:background_image_position:center_top"),
		"center center" => elgg_echo("pleio_template_selector:settings:other:background_image_position:center_center"),
		"center bottom" => elgg_echo("pleio_template_selector:settings:other:background_image_position:center_bottom"),
	);
	
	$background_image_repeat_options = array(
		"repeat" => elgg_echo("pleio_template_selector:settings:other:background_image_repeat:repeat"),
		"repeat-x" => elgg_echo("pleio_template_selector:settings:other:background_image_repeat:repeat-x"),
		"repeat-y" => elgg_echo("pleio_template_selector:settings:other:background_image_repeat:repeat-y"),
		"no-repeat" => elgg_echo("pleio_template_selector:settings:other:background_image_repeat:no-repeat"),
	);
	
	$left_right_align = array (
		"left" => elgg_echo("pleio_template_selector:sitelogo:align:left"),
		"right" => elgg_echo("pleio_template_selector:sitelogo:align:right")
	);
	
	$yesno_options = array(
		"yes" => elgg_echo("option:yes"),
		"no" => elgg_echo("option:no")
	);
	
	$noyes_options = array_reverse($yesno_options, true);
	
	elgg_load_css("colorpicker");
	elgg_load_js("colorpicker");

	// building form
	$form_body = "";
	
	// color settings
	$colorset_body = "<div id='pleio-template-selector-colorset-wrapper'>";
	
	$colorset_body .= "<script type='text/javascript'>";
	$colorset_body .= "var pleio_colors = new Object();\n";
	$colorset_body .= "pleio_colors.custom = new Object();\n";
	$colorset_body .= "pleio_colors.custom.custom_color_1 = \"" . THEME_COLOR_1 . "\";\n";
	$colorset_body .= "pleio_colors.custom.custom_color_2 = \"" . THEME_COLOR_2 . "\";\n";
	$colorset_body .= "pleio_colors.custom.custom_color_3 = \"" . THEME_COLOR_3 . "\";\n";
	$colorset_body .= "pleio_colors.custom.custom_color_4 = \"" . THEME_COLOR_4 . "\";\n";
	$colorset_body .= "pleio_colors.custom.custom_color_5 = \"" . THEME_COLOR_5 . "\";\n";
	
	foreach (pleio_template_selector_get_colors() as $color_name => $colors) {
		$colorset_body .= "pleio_colors." . $color_name . " = new Object();\n";
		foreach ($colors as $index => $hex) {
			$colorset_body .= "pleio_colors." . $color_name . ".custom_color_" . ($index + 1) . " = \"" . $hex . "\";\n";
		}
	}
	$colorset_body .= "</script>";
	
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
	
	$style = "";
	if ($custom_color = $plugin->custom_color_6) {
		$style = "background: #" . $custom_color;
	}
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[6]", "value" => $custom_color, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => $style));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:6") . "<br />";
	
	$style = "";
	if ($custom_color = $plugin->custom_color_7) {
		$style = "background: #" . $custom_color;
	}
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[7]", "value" => $custom_color, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => $style));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:7") . "<br />";
	
	$style = "";
	if ($custom_color = $plugin->custom_color_8) {
		$style = "background: #" . $custom_color;
	}
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[8]", "value" => $custom_color, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => $style));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:8") . "<br />";
	
	$style = "";
	if ($custom_color = $plugin->custom_color_9) {
		$style = "background: #" . $custom_color;
	}
	$colorset_body .= elgg_view("input/text", array("name" => "custom_color[9]", "value" => $custom_color, "class" => "pleio-template-selector-colorpicker mrm mbs", "style" => $style));
	$colorset_body .= elgg_echo("pleio_template_selector:settings:colorset:custom:9") . "<br />";

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

	$header .= "<br />";
	$header .= "<label>" . elgg_echo("pleio_template_selector:settings:header:url") . "&nbsp;";
	$header .= elgg_view("input/text", array("name" => "params[header_url]", "value" => $plugin->header_url)) . "</label><br />";
	
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:header:title"), $header);

	// footer settings
	$footer = "<label>" . elgg_echo("pleio_template_selector:settings:footer:show_logo_footer") . "&nbsp;";
	$footer .= elgg_view("input/dropdown", array("name" => "params[show_logo_footer]", "value" => $plugin->show_logo_footer, "options_values" => $yesno_options)) . "</label><br />";

	$footer .= "<label>" . elgg_echo("pleio_template_selector:settings:footer:custom_footer_html") . "&nbsp;";
	$footer .= elgg_view("input/plaintext", array("name" => "params[custom_footer_html]", "value" => $plugin->custom_footer_html)) . "</label>";
	$footer .= "<div class='elgg-subtext'>". elgg_echo("pleio_template_selector:settings:footer:custom_footer_html:info") . "</div>";
	
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:footer:title"), $footer);
	
	// other settings
	$other = "";
	
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:favicon") . "&nbsp;";
	$other .= elgg_view("input/file", array("name" => "favicon")) . "</label><br />";
	
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:disable_rounded_corners") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[disable_rounded_corners]", "value" => $plugin->disable_rounded_corners, "options_values" => $yesno_options)) . "</label><br />";

	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:show_body_gradient") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[show_body_gradient]", "value" => $plugin->show_body_gradient, "options_values" => $yesno_options)) . "</label><br />";
					
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:use_background_image") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[use_background_image]", "value" => $plugin->use_background_image, "options_values" => $noyes_options)) . "</label><br />";
	
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:background_image") . "&nbsp;";
	$other .= elgg_view("input/file", array("name" => "background_image")) . "</label><br />";
		
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:background_image_position") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[background_image_position]", "value" => $plugin->background_image_position, "options_values" => $background_image_position_options)) . "</label><br />";
			
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:background_image_fixed") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[background_image_fixed]", "value" => $plugin->background_image_fixed, "options_values" => $noyes_options)) . "</label><br />";
			
	$other .= "<label>" . elgg_echo("pleio_template_selector:settings:other:background_image_repeat") . "&nbsp;";
	$other .= elgg_view("input/dropdown", array("name" => "params[background_image_repeat]", "value" => $plugin->background_image_repeat, "options_values" => $background_image_repeat_options)) . "</label><br />";
			
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:other:title"), $other);
	
	// custom css
	$custom_css = elgg_view("input/plaintext", array("name" => "params[custom_css]", "value" => $plugin->custom_css));
	$custom_css .= "<div class='elgg-subtext'>". elgg_echo("pleio_template_selector:settings:custom_css:disclaimer") . "</div>";
		
	$form_body .= elgg_view_module("inline", elgg_echo("pleio_template_selector:settings:custom_css:title"), $custom_css);
	
	$form_body .= elgg_view("input/submit", array("value" => elgg_echo("save")));
	
	echo elgg_view("input/form", array("id" => "pleio-template-selector-admin-settings-form", "action" => "action/template_selector/settings", "enctype" => "multipart/form-data", "body" => $form_body));
	