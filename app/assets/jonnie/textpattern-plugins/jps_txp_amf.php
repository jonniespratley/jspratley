<?php

// This is a PLUGIN TEMPLATE.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'jps_txp_amf';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.1';
$plugin['author'] = 'Jonnie Spratley';
$plugin['author_uri'] = 'http://jonniespratley.com';
$plugin['description'] = 'A amfphp dashboard for setting up amf rpc to air desktop client.';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '5';

// Plugin 'type' defines where the plugin is loaded
// 0 = public       : only on the public side of the website (default)
// 1 = public+admin : on both the public and admin side
// 2 = library      : only when include_plugin() or require_plugin() is called
// 3 = admin        : only on the admin side
$plugin['type'] = '1';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '3';

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---



if ( @txpinterface == 'admin' )
{
	$amfTab = 'AMF Dashboard';
	$amfEvent = 'jps_amf_event';
	
	add_privs ( $amfEvent, '1' );
	
	/* ===============================================================================
	 * Register all callbacks and tabs, also permissions on all of the events
	 * That is something they don't tell you, 
	 * 
	 * I hate the resources on textpattern plugins, and the documentation, is shitty,
	 * actually... what documentation??
	 * 
	 * =============================================================================== */
	register_tab ( 'extensions', $amfEvent, $amfTab );
	register_callback ( $amfEvent, $amfEvent, null, 1 );

} //ends @txpinterface == admin

function jps_amf_event( $event, $step )
{
	//Default header and navigation, this took me so fucking long to figure out, no other part of the textpattern admin was showing up.
	//and no one would ever tell you to watch out for that, fuck them.
	pagetop ( "Textpattern", 'AMF Dashboard' ); //DONT FORGET TO HAVE THIS IF YOU WANT THE UGLY TEXTPATTERN TABS AND SHIT

	$site = $GLOBALS['prefs']['siteurl'];
	$amfphpPath = $site.'/rpc/amfphp/browser/';
	echo '<iframe src="'.$amfphpPath.'" width="100%" height="400" id="iframe_amfphp"></iframe>';

}



# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
Coming Soon
# --- END PLUGIN HELP ---
-->
<?php
}
?>