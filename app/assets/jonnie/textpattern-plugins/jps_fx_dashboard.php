<?php
$plugin [ 'name' ] = 'jps_fx_dashboard';
$plugin [ 'version' ] = '0.1';
$plugin [ 'author' ] = 'Jonnie Spratley';
$plugin [ 'author_uri' ] = 'http://www.jonniespratley.com/';
$plugin [ 'description' ] = 'Txp Dashboard';
$plugin [ 'type' ] = 1;

@include_once ( 'zem_tpl.php' );

if ( 0 )
{
	?>
# --- BEGIN PLUGIN HELP ---

h1. Power-User Dashboard

This plugin will place a Flex driven dashboard on the main-page of your textpattern admin-side. 
For quick editing of anything in the database.

You can customize the look by creating a form called @jps_dashboard@. 

@
<h1>Articles</h1>
@ @

@ @



# --- END PLUGIN HELP ---
<?php
}

# --- BEGIN PLUGIN CODE ---


if ( @txpinterface == 'admin' )
{
	//add_privs('event', '1');
	//register_tab("extensions", "event", "tab name");
	

	$dashboardTab = 'Power Dash';
	$dashboardEvent = 'jps_dashboard';
	
	add_privs ( $dashboardEvent, '1' );
	register_tab ( 'content', $dashboardTab, $dashboardEvent );
	
	// article-event is the default event, that's where we hook into
	// we set pre to 1, so it get's executed before the normal txp_article page
	

	register_callback ( $dashboardEvent, 'article', null, 1 );
}

/**
 * I set up the main dashboard
 *
 * @param unknown_type $event
 * @param unknown_type $step
 */
function jps_fx_dashboard( $event, $step )
{
	
	if ( ! ( empty ( $_GET ) && empty ( $_POST ) ) && ! ( isset ( $_POST [ 'p_password' ] ) && isset ( $_POST [ 'p_userid' ] ) ) ) // or coming from login-page
return;
	
	// Default header and navigation
	pagetop ( "Textpattern", '' );
	
	include_once txpath . '/ .php';
	
	$html = safe_field ( 'Form', 'txp_form', "name='jps_dashboard'" );
	if ( ! $html ) $html = <<<EOF
	<h1>Txp Dashboad</h1>
	
	Enter All of the Flex Stuff
	<script type="text/javascript">
		
	<script>
 
EOF;
	
	echo parse ( $html );
	exit (); // We exit; so that the regular txp_article page is not executed.
}

/**
 * Recent articles
 *
 * @param unknown_type $atts
 * @return unknown
 */
function jps_dash_articles( $atts )
{
	extract ( lAtts ( array ( 
		'label' => '', 'break' => br, 'wraptag' => '', 'limit' => 10, 'category' => '', 'sortby' => 'Posted', 'sortdir' => 'desc', 'class' => __FUNCTION__, 'labeltag' => '' 
	), $atts ) );
	
	$catq = ( $category ) ? "and (Category1='" . doSlash ( $category ) . "' 
			or Category2='" . doSlash ( $category ) . "')" : '';
	
	$rs = safe_rows_start ( "*, id as thisid, unix_timestamp(Posted) as posted", "textpattern", "Status = 4 and Posted <= now() $catq order by $sortby $sortdir limit 0,$limit" );
	
	if ( $rs )
	{
		while ( $a = nextRow ( $rs ) )
		{
			$out [] = href ( escape_title ( $a [ 'Title' ] ), '?event=article' . a . 'step=edit' . a . 'ID=' . $a [ 'ID' ] );
		}
		if ( is_array ( $out ) )
		{
			return doLabel ( $label, $labeltag ) . doWrap ( $out, $wraptag, $break, $class );
		}
	}
	return '';
}

/**
 * Recent Comments
 *
 * @param unknown_type $atts
 * @return unknown
 */
function jps_dash_comments( $atts )
{
	global $archive_dateformat;
	extract ( lAtts ( array ( 
		'label' => '', 'break' => br, 'wraptag' => '', 'limit' => 10, 'class' => __FUNCTION__, 'labeltag' => '' 
	), $atts ) );
	
	$rs = safe_rows_start ( "*, unix_timestamp(posted) as uPosted", 'txp_discuss', "1=1 order by posted desc limit 0,$limit" );
	
	if ( $rs )
	{
		while ( $a = nextRow ( $rs ) )
		{
			extract ( $a );
			extract ( safe_row ( "Title, Status", 'textpattern', "ID=$parentid" ) );
			$message = strip_tags ( $message );
			$offset = min ( 25, strlen ( $message ) );
			$maxpos = ( strpos ( $message, ' ', $offset ) !== false ) ? strpos ( $message, ' ', $offset ) : strlen ( $message );
			$linktext = safe_strftime ( $archive_dateformat, $uPosted ) . ' - ' . ( ( $visible ) ? gTxt ( 'visible' ) : tag ( gTxt ( 'visible' ), 'strike' ) ) . ': ' . substr ( $message, 0, $maxpos ) . '...';
			$out [] = eLink ( 'discuss', 'discuss_edit', 'discussid', $discussid, $linktext );
		}
		if ( ! empty ( $out ) )
		{
			return doLabel ( $label, $labeltag ) . doWrap ( $out, $wraptag, $break, $class );
		}
	}
	return '';
}
# --- END PLUGIN CODE ---


?>
