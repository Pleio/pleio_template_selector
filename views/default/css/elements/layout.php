<?php
/**
 * Page Layout
 *
 * Contains CSS for the page shell and page layout
 *
 * Default layout: 990px wide, centered. Used in default page shell
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>

/* ***************************************
	PAGE LAYOUT
*************************************** */
/***** DEFAULT LAYOUT ******/
<?php // the width is on the page rather than topbar to handle small viewports ?>
.elgg-page-default {
	min-width: 998px;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	width: 990px;
	margin: 0 auto;
	height: 150px;
	border-bottom: 10px solid #<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_2;?>;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
	width: 990px;
	margin: 0 auto;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
	width: 990px;
	margin: 0 auto;
	padding: 5px 0;
}

.elgg-page-default .elgg-page-body {
	width: 1010px;
	margin: 0 auto;
	background: transparent url("<?php echo elgg_get_site_url(); ?>mod/pleio_template_selector/_graphics/background.png") repeat-y scroll right top;
}

/***** TOPBAR ******/
.elgg-page-topbar {
	background: #333333 url(<?php echo elgg_get_site_url(); ?>_graphics/toptoolbar_background.gif) repeat-x top left;
	border-bottom: 1px solid #000000;
	position: relative;
	height: 24px;
	z-index: 9000;
}
.elgg-page-topbar > .elgg-inner {
	padding: 0 10px;
}

/***** PAGE MESSAGES ******/
.elgg-system-messages {
	position: fixed;
	top: 24px;
	right: 20px;
	max-width: 500px;
	z-index: 2000;
}
.elgg-system-messages li {
	margin-top: 10px;
}
.elgg-system-messages li p {
	margin: 0;
}

/***** PAGE HEADER ******/

.elgg-page-theme-header {
	margin: 20px auto 0;
	width: 1010px;
	height: 10px;
	background: transparent url("<?php echo elgg_get_site_url(); ?>mod/pleio_template_selector/_graphics/background.png") repeat-y scroll left top;
}
.elgg-page-header {
	position: relative;
	margin: 0 auto;
	width: 1010px;
	background: transparent url("<?php echo elgg_get_site_url(); ?>mod/pleio_template_selector/_graphics/background.png") repeat-y scroll right top;
}
.elgg-page-header > .elgg-inner {
	position: relative;
}

.elgg-heading-site-logo {
	position: absolute;
}

.elgg-heading-site-logo-left {
	left: 0px;
}

.elgg-heading-site-logo-right {
	right: 0px;
}

.elgg-heading-site-logo-center {
	left: 473px;
}

/***** PAGE BODY LAYOUT ******/
.elgg-layout {
	min-height: 360px;
	background: #<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_2;?>;
}

.elgg-sidebar {
	position: relative;
	padding: 20px 10px;
	float: right;
	width: 210px;
	margin: 0 0 0 10px;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 20px 10px;
	float: left;
	width: 160px;
	margin: 0 10px 0 0;
}
.elgg-main {
	position: relative;
	min-height: 360px;
	padding: 10px 7px;
	background: white;
}
.elgg-main > .elgg-head {
	padding-bottom: 3px;
	border-bottom: 1px solid #CCCCCC;
	margin-bottom: 10px;
}

/***** PAGE FOOTER ******/

.elgg-page-theme-footer {
	margin: 0 auto;
	width: 1010px;
	height: 40px;
	background: transparent url("<?php echo elgg_get_site_url(); ?>mod/pleio_template_selector/_graphics/background.png") repeat-y scroll left bottom;
}

.elgg-page-footer {
	position: relative;
}
.elgg-page-footer {
	color: #999;
}
.elgg-page-footer a:hover {
	color: #666;
}