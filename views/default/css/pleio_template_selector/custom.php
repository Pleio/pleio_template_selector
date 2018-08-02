<?php

$plugin = elgg_get_plugin_from_id("pleio_template_selector");

$layout_header_height = sanitise_int($plugin->layout_header_height, false);
$show_logo_footer = $plugin->show_logo_footer;
$disable_rounded_corners = $plugin->disable_rounded_corners;
$sidebar_align_left = $plugin->sidebar_align_left;
$menu_bottom = sanitise_int($plugin->menu_bottom, false);
$menu_align = $plugin->menu_align;
$background_color = $plugin->custom_color_6;
$show_body_gradient = $plugin->show_body_gradient;
$use_background_image = $plugin->use_background_image;
$widget_background_color = $plugin->custom_color_7;
$widget_header_color = $plugin->custom_color_8;
$widget_title_color = $plugin->custom_color_9;

$search_bottom = sanitise_int($plugin->search_bottom);
if (!$search_bottom) {
	$search_bottom = 1;
}
$search_right = sanitise_int($plugin->search_right);

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

if ($sidebar_align_left != "no") {
	?>
	.elgg-sidebar {
		float:left;
		margin:0;
		padding:0 20px; }
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
	if ($background_image_url = pleio_template_selector_get_site_background()) {
		$background_image_position = $plugin->background_image_position;
		$background_image_fixed = $plugin->background_image_fixed;
		$background_image_repeat = $plugin->background_image_repeat;

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

if ($widget_background_color) {
	?>
	.elgg-module-widget,
	.elgg-module-widget:hover {
		background-color: #<?php echo $widget_background_color; ?>;
	}

	.elgg-module-widget > .elgg-body {
		border-top-color: #<?php echo $widget_background_color; ?>;
	}
	<?php
}

if ($widget_header_color) {
	?>
	.elgg-module-widget > .elgg-head {
		background-color: #<?php echo $widget_header_color; ?>;
	}
	<?php
}

if ($widget_title_color) {
	?>
	.elgg-module-widget > .elgg-head h3,
	.elgg-module-widget > .elgg-head h3 a {
		color: #<?php echo $widget_title_color; ?>;
	}
	<?php
}


// Custom Css
echo $plugin->custom_css;
