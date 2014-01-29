<?php
$lang_file = dirname(__FILE__) . '/' . $mce_locale . '_dlg.js';

if ( is_file($lang_file) && is_readable($lang_file) )
	$strings = wp_super_edit_get_file($lang_file);
else {
	$strings = wp_super_edit_get_file(dirname(__FILE__) . '/en_dlg.js');
	$strings = preg_replace( '/([\'"])en\./', '$1'.$mce_locale.'.', $strings, 1 );
}
