<?php

$plugin = elgg_get_plugin_from_id("pleio_template_selector");

$bg_color = $plugin->custom_color_6;

if (empty($bg_color)) {
	$bg_color = "FFF";
}
?>
body {
	background: #<?php echo $bg_color; ?>;
	color: #333333;
	font: 80%/1.4 "Lucida Grande",Arial,Tahoma,Verdana,sans-serif;
}

a {
	color: #<?php echo THEME_COLOR_4;?>;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

img {
	border: none;
}

h1,
h2,
h3,
h4 {
	color: #<?php echo THEME_COLOR_1;?>;
	margin: 0;
}

h1 {
	font-size: 18px;
}

h2 {
	font-size: 16px;
}

h3 {
	font-size: 16px;
}

h4 {
	font-size: 14px;
}

#newsletter_online {
	font-size: 11px;
	color: #999999;
	text-align: center;
	padding: 10px 20px 0px;
	margin: 0 auto;
	width: 600px;
}

#newsletter_header {
	padding: 10px 30px;
	min-height: 20px;
	
	background: #<?php echo THEME_COLOR_1;?>;
	
	border-top: 1px solid #dbdbdb;
	border-left: 1px solid #dbdbdb;
	border-bottom: 1px solid #dbdbdb;
	border-right: 1px solid #dbdbdb;
	
	-webkit-border-radius: 5px 5px 0 0;
	-moz-border-radius: 5px 5px 0 0;
	border-radius: 5px 5px 0 0;
}

#newsletter_header h1{
	color: #FFFFFF;
}

#newsletter_container {
	padding: 20px 0;
	width: 600px;
	margin: 0 auto;
}

#newsletter_unsubscribe {
	font-size: 11px;
	color: #999999;
	padding: 20px;
	text-align: center;
}

#newsletter_footer {
	padding: 30px;
	background: #<?php echo THEME_COLOR_2;?>;
	
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #dbdbdb;
	border-bottom: 1px solid #dbdbdb;
	border-right: 1px solid #dbdbdb;
	
	-webkit-border-radius: 0 0 5px 5px;
	-moz-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
}

.elgg-module-newsletter {
	background: #FFFFFF;
	padding: 30px;
	
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #dbdbdb;
	border-bottom: 1px solid #dbdbdb;
	border-right: 1px solid #dbdbdb;
}

.elgg-module-newsletter .elgg-head {
	padding-bottom: 5px;
	border-bottom: 1px solid #dbdbdb;
}

.elgg-module-newsletter h1 a,
.elgg-module-newsletter h2 a,
.elgg-module-newsletter h3 a {
	text-decoration: none;
}