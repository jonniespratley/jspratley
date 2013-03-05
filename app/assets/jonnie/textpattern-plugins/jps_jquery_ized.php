<?php

$plugin['name'] = 'jps_jquery_ized';
$plugin['version'] = '0.1';
$plugin['author'] = 'Jonnie Spratley';
$plugin['author_uri'] = 'http://jonniespratley.com';
$plugin['description'] = 'A jquery ized textpattern';
$plugin['order'] = '5';
$plugin['type'] = '1';

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
if ( @txpinterface == 'admin' )
{
	$jpsEvent = 'jps_jquery_category_setup';
	add_privs ( $jpsEvent, '1,2,3,4,5,6' );
	register_callback ( $jpsEvent, "category" );  
}


function jps_jquery_category_setup()
{
	global $prefs;
	$assetsURL = 'http://' . $prefs [ 'siteurl' ] . '/textpattern/assets/';
	
	$js = '

<script src="'.$assetsURL.'js/jquery.qtip.js" type="text/javascript"></script>

<script type="text/javascript">
$(function()
{
	$(".tip").qtip();
	window.console.log("Jquery Ized is ready.");
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