<?php
/**
 * CSS buttons
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* **************************
	BUTTONS
************************** */

/* Base */
.elgg-button {
	font-size: 14px;
	font-weight: bold;
	
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	width: auto;
	padding: 2px 4px;
	cursor: pointer;
	outline: none;
	
	-webkit-box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.40);
	-moz-box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.40);
	box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.40);
}
a.elgg-button {
	padding: 3px 6px;
}

/* Submit: This button should convey, "you're about to take some definitive action" */
.elgg-button-submit {
	color: white;
	text-shadow: 1px 1px 0px black;
	text-decoration: none;
	border: 1px solid #<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_1;?>;
	background: #<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_1;?> url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
}

.elgg-button-submit:hover {
	border-color: #<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_1;?>;
	text-decoration: none;
	color: white;
	background: #<?php echo PLEIO_TEMPLATE_SELECTOR_COLOR_1;?> url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
}

.elgg-button-submit.elgg-state-disabled {
	background: #999;
	border-color: #999;
	cursor: default;
}

/* Cancel: This button should convey a negative but easily reversible action (e.g., turning off a plugin) */
.elgg-button-cancel {
	color: #333;
	background: #ddd url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	border: 1px solid #999;
}
.elgg-button-cancel:hover {
	color: #444;
	background-color: #999;
	background-position: left 10px;
	text-decoration: none;
}

/* Action: This button should convey a normal, inconsequential action, such as clicking a link */
.elgg-button-action {
	background: #ccc url(<?php echo elgg_get_site_url(); ?>_graphics/button_background.gif) repeat-x 0 0;
	border:1px solid #999;
	color: #333;
	padding: 2px 15px;
	text-align: center;
	font-weight: bold;
	text-decoration: none;
	text-shadow: 0 1px 0 white;
	cursor: pointer;
	
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.elgg-button-action:hover,
.elgg-button-action:focus {
	background: #ccc url(<?php echo elgg_get_site_url(); ?>_graphics/button_background.gif) repeat-x 0 -15px;
	color: #111;
	text-decoration: none;
	border: 1px solid #999;
}

/* Delete: This button should convey "be careful before you click me" */
.elgg-button-delete {
	color: #bbb;
	text-decoration: none;
	border: 1px solid #333;
	background: #555 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	text-shadow: 1px 1px 0px black;
}
.elgg-button-delete:hover {
	color: #999;
	background-color: #333;
	background-position: left 10px;
	text-decoration: none;
}

.elgg-button-dropdown {
	padding:3px 6px;
	text-decoration:none;
	display:block;
	font-weight:normal;
	position:relative;
	margin-left:0;
	color: #333;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}

.elgg-button-dropdown.elgg-state-active {
	background: #ccc;
	outline: none;
	color: #333;
}
