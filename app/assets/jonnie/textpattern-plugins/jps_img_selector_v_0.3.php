<?php
$plugin [ 'name' ] = 'jps_img_selector';
$plugin [ 'version' ] = '0.3';
$plugin [ 'author' ] = 'Jonnie Spratley';
$plugin [ 'author_uri' ] = 'http://jonniespratley.com';
$plugin [ 'description' ] = 'Image Selector on Write Tab';
$plugin [ 'order' ] = '5';
$plugin [ 'type' ] = '3';

if ( ! defined ( 'txpinterface' ) ) @include_once ( 'zem_tpl.php' );

# --- BEGIN PLUGIN CODE ---
if ( @txpinterface == 'admin' )

{

	$jpsImageEvent = 'jps_img_selector';
	add_privs ( $jpsImageEvent, '1' );
	register_callback ( $jpsImageEvent, "article" );
}

function jps_img_selector_get( $shit, $table, $format = '' )
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

function jps_img_selector( $event, $step )
{

	/* ==================================================
	 *  Get the settings and URL for the image
	 * ================================================== */
	global $txpcfg, $prefs;
	$prefix = $txpcfg [ 'table_prefix' ];
	$imageDir = 'http://' . $prefs [ 'siteurl' ] . '/' . $prefs [ 'img_dir' ] . '/';

	/* ==================================================
	 *  Build The Query & Execute it
	 * ================================================== */
	$table = $prefix . 'txp_image';
	$imageArray = jps_img_selector_get ( '*', $table, '' );

	/** ==================================================
	 *  Loop the query The Query, adding a option to the list
	 * ================================================== */

	$imageSelectOptions = '<option value="0">None</option>';

	foreach ( $imageArray as $image )
	{
		$imageSelectOptions .= '<option value="http://' . $prefs [ 'siteurl' ] . '/' . $prefs [ 'img_dir' ] . '/' . $image [ "id" ] . $image [ "ext" ] . '">' . $image [ "name" ] . '</option>';
	}

	/** ==================================================
	 *  Finish up the select list
	 * ================================================== */
	$imageSelectTop = '<div id="jps_img_box"><select class="select" name="Image" id="jps_img_select">';
	$imageSelectBottom = $imageSelectOptions;
	$imageSelectBottom .= '</select><div id="jps_img_holder"><img id="jps_img_thumb" alt="Image Thumb" width="150" height="135" style="display:none;"/></div></div>';
	$imageSelectBox = $imageSelectTop . $imageSelectBottom;

	/** ==================================================
	 *  Build the javascript for the page
	 * ================================================== */

	$js = <<<EOF
<script type="text/javascript">
$(function(){
var imageWrap = '$imageSelectBox';
$("#article-image").replaceWith(imageWrap);
$("#jps_img_select").change(function(){
    var imgText = $('#jps_img_select :selected').text();
    var imgSrc = $('#jps_img_select :selected').val();
    $("#jps_img_thumb").attr('src', imgSrc).show('slow');
    $("#article-image").val(imgText);
});


});
</script>
EOF;

	/** ==================================================
	 *  Poop it out
	 * ================================================== */
	echo $js;

}
# --- END PLUGIN CODE ---
if ( 0 )
{
	?>
<!--
# --- BEGIN PLUGIN HELP ---

# --- END PLUGIN HELP ---
-->
<?php
}
?>