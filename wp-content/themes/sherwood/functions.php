<?php
/**
 * Theme Functions
 *
 * @package sherwood
 */

require_once 'classes/class-script-loader.php';
require_once 'classes/class-theme.php';
require_once 'classes/class-sherwood.php';

$emma = new Sherwood();

function get_cdn_url($filename) {
	$base = 'https://cdn.jsdelivr.net/gh/trvswgnr/cdn@latest/';
	return $base . trim($filename, '/');
}
