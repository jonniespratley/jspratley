<?php
$plugin [ 'name' ] = 'jps_txp_lab';
$plugin [ 'version' ] = '0.1';
$plugin [ 'author' ] = 'Jonnie Spratley';
$plugin [ 'author_uri' ] = 'http://jonniespratley.com';
$plugin [ 'description' ] = 'My Fuck around';
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
	$jpsCategoryTab = 'Fx Categories';
	
	//Event that will be called when tab is clicked
	$jpsCategoryEvent = 'jps_fx_categories';
	
	$jpsServiceStepEvent = 'jps_service_event';
	
	
	//Add privilages to this event, or it won't work
	add_privs ( $jpsCategoryEvent, '1,2,3,4,5,6' );
	add_privs( $jpsServiceStepEvent, '1,2,3,4,5,6' ); 
	
	//Now you have to set the actual tab.
	//					section		event					name of the tab
	register_tab ( 'content', $jpsCategoryEvent, $jpsCategoryTab );
	
	//							event						event
	register_callback ( $jpsCategoryEvent, $jpsCategoryEvent );
	register_callback( $jpsCategoryEvent, $jpsCategoryEvent, $jpsServiceStepEvent, 0 );

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
function jps_fx_categories( $event, $step )
{
	// Default header and navigation
	#pagetop ( "Textpattern", '' );
	if ( $step == 'jps_service_event' )
	{
		jps_service_event( $step );
	} else {
		echo '<h1>I am building the page</h1>';
	}
	
	
	
}



function jps_service_event()
{
	$table = '';
	$mode = '';

	if ( isset( $_GET['m'] ) )
	{
		$mode = $_GET['m'];	
	}
	if ( isset( $_GET['t'] ) )
	{
		$table = $_GET['t'];	
	}
	
	//print_r( getShit( '*', 'textpattern', 'json' ) );
	
	
	switch( $mode )
	{
		case 'getData';
			print_r( getShit( '*', $table, 'json' ) );		
		break;
	}
	exit();
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

