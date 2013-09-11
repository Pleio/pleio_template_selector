<?php
// custom header height
$layout_header_height = sanitise_int(elgg_get_plugin_setting("layout_header_height", "pleio_template_selector"), false);
$show_logo_footer = elgg_get_plugin_setting("show_logo_footer", "pleio_template_selector");
$disable_rounded_corners = elgg_get_plugin_setting("disable_rounded_corners", "pleio_template_selector");
$menu_bottom = sanitise_int(elgg_get_plugin_setting("menu_bottom", "pleio_template_selector"), false);
$menu_align = elgg_get_plugin_setting("menu_align", "pleio_template_selector");

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
<?php



// Custom Css
echo elgg_get_plugin_setting("custom_css", "pleio_template_selector");
	