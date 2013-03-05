<?php
$plugin [ 'name' ] = 'jps_db_manager';
$plugin [ 'version' ] = '0.1';
$plugin [ 'author' ] = 'Jonnie Spratley';
$plugin [ 'author_uri' ] = 'http://jonniespratley.com';
$plugin [ 'description' ] = 'Database Manager';
$plugin [ 'order' ] = '5';

// Plugin 'type' defines where the plugin is loaded
// 0 = public       : only on the public side of the website (default)
// 1 = public+admin : on both the public and admin side
// 2 = library      : only when include_plugin() or require_plugin() is called
// 3 = admin        : only on the admin side
$plugin [ 'type' ] = '1';

if ( ! defined ( 'txpinterface' ) ) @include_once ( 'zem_tpl.php' );

# --- BEGIN PLUGIN CODE ---


if ( @txpinterface == 'admin' )
{
	$jpsDBTab = 'Fxk DB Manager';
	$jpsDBEvent = 'jps_db_manager';
	
	add_privs ( $jpsDBEvent, '1' );
	
	/* ===============================================================================
	 * Register all callbacks and tabs, also permissions on all of the events
	 * That is something they don't tell you, 
	 * 
	 * I hate the resources on textpattern plugins, and the documentation, is shitty,
	 * actually... what documentation??
	 * 
	 * =============================================================================== */
	register_tab ( 'extensions', $jpsDBEvent, $jpsDBTab );
	register_callback ( $jpsDBEvent, $jpsDBEvent, null, 1 );

} //ends @txpinterface == admin


/**
 * array (
 * 'db' => 'fxktextpattern',
 * 'user' => 'root',
 * 'pass' => 'fred',
 * 'host' => 'localhost',
 * 'table_prefix' => '',
 * 'txpath' => '/Applications/MAMP/htdocs/fxk-textpattern/textpattern',
 * 'dbcharset' => 'utf8',
 * 'doc_root' => '/Applications/MAMP/htdocs',
 * )
 * 
 *
 * @param [string] $event - what event does textpattern trigger, ( categories, articles, forms, etc. ) Look at the end of the url and you will see it.
 * @param [string] $step - what event step is textpattern triggering, ( for categories, when you create a category this is the step: category_article_create ).
 */
function jps_db_manager( $event, $step )
{
	//Default header and navigation, this took me so fucking long to figure out, no other part of the textpattern admin was showing up.
	//and no one would ever tell you to watch out for that, fuck them.
	pagetop ( "Textpattern", '' ); //DONT FORGET TO HAVE THIS IF YOU WANT THE UGLY TEXTPATTERN TABS AND SHIT
	

	$dbJSON = ''; //get the JSON ready
	

	//Start building the top of OUR plugin
	$html = '<h1>Database Manager</h1>';
	
	//Shoot that shit out really quick.
	echo $html;
	
	/* ==================================================================================
	 * First part is complete, now we are going to set up for our REST admin stuff
	 * I know its tacky but so is textpattern, but I still love it <3;
	 * 
	 * We are going to have a few different modes, and going to check if the url query
	 * string has any of what we want, and if it does we want to go ahead and do the 
	 * correct function for it.
	 * 
	 * Watch
	 * ================================================================================== */
	
	//the mode variable ( ie: http://textpattern/index.php?event=OUR_PLUGIN_EVENT_NAME&m=GETDATA )
	$mode = ''; // m = GETDATA
	$query = ''; // q = the sql you want to call
	$dbJSON = json_encode ( _getTables () );
	/**
	 * Here is another shitty name for the textpattern variable, gps( what );
	 * this shit checks for a GET variable from the url or something.
	 * So we check if the url has a m in it for our MODE
	 */
	if ( gps ( 'm' ) )
	{
		//It does, good. set the m to the mode variable
		$mode = gps ( 'm' );
		
		//Good there is a mode so lets check for a q
		if ( gps ( 'q' ) )
		{
			$query = gps ( 'q' );
		}
		
		//Now lets switch depending on what mode is specified
		switch ( $mode )
		{
			//case they want the tables, call the getTables() and set the return value to the $dbJSON variable we declared earlier
			case 'getTables':
				$dbJSON = json_encode ( _getTables () );
				break;
			
			case 'execute':
				$dbJSON = json_encode ( _executeQuery ( $query ) );
				break;
		
		}
	} //ends mode check
	

	$html = <<<EOF
	<script src="js/swfobject_modified.js" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript">
		
	   function getTables()
		{
			dump( '$dbJSON' );
			return '$dbJSON';
		}
		
		function gotTables()
		{
			dump( '$dbJSON' ); 
			return '$dbJSON';
		}
		
		function dump( str )
		{
			document.getElementById( "fxk_debug" ).innerHTML += str;
		}
		
		function thisMovie(movieName)
		{
		    if (navigator.appName.indexOf("Microsoft") != -1) {
		        return window[movieName];
		    } else {
		        return document[movieName];
		    }
		}
		
		function tableSelected( table )
		{
			alert( table );
		}


	</script>
<style type="text/css">
<!--
#fxk_holder {
	width: 800px;
	margin-right: auto;
	margin-left: auto;
	padding: 0px;
}
#fxk_debug {
	font: medium "Courier New", Courier, monospace;
	border: 1px dotted #cccccc;
	background: #fefefe;
}
-->
</style>
<div id="fxk_holder">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="761" height="375" id="TxpDatabaseManager" title="TxpDatabaseManager">
  <param name="movie" value="txp_databasemanager/TxpDatabaseManager.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="9.0.45.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you donÕt want users to see the prompt. -->
  <param name="expressinstall" value="js/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="txp_databasemanager/TxpDatabaseManager.swf" width="761" height="375">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="9.0.45.0" />
    <param name="expressinstall" value="js/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
<!--
swfobject.registerObject("TxpDatabaseManager");
//-->
</script>
<div id="fxk_debug"></div>
</div>	
EOF;
	
	echo $html;
}

/**
 * I get all of the tables in the database
 *
 * @return [array] - A array ready for Flex
 */
function _getTables()
{
	//This is the textpattern config.php file. txpcfg holds the info in an assoc array;
	global $txpcfg;
	
	//Get the database name
	$dbDB = $txpcfg [ 'db' ];
	
	//Build the query
	$sql = 'SHOW TABLES FROM ' . $dbDB;
	
	//Get the results
	$query = getThings ( $sql );
	
	//Set up the result array
	$tables = array ();
	
	//Loop the results
	foreach ( $query as $key => $value )
	{
		//Set up a array for the fields
		$fields = array ();
		
		//For each table get the fields
		$fields = _describeTable ( $dbDB, $value );
		
		//and now each table, add the table name and the fields array
		$tables [] = array ( 
			'label' => $value, 'children' => $fields 
		);
	}
	
	//Return that shit
	return $tables;
}

/**
 * I describe a database table, I get information about the fields in the table.
 *
 * @param [string] $db - The database name from the txp configuration.
 * @param [string] $tbl - The table name that you want information about.
 * @return [array] An array containing the information.
 */
function _describeTable( $db, $tbl )
{
	$sql = 'SHOW FIELDS FROM ' . $db . '.' . $tbl;
	$results = getThings ( $sql );
	
	$fields = array ();
	//Loop the results from the getThings( sql ) method
	foreach ( $results as $key => $value )
	{
		//Add each field to the array
		$fields [] = array ( 
			'label' => $value 
		);
	}
	
	//Return that shit
	return $fields;
}

function _execute( $sql )
{
	$results = getThings ( $sql );
	
	return $results;
}

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

