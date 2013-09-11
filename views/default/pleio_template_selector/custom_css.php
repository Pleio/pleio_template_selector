<?php
// custom header height
$layout_header_height = sanitise_int(elgg_get_plugin_setting("layout_header_height", "pleio_template_selector"), false);
$show_logo_footer = elgg_get_plugin_setting("show_logo_footer", "pleio_template_selector");
$disable_rounded_corners = elgg_get_plugin_setting("disable_rounded_corners", "pleio_template_selector");
$menu_bottom = sanitise_int(elgg_get_plugin_setting("menu_bottom", "pleio_template_selector"), false);
$menu_align = elgg_get_plugin_setting("menu_align", "pleio_template_selector");
$background_color = elgg_get_plugin_setting("custom_color_6", "pleio_template_selector");
$show_body_gradient = elgg_get_plugin_setting("show_body_gradient", "pleio_template_selector");
$use_background_image = elgg_get_plugin_setting("use_background_image", "pleio_template_selector");

$search_bottom = sanitise_int(elgg_get_plugin_setting("search_bottom", "pleio_template_selector"));
if (!$search_bottom) {
	$search_bottom = 1;
}
$search_right = sanitise_int(elgg_get_plugin_setting("search_right", "pleio_template_selector"));

if (empty($menu_align) || !in_array($menu_align, array("left", "right"))) {
	$menu_align = "left";
}

if (!empty($layout_header_height)) {
	?>
	.elgg-page-default .elgg-page-header > .elgg-inner {
		height: <?php echo $layout_header_height; ?>px;
	}
	<?php
}
	
if ($show_logo_footer == "no") {
	?>
	.elgg-page-theme-footer {
		height: 10px;
	}
	<?php
}

if ($disable_rounded_corners != "no") {
	?>
	* {
		-webkit-border-radius: 0px !important;
		-moz-border-radius: 0px !important;
		border-radius: 0px !important;
	}
	<?php
}

?>
.elgg-menu-site-container {
	background: #<?php echo THEME_COLOR_1; ?>;
	bottom: <?php echo $menu_bottom; ?>px;
    height: 45px;
    left: 0;
    position: absolute;
    width: 100%;
}

.elgg-menu-site-container .elgg-menu-site-default {
	<?php
	if ($menu_align == "left") {
		echo "left: 20px;";
	} else {
		echo "right: 20px;";
	}
	?>
}

#pleio-template-selector-search {
	bottom: <?php echo $search_bottom; ?>px;
	right: <?php echo $search_right; ?>px;
}
<?php

if ($background_color) {
	?>
	body {
		background-color: #<?php echo $background_color; ?>;
	}
	<?php
}

if ($show_body_gradient == "no") {
	?>
	
	.elgg-page-default .elgg-page-body,
	.elgg-page-header,
	.elgg-page-theme-footer,
	.elgg-page-theme-header {
		background: none;
	}
	<?php
}

if ($use_background_image == "yes") {
	$background_image_position = elgg_get_plugin_setting("background_image_position", "pleio_template_selector");
	$background_image_fixed = elgg_get_plugin_setting("background_image_fixed", "pleio_template_selector");
	$background_image_repeat = elgg_get_plugin_setting("background_image_repeat", "pleio_template_selector");
	
	if ($background_image_url = pleio_template_selector_get_site_background()) {
		?>
		body {
			background-image: url(<?php echo $background_image_url; ?>);
			background-position: <?php echo $background_image_position; ?>;
			background-repeat: <?php echo $background_image_repeat; ?>;
			<?php
			if ($background_image_fixed == "yes") {
				?>
				background-attachment: fixed;
				<?php
			}
			?>
		}
		<?php
	}
	
}



// Custom Css
echo elgg_get_plugin_setting("custom_css", "pleio_template_selector");
	