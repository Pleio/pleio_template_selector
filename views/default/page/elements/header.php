<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

// link back to main site.
echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
if (elgg_get_plugin_setting("show_login_dropdown", "pleio_template_selector") != "no") {
	echo elgg_view('core/account/login_dropdown');
}

// language selector
if(!elgg_is_logged_in()){
	echo elgg_view('language_selector/default');
}

// search
if(elgg_get_plugin_setting("show_search", "pleio_template_selector") !== "no"){
	echo "<div id='pleio-template-selector-search'>";
	echo elgg_view('search/search_box');
	echo "</div>";
}


// cookie consent
if(elgg_get_plugin_setting("cookie_consent", "pleio_template_selector") !== "no"){
	echo elgg_view('cookie_consent/header');
}

echo "<div class='elgg-menu-site-container'>";
// insert site-wide navigation
echo elgg_view_menu('site');
echo "</div>";