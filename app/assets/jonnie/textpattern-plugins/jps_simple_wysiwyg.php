<?php

$plugin['name'] = 'jps_simple_wysiwyg';
$plugin['version'] = '0.1';
$plugin['author'] = 'Jonnie Spratley';
$plugin['author_uri'] = 'http://jonniespratley.com';
$plugin['description'] = 'A light weight jquery WYSIWYG editor';
$plugin['order'] = '5';
$plugin['type'] = '1';

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
if ( @txpinterface == 'admin' )
{
	$jpsEvent = 'jps_wysiwyg_setup';
	add_privs ( $jpsEvent, '1,2,3,4,5,6' );
	register_callback ( $jpsEvent, "article" );  
}


function jps_wysiwyg_setup()
{
	global $prefs;
	$assetsURL = 'http://' . $prefs [ 'siteurl' ] . '/textpattern/assets/';
	
	$js = '
<link href="'.$assetsURL.'js/jquery.wysiwyg/jquery.wysiwyg.css" rel="stylesheet"/>
<script src="'.$assetsURL.'js/jquery.wysiwyg/jquery.wysiwyg.js" type="text/javascript"></script>

<script type="text/javascript">
$(function()
{
	$("textarea").wysiwyg();
});
</script>';
	
	echo $js;
}


        
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
Copy the folder 'js' to the textpattern folder and enable the plugin.
# --- END PLUGIN HELP ---
-->
<?php
}
?>