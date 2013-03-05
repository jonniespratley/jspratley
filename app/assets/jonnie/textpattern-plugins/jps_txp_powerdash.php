<?php
$plugin [ 'name' ] = 'jps_txp_powerdash';
$plugin [ 'version' ] = '0.1';
$plugin [ 'author' ] = 'Jonnie Spratley';
$plugin [ 'author_uri' ] = 'http://jonniespratley.com';
$plugin [ 'description' ] = 'A power users editor';
$plugin [ 'order' ] = '5';
$plugin [ 'type' ] = '1';

if ( ! defined ( 'txpinterface' ) ) @include_once ( 'zem_tpl.php' );
# --- BEGIN PLUGIN CODE ---


/* ========================================================================================
 * 	PLUGIN CODE STARTS ABOUT RIGHT HERE
 * ======================================================================================== */


/* ========================================================================================
 * 	SETUP THE PLUGIN - TABS, EVENTS, CALLBACKS, FUNCTIONS, PRIVILLAGES
 * ======================================================================================== */
if ( @txpinterface == 'admin' )
{	
	//Tab that will be in the menu
	$jpsPowerDashTab = 'Power-Dash';
	
	//Event that will be called when tab is clicked
	$jpsPowerDashEvent = 'jps_power_dash';
	
	//Add privilages to this event, or it won't work
	add_privs ( $jpsPowerDashEvent, '1,2,3' );
	
	//Now you have to set the actual tab.
	//					section		event					name of the tab
	register_tab ( 'content', $jpsPowerDashEvent, $jpsPowerDashTab );
	
	//							event						event
	register_callback ( $jpsPowerDashEvent, $jpsPowerDashEvent );

} //ends @txpinterface == admin



/* ========================================================================================
 * 	NOW YOU CAN CREATE YOUR FUNCTIONS THAT WILL BE CALLED WHEN THE EVENT HAPPENS
 * ======================================================================================== */

/**
 * I don't do anything
 *
 * @param [string] $event
 * @param [string] $step
 */
function jps_power_dash( $event, $step )
{
	// Default header and navigation
	pagetop ( "Textpattern", '' );
	 
	
	print_r( getShit( 'url, category', 'txp_link', 'json' ) );
	 
}



 

/**
 * I get shit from the database
 *
 * @param [string] $shit - A string of the columns you want returned. 
 * [Example: title, body, category] - Returns the title, body and category columns
 * 
 * @param [string] $table - The table you want shit from.
 * @param [string] $format - The format you want your shit. Only option is 'json';
 * 
 * @return [array] - Shit from the database or json shit.
 */
function getShit( $shit, $table, $format = '' )
{
	$rows = safe_rows_start ( $shit, $table, '1=1' );
	
	$results = array();
	
	//If it happened
	if ( $rows )
	{
		//loop it
		while ( $row = nextRow ( $rows ) )
		{
			$results[] = $row;
		}
		if ( $format == 'json' )
		{
			return json_encode( $results );
		} else {
			return $results;
		}
	}
	return false;
}















/* ========================================================================================
 * 	PLUGIN CODE ENDS ABOUT RIGHT HERE
 * ======================================================================================== */


# --- END PLUGIN CODE ---
if ( 0 )
{
?>
<!--
# --- BEGIN PLUGIN HELP ---
There is none right now.
# --- END PLUGIN HELP ---
-->
<?php
}
?>

