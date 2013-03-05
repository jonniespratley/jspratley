<?php
$plugin [ 'name' ] = 'jps_event_calendar';
$plugin [ 'version' ] = '0.2';
$plugin [ 'author' ] = 'Jonnie Spratley';
$plugin [ 'author_uri' ] = 'http://jonniespratley.com';
$plugin [ 'description' ] = 'Event calendar for Textpattern';
$plugin [ 'order' ] = '5';
$plugin [ 'type' ] = '1';

if ( ! defined ( 'txpinterface' ) ) @include_once ( 'zem_tpl.php' );

# --- BEGIN PLUGIN CODE ---
if ( @txpinterface == 'admin' )
{
	
	/** =======================================
	 * Event Calendar Tab/Callback/Privs/Event
	 * =======================================*/
	
	//Tabs
	$jpsEventCalendarTab = 'Event Calendar';
	
	//AdminEvents
	$jpsEventCalendarAdminEvent = 'jps_event_calendar_admin';
	$jpsEventCalendarServiceEvent = 'jps_event_service';
	
	/** ========================================
	 * Internal Callback Vars
	 *========================================*/
	
	//Create
	$jpsCreateEventEvent = 'jps_create_event';
	$jpsCreateCalendarEvent = 'jps_create_calendar';
	
	//Update
	$jpsUpdateEventEvent = 'jps_update_event';
	$jpsUpdateCalendarEvent = 'jps_update_calendar';
	
	//Remove
	$jpsRemoveEventEvent = 'jps_remove_event';
	$jpsRemoveCalendarEvent = 'jps_remove_calendar';
	
	//Get
	$jpsGetEventEvent = 'jps_get_event';
	$jpsGetCalendarEvent = 'jps_get_calendar';
	
	/** ========================================
	 * Privs
	 *========================================*/
	
	//Admin
	add_privs ( $jpsEventCalendarAdminEvent, '1' );
	
	//Create
	add_privs ( $jpsCreateEventEvent, '1' );
	add_privs ( $jpsCreateCalendarEvent, '1' );
	
	//Update
	add_privs ( $jpsUpdateEventEvent, '1' );
	add_privs ( $jpsUpdateCalendarEvent, '1' );
	
	//Remove
	add_privs ( $jpsRemoveEventEvent, '1' );
	add_privs ( $jpsRemoveCalendarEvent, '1' );
	
	//Get
	add_privs ( $jpsGetEventEvent, '1' );
	add_privs ( $jpsGetCalendarEvent, '1' );
	
	//Service
	add_privs ( $jpsEventCalendarServiceEvent, '1,2,3,4,5,6' );
	
	/** ========================================
	 * Build Tabs
	 *========================================*/
	register_tab ( 'content', $jpsEventCalendarAdminEvent, $jpsEventCalendarTab );
	
	/**========================================
	 * Register Callbacks
	 *========================================*/
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent );
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsEventCalendarServiceEvent, 0 );
	
	//Save
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsCreateEventEvent, 0 );
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsCreateCalendarEvent, 0 );
	
	//Update
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsUpdateEventEvent, 0 );
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsUpdateCalendarEvent, 0 );
	
	//Remove
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsRemoveEventEvent, 0 );
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsRemoveCalendarEvent, 0 );
	
	//Get
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsGetEventEvent, 0 );
	register_callback ( $jpsEventCalendarAdminEvent, $jpsEventCalendarAdminEvent, $jpsGetCalendarEvent, 0 );

} //ends @txpinterface == admin


/**
 * This is all of the admin Fuctions
 *
 */

function jps_event_calendar_admin( $event, $step )
{
	if ( $step == 'jps_event_service' )
	{
		jps_event_service ( $step );
	}
	else
	{
		jps_event_calendar_build_admin_page ();
	}
}

function jps_event_service()
{
	$mode = '';
	
	switch ( $_SERVER [ 'REQUEST_METHOD' ] )
	{
		case 'GET':
			
			if ( isset ( $_GET [ 'm' ] ) )
			{
				$mode = $_GET [ 'm' ];
			}
			switch ( $mode )
			{
				case 'getEvents':
					echo jps_event_calendar_get ( '*', 'txp_events', 'json' );
					break; //ends getEvents
			}
			exit ();
			break; //ends GET
		

		case 'POST':
			
			if ( isset ( $_POST [ 'm' ] ) )
			{
				$mode = $_POST [ 'm' ];
			}
			switch ( $mode )
			{
				
				case 'createEvent':
					jps_save_event ( $_POST );
					break; //ends saveEvent
				

				case 'createCalendar':
					jps_save_calendar ( $_POST );
					break; //ends saveCalendar
				

				case 'updateEvent':
					jps_update_event ( $_POST );
					break; //ends saveEvent
				

				case 'updateCalendar':
					jps_update_calendar ( $_POST );
					break; //ends saveCalendar
				

				case 'removeEvent':
					jps_remove_event ( $_POST );
					break; //ends removeEvent
				

				case 'removeCalendar':
					jps_remove_calendar ( $_POST );
					break; //ends removeCalendar
			}
			
			break; //ends POST
	}
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
function jps_event_calendar_get( $shit, $table, $format = '' )
{
	$rows = safe_rows_start ( $shit, $table, '1=1' );
	
	$results = array ();
	
	//If it happened
	if ( $rows )
	{
		//loop it
		while ( $row = nextRow ( $rows ) )
		{
			$results [] = $row;
		}
		if ( $format == 'json' )
		{
			return json_encode ( $results );
		}
		else
		{
			return $results;
		}
	}
	return false;
}

function jps_event_calendar_build_admin_page()
{
	pagetop ( 'Textpattern - Event Calendar', '' );
	
	$calendars = jps_event_calendar_get ( '*', 'txp_calendars', '' );
	$options = '';
	$calendarList = '';
	
	foreach ( $calendars as $calendar )
	{
		$options .= '<option value="' . $calendar [ "id" ] . '">' . $calendar [ "name" ] . '</option>';
		$calendarList .= '<li>' . $calendar [ "name" ] . '</li>';
	}
	
	$ui = <<<EOF
<!-- CSS -->
<link href="assets/jps_event_calendar/css/jps_event_manager.css" rel="stylesheet" />
<link href="assets/jps_event_calendar/css/jquery.ui.css" rel="stylesheet" />

<!-- JS -->
<script src="assets/jps_event_calendar/js/jquery.js" type="text/javascript"></script>
<script src="assets/jps_event_calendar/js/jquery.ui.js" type="text/javascript" ></script>
<script src="assets/jps_event_calendar/js/jquery.highlight.js" type="text/javascript"></script>
<script src="assets/jps_event_calendar/js/jquery.fullcalendar.js" type="text/javascript" ></script>
<script src="assets/jps_event_calendar/js/jps_event_calendar.js" type="text/javascript"></script>

<div id="jps-calendar">
	<div id="jps-calendar-manager-top">
		<h1>Event Calendar</h1>
		<p>This is your event calendar</p>
		<span id="jps-calendar-loading" style="display: none;"><img src="css/images/loader_1.gif"/></span>
	</div><!-- /jps_event_manager_top -->

	<div id="jps-cal-dialog">

	<div class="jps_calendar">
<form class="form" id="jps_calendar_form" method="" action="" onsubmit="return false;">

<div class="hide">
	<h2>New Event</h2>
	<p>Please enter the event details and information in the fields provided.</p>
</div>

<ul>
		<li>
		<label for="txt_jps_cal_calendars" class="description">Calendar </label>
		<div>
		<select name="txt_jps_cal_calendar" id="txt_jps_cal_calendars" class="element select large">
			<option selected="selected" value=""/>
			$options
		</select>
		</div>
		</li>

		<li>
		<label for="txt_jps_cal_title" class="description">Event </label>
		<div>
			<input type="text" value="" maxlength="255" class="element text large" name="txt_jps_cal_title" id="txt_jps_cal_title"/>
		</div>
		</li>

		<li>
		<label for="txt_jps_cal_body" class="description">Summary </label>
		<div>
			<textarea class="element textarea medium" name="txt_jps_cal_body" id="txt_jps_cal_body"></textarea>
		</div>
		</li>

		<li>
		<label for="txt_jps_cal_startdate" class="description">Start Date </label>
		<span>
			<input type="text" value="" maxlength="2" size="2" class="element text" name="txt_jps_cal_startdatem" id="txt_jps_cal_startdatem"/> /
			<label for="txt_jps_cal_startdatem">MM</label>
		</span>
		<span>
			<input type="text" value="" maxlength="2" size="2" class="element text" name="txt_jps_cal_startdated" id="txt_jps_cal_startdated"/> /
			<label for="txt_jps_cal_startdated">DD</label>
		</span>
		<span>
	 		<input type="text" value="" maxlength="4" size="4" class="element text" name="txt_jps_cal_startdatey" id="txt_jps_cal_startdatey"/>
			<label for="txt_jps_cal_startdatey">YYYY</label>
		</span>
		</li>

		<li class="hide">
		<label for="txt_jps_cal_starttime" class="description">Start Time </label>
		<span>
			<input type="text" value="00" maxlength="2" size="2" class="element text" name="txt_jps_cal_starttimeh" id="txt_jps_cal_starttimeh"/> :
			<label>HH</label>
		</span>
		<span>
			<input type="text" value="00" maxlength="2" size="2" class="element text" name="txt_jps_cal_starttimem" id="txt_jps_cal_starttimem"/> :
			<label>MM</label>
		</span>
		<span>
			<input type="text" value="00" maxlength="2" size="2" class="element text" name="txt_jps_cal_starttimes" id="txt_jps_cal_starttimes"/>
			<label>SS</label>
		</span>
		<span>
			<select name="txt_jps_cal_starttimeampm" id="txt_jps_cal_starttimeampm" style="width: 4em;" class="element select">
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select>
			<label>AM/PM</label>
		</span>
		</li>

		<li>
		<label for="txt_jps_cal_enddate" class="description">End Date </label>
		<span>
			<input type="text" value="" maxlength="2" size="2" class="element text" name="txt_jps_cal_enddatem" id="txt_jps_cal_enddatem"/> /
			<label for="txt_jps_cal_enddatem">MM</label>
		</span>
		<span>
			<input type="text" value="" maxlength="2" size="2" class="element text" name="txt_jps_cal_enddated" id="txt_jps_cal_enddated"/> /
			<label for="txt_jps_cal_enddated">DD</label>
		</span>
		<span>
	 		<input type="text" value="" maxlength="4" size="4" class="element text" name="txt_jps_cal_enddatey" id="txt_jps_cal_enddatey"/>
			<label for="txt_jps_cal_enddatey">YYYY</label>
		</span>
		</li>

		<li class="hide">
		<label for="txt_jps_cal_endtime" class="description">End Time</label>
		<span>
			<input type="text" value="00" maxlength="2" size="2" class="element text" name="txt_jps_cal_endtimeh" id="txt_jps_cal_endtimeh"/> :
			<label>HH</label>
		</span>
		<span>
			<input type="text" value="00" maxlength="2" size="2" class="element text" name="txt_jps_cal_endtimem" id="txt_jps_cal_endtimem"/> :
			<label>MM</label>
		</span>
		<span>
			<input type="text" value="00" maxlength="2" size="2" class="element text" name="txt_jps_cal_endtimes" id="txt_jps_cal_endtimes"/>
			<label>SS</label>
		</span>
		<span>
			<select name="txt_jps_cal_endtimeampm" id="txt_jps_cal_endtimeampm" style="width: 4em;" class="element select">
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select>
			<label>AM/PM</label>
		</span>
		</li>

		<li>
		<label for="txt_jps_cal_privacy" class="description">Privacy </label>
		<span>
			<input type="radio" value="0" class="element radio" name="txt_jps_cal_privacy_0" id="txt_jps_cal_privacy_0"/>
			<label for="txt_jps_cal_privacy_0" class="choice">Public</label>
			<input type="radio" value="1" class="element radio" name="txt_jps_cal_privacy_1" id="txt_jps_cal_privacy_1"/>
			<label for="txt_jps_cal_privacy_1" class="choice">Private</label>
		</span>
		</li>

		<div id="jps_cal_opt_wrap" class="form_description">
			<h2>Event Options<span><img id="txt_jps_cal_btn_add" src="assets/jps_event_calendar/css/icons/ui-toolbar--plus.png" width="16" height="16" alt="Add" class="jps-button"></span></h2>
			<p>If you have any other options that you would like be displayed with this event, just add as many name/value options.</p>
		</div>

		<li class="buttons">
			<input type="hidden" value="0" name="txt_jps_cal_id" id="txt_jps_cal_id"/>
			<input type="hidden" value="0" name="txt_jps_cal_opt_count" id="txt_jps_cal_opt_count"/>
			<input type="hidden" name="txt_jps_cal_mode" id="txt_jps_cal_mode" value="createEvent"/>
		</li>
	</ul>
</form>
</div>

</div><!-- /jps-cal-dialog -->


	<div id="jps-cal-tabs">
		<ul>
			<li><a href="#jps-cal-tabs-1">Calendar</a></li>
			<li><a href="#jps-cal-tabs-2">Events</a></li>
			<li><a href="#jps-cal-tabs-3">Options</a></li>
		</ul>
		<div id="jps-cal-tabs-1"><div id="jps-cal-calendar"></div></div>
		<div id="jps-cal-tabs-2"></div>
		<div id="jps-cal-tabs-3"></div>
	</div><!--/jps-cal-tabs-->

</div><!--/jps-calendar-->

EOF;
	
	echo $ui;
}

function jps_save_event( $postData )
{
	$insertSet = '';
	foreach ( $postData as $postKey => $postData )
	{
		$insertSet .= $postKey . '=' . '"' . $postData . '"';
	}
	echo $insertSet;
	//return safe_insert ( 'txp_events', $insertSet );
}
function jps_save_calendar( $postData )
{
	$insertSet = '';
	foreach ( $postData as $postKey => $postData )
	{
		$insertSet .= $postKey . '=' . '"' . $postData . '"';
	}
	echo $insertSet;
	//return safe_insert ( 'txp_events', $insertSet );
}
function jps_remove_event( $postData )
{
	$insertSet = '';
	foreach ( $postData as $postKey => $postData )
	{
		$insertSet .= $postKey . '=' . '"' . $postData . '"';
	}
	echo $insertSet;
	//return safe_insert ( 'txp_events', $insertSet );
}
function jps_remove_calendar( $postData )
{
	$insertSet = '';
	foreach ( $postData as $postKey => $postData )
	{
		$insertSet .= $postKey . '=' . '"' . $postData . '"';
	}
	echo $insertSet;
	//return safe_insert ( 'txp_events', $insertSet );
}
function jps_update_event( $postData )
{
	$insertSet = '';
	foreach ( $postData as $postKey => $postData )
	{
		$insertSet .= $postKey . '=' . '"' . $postData . '"';
	}
	echo $insertSet;
	//return safe_insert ( 'txp_events', $insertSet );
}

function jps_update_calendar( $postData )
{
	$insertSet = '';
	foreach ( $postData as $postKey => $postData )
	{
		$insertSet .= $postKey . '=' . '"' . $postData . '"';
	}
	echo $insertSet;
	//return safe_insert ( 'txp_events', $insertSet );
}

/**=========================================================
 * 
 * Public Functions
 * 
 * 1. Build Header
 * 2. Build Calendar
 * 3. Handlers
 *
 * 
 */

function jps_event_calendar( $atts )
{
	global $prefs;
	$siteURL = 'http://' . $prefs [ 'siteurl' ] . '/textpattern/';
	
	extract ( lAtts ( array ( 
		'calendar' => '', 'section' => '', 'details' => '', 'class' => '' 
	), $atts ) );
	
	$events = jps_event_calendar_get ( '*', 'txp_events', 'json' );
	
	$js = '
<link href="' . $siteURL . 'assets/jps_event_calendar/css/jps_event_manager.css" rel="stylesheet" />
<link href="' . $siteURL . 'assets/jps_event_calendar/css/jquery.ui.css" rel="stylesheet" />

<script src="' . $siteURL . 'assets/jps_event_calendar/js/jquery.js" type="text/javascript"></script>
<script src="' . $siteURL . 'assets/jps_event_calendar/js/jquery.ui.js" type="text/javascript" ></script>
<script src="' . $siteURL . 'assets/jps_event_calendar/js/jquery.fullcalendar.js" type="text/javascript" ></script>';
	$ui = '
<script type="text/javascript">
$(function()
{
    var serviceURL = window.location;
    $("#jps-cal-calendar-public").fullCalendar(
    {
        draggable: false,
        events: ' . $events . ',
        loading: function(bool)
        {
            if (bool) 
            {
                $("#jps-calendar-loading").show();
            }
            else 
            {
                $("#jps-calendar-loading").hide();
            }
        },
        eventClick: function(calEvt, jsevt)
        { 
            return false;
        }
    });
});	 
</script>
<div id="jps-cal-calendar-public"></div>		
';
	
	$page = $js . $ui;
	
	return $page;
}

/**
 * Txp Tags are going to be 
 * 
 * txp:jps_event_details
 * txp:jps_event_title
 * txp:jps_event_body
 * txp:jps_event_start
 * txp:jps_event_end
 * txp:jps_event_options
 * 
 * 
 */
function jps_event_details( $atts )
{
	extract ( lAtts ( array ( 
		'wrap' => 'div', 'class' => 'jps-event-details', 'titleWrap' => 'h2', 'bodyWrap' => 'p', 'startWrap' => 'i', 'endWrap' => 'i', 'optionsWrap' => 'div' 
	), $atts ) );
	
	$title = tag ( 'j', $titleWrap, ' id="jps-event-title"' );
	$body = tag ( 'j', $bodyWrap, ' id="jps-event-body"' );
	$start = tag ( 'j', $startWrap, ' id="jps-event-start"' );
	$end = tag ( 'j', $endWrap, ' id="jps-event-end"' );
	$options = tag ( 'j', $optionsWrap, ' id="jps-event-options"' );
	
	$eventDetails = '<div id="jps-event-details" style="display:none;">';
	$eventDetails .= $title;
	$eventDetails .= $body;
	$eventDetails .= $start;
	$eventDetails .= $end;
	$eventDetails .= $options;
	$eventDetails .= '</div>';
	
	return $eventDetails;
}

# --- END PLUGIN CODE ---
if ( 0 )
{
	?>
<!--
# --- BEGIN PLUGIN HELP ---
<h2>Install</h2>
Enable the plugin and ready to use.
# --- END PLUGIN HELP ---
-->
<?php
}
?>