<a href="http://jonniespratley.com/wp-content/uploads/2009/05/jsontree.png"><img class="alignleft size-full wp-image-552" title="jsontree" src="http://jonniespratley.com/wp-content/uploads/2009/05/jsontree.png" alt="jsontree" width="278" height="165" /></a> Last night I noticed now Zend IDE has the Data Source Explorer set up like a tree of your database and tables, columns, keys, etc.



I thought that was pretty cool, so I decided to do the same thing.



But with my buddy JSON and his right hand man PHP, we will let Flex come and play with all of us.



This is going to move fast:



First method - Utility method for sending us an array from MySQL.

<pre class="brush: php;">

public function queryToJSON( $sql )

{

	$result = mysqli_query ( $this->mysqli, $sql );



	while ( $row = mysqli_fetch_assoc ( $result ) )

	{

		$array [] = $row;

	}

	return json_encode ( $array );

}</pre>



Next we are going to start from the bottom up, some of these methods are dummy methods and dont get any data. Because I havent wanted to yet. Triggers Folder

<pre class="brush: php;">

private function tree_tbl_getTriggers( $database, $table )

{

	//$triggerArray = $this->queryToARRAY ( "SHOW INDEX FROM $database.$table" );



	$triggerFolder = array ( 'label' => 'Triggers', 'children' => array ( $triggerArray ) );



	return $triggerFolder;

}</pre>



Index Folder:

<pre class="brush: php;">

private function tree_tbl_getIndexes( $database, $table )

{

	$sql = "SHOW INDEX FROM $database.$table";

	$query = mysqli_query ( $this->mysqli, $sql );



	$indexArray = array ();



	while ( $row = mysqli_fetch_row ( $query ) )

	{

		if ( $row [ 2 ] !== 'PRIMARY' )

		{

		     $indexArray [] = array (

                     'label' => $row [ 4 ] . "($row[2])" );

		}

	}



	$indexFolder = array ( 'label' => 'Indexes', 'children' => $indexArray );



	return $indexFolder;

}</pre>



Dependencies Folder:

<pre class="brush: php;">

private function tree_tbl_getDependcenies( $database, $table )

{

	$dependArray = array ( 'label' => 'admin table' );



	$dependFolder = array ( 'label' => 'Dependencies', 'children' => array ( $dependArray ) );



	return $dependFolder;

}</pre>



Constraints Folder:

<pre class="brush: php;">

private function tree_tbl_getConstraints( $database, $table )

{

	$sql = "SHOW INDEX FROM $database.$table";

	$result = mysqli_query ( $this->mysqli, $sql );

	$constraintArray = array ();



	while ( $constraint = mysqli_fetch_assoc ( $result ) )

	{

		if ( $constraint [ 'Key_name' ] == 'PRIMARY' )

		{

			$constraintArray = array ( 'label' => $constraint [ 'Key_name' ] );

		}

	}

	$constraintFolder = array ( 'label' => 'Constraints', 'children' => array ( $constraintArray ) );



	return $constraintFolder;

}</pre>



Columns Folder:

<pre class="brush: php;">

private function tree_tbl_getColumns( $database, $table )

{

	$sql = "SHOW FIELDS FROM $database.$table";

	$query = mysqli_query ( $this->mysqli, $sql );



	$columnsArray = array ();



	while ( $row = mysqli_fetch_row ( $query ) )

	{

		$type = strtoupper ( $row [ 1 ] );

		$null = '';

		if ( $row [ 2 ] == 'YES' )

		{

			$null = 'Nullable';

		}

		$type = '[' . $type . ' ' . $null . ']';

		$columnsArray [] = array ( 'label' => $row [ 0 ] . ' ' . $type );

	}

	$columnsFolder = array ( 'label' => 'Columns', 'children' => $columnsArray );



	return $columnsFolder;

}</pre>



Some dummy methods I haven't finished yet.



Dependencies, Stored Procedures, User Functions, Authorizations, etc. Folders:

<pre class="brush: php;">

private function tree_db_getDependcenies( $database )

{

	$dependceniesArray = array ( 'label' => 'Dependcencies', 'children' => array ( 'label' => 'test' ) );



	return $dependceniesArray;

}

private function tree_db_getStoredProcs( $database )

{

	$storedProcsArray = array ( 'label' => 'Stored Procedures', 'children' => array ( 'label' => 'test' ) );



	return $storedProcsArray;

}

private function tree_db_getUserFunctions( $database )

{



}

private function tree_db_getAuthorizations()

{

	$authorizationsArray = array ( 'label' => 'Authorization IDs', 'children' => array ( 'label' => 'rfd' ) );



	return $authorizationsArray;

}

private function tree_db_getViews( $database )

{



}</pre>



Tables Folder:

<pre class="brush: php;">

private function tree_db_getTables( $database )

{

	//table query

	$tableSQL = mysqli_query ( $this->mysqli, "SHOW TABLES FROM $database" );



	//create a new array of tables

	$tables = array ();



	//loop all the results

	while ( $table = mysqli_fetch_assoc ( $tableSQL ) )

	{

		$columns = array ();

		$statuss = array ();

		$indexes = array ();



		//for each table in the result make an array

		foreach ( $table as $t_key => $t_value )

		{

			//get the tables fields for each table

			$columns = $this->tree_tbl_getColumns ( $database, $t_value );



			//now get the primary key for each table

			$constraints = $this->tree_tbl_getConstraints ( $database, $t_value );



			//now get the indexes for each table

			$indexes = $this->tree_tbl_getIndexes ( $database, $t_value );



			//now get the dependencys for each table

			$dependicy = $this->tree_tbl_getDependcenies ( $database, $t_value );



			//now get the triggers for each table

			$triggers = $this->tree_tbl_getTriggers ( $database, $t_value );



		}

		$columnArr = $columns;

		$constraintArr = $constraints;

		$indexArr = $indexes;

		$dependencyArr = $dependicy;

		$triggerArr = $triggers;

		$tables [] = array ( 'label' => $t_value, "type" => "table", "icon" => "table", 'children' => array ( $columnArr, $constraintArr, $indexArr, $dependencyArr, $triggerArr ) );

	}



	$tableFolder [] = array ( 'label' => 'Tables', 'children' => $tables );



	return $tableFolder;

}</pre>

Database Folder:

<pre class="brush: php;">

public function tree_getSchemas()

{

	//Database query

	$databaseSQL = $this->realQuery ( "SHOW DATABASES" );



	//New database array

	$databases = array ();



	//Loop the query

	while ( $database = mysqli_fetch_assoc ( $databaseSQL ) )

	{

		//Create a new array of tables for each database

		$tables = array ();

		//$status = array ();

		//$size = array ();

		foreach ( $database as $key => $value )

		{

			//Set the table array to get the tbles from the database

			$tables = $this->tree_db_getTables ( $value );

			//$status = $this->_getTableStatus ( $value );

		//$size = $this->_getDatabaseSize ( $value );

		}



		//Add the tables to the database array

		$databases [] = array ( "label" => $value, "data" => $key, "type" => "database", "icon" => "database", "children" => $tables );

	}



	$databaseFolder [] = array ( 'label' => 'Schemas', 'children' => $databases );



	return $databaseFolder;

}</pre>



Host Folder:

<pre class="brush: php;">

public function tree_getTree()

{

	$mysqlVersion = mysqli_get_client_info ( $this->mysqli );

	$host = $_SERVER [ 'HTTP_HOST' ] . " (MySQL v. $mysqlVersion )";



	$hostArray = array ( 'label' => $host, 'type' => 'server', 'children' => $this->tree_getSchemas () );

	$treeArray [] = array ( 'label' => 'SQL Databases', 'type' => 'servers', 'children' => $hostArray );



	return $treeArray;

}</pre>



And here is the finished version



<a href="http://flex.jonniespratley.com/JSONTree/output.json" target="_blank">JSON for this demo.</a>



[SWF]http://jonniespratley.com/wp-content/uploads/2009/02/jsontree.swf", 500, 450[/SWF]

<p style="text-align: left;">

<a href="[download#6#format=1]">Source Code Here</a></p>