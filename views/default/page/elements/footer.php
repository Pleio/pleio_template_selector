<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 *
 */

$custom_footer_html = elgg_get_plugin_setting("custom_footer_html", "pleio_template_selector");
if ($custom_footer_html) {
	echo $custom_footer_html;
} else {
	echo elgg_view_menu('footer', array('sort_by' => 'register', 'class' => 'elgg-menu-hz'));
}
