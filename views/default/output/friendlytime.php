<?php
/**
 * Friendly time
 * Translates an epoch time into a human-readable time.
 *
 * @uses string $vars['time'] Unix-style epoch timestamp
 */

$absolute_time = elgg_get_plugin_setting("absolute_time", "pleio_template_selector");

if ($absolute_time && $absolute_time === "yes") {
    $timestamp = htmlspecialchars(strftime("%d %B %Y, %H:%M", $vars['time']));
    $friendly_time = $timestamp;
} else {
    $friendly_time = elgg_get_friendly_time($vars['time']);
    $timestamp = htmlspecialchars(date(elgg_echo('friendlytime:date_format'), $vars['time']));
}

echo "<acronym title=\"$timestamp\">$friendly_time</acronym>";