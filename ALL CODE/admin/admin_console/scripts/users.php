<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'users';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'fname', 'dt' => 0),
	array( 'db' => 'lname',  'dt' => 1),
	array( 'db' => 'username',   'dt' => 2),
	array( 'db' => 'access_id',   'dt' => 3)
);

// SQL server connection information
$sql_details = array(
	'user' => 'sarwebsite',
	'pass' => '3@jDlb89g4d4*As7',
	'db'   => 'sarwebsite',
	'host' => '10.9.9.19:3306'
);


define('DB_SERVER', '10.9.9.19:3306');
define('DB_USERNAME', 'sarwebsite');
define('DB_PASSWORD', '3@jDlb89g4d4*As7');
define('DB_NAME', 'sarwebsite');


require( 'ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);