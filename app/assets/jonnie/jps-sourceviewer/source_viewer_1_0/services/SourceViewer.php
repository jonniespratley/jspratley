<?php
require_once 'FileSystemService.php';
$fileSvc = new FileSystemService();
$dir = '';
$mode = '';
$file = '';
$list = '';
if ( isset ( $_GET[ 'm' ] ) )
{
	$mode = $_GET['m'];
}


if ( isset ( $_GET[ 'd' ] ) )
{
	$dir = $_GET['d'];
}

if ( isset ( $_GET[ 'f' ] ) )
{
	$file = $_GET['f'];
}

if ( isset ( $_GET[ 'l' ] ) )
{
	$list = $_GET['l'];
}

switch ( $mode )
{
	
	case 'getDirectory' :
		$directory = $fileSvc->browseDirectory( $dir, $list, true );
		echo  $directory;
	break;
	
	case 'readFile' :
		$ignore = array ( 'swf', 'fla', 'zip', 'ai', 'swc', 'psd');
		$ext = substr( strrchr( $file, '.' ), 1 );
		if ( ! in_array ( $ext, $ignore ) )
		{
			$file = $fileSvc->readFile( $file );
			
			print_r( $file );
			
		} else {
			
			echo 'Download the File to View';
		}
	break;

	case 'downloadFile':
		echo $file;
	break;
	
	default:
		echo json_encode( array( 'message' => 'Please choose a mode.' ) );
	exit ();
}
?>