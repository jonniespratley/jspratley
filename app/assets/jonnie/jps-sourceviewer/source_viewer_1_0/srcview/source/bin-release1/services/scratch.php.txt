<?php

$file = '../untitled.as';

$contents = file_get_contents( $file );
echo '<pre>';
print_r( $contents );
echo '</pre>';



require 'FileSystemService.php';
$svc = new FileSystemService();
print_r( $svc->browseDirectory('../snippets') );



$siteURL = $_SERVER['SERVER_NAME'];
$scriptName = $_SERVER['SCRIPT_NAME'];

echo $siteURL;
echo '<br/>';
echo $scriptName;


?>