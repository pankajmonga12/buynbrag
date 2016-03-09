<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'test';
// $active_group = ( ( ( strpos($_SERVER['SERVER_NAME'], 'dev.buynbrag.com') ) === FALSE )? 'default': 'test' );
$isCliRequest = ( php_sapi_name() === 'cli' OR defined('STDIN') );
$serverName = $isCliRequest ? 'buyandbrag.in': $_SERVER["HTTP_HOST"];
$active_group = ( ( (strcmp($serverName, 'buynbrag.com')  === 0) || (strcmp($serverName, 'buyandbrag.in')  === 0) || ( strcmp($serverName, 'www.buynbrag.com') === 0 ) || ( strcmp($serverName, 'www.buyandbrag.in') === 0 ) )? 'default': 'test' );
$active_record = TRUE;

/* =========================================DB SERVERS======================================== */
/* =========================================   LOCAL  ======================================== */
$db['localhost']['hostname'] = 'localhost';
$db['localhost']['username'] = 'root';
$db['localhost']['password'] = '';

$db['localhost']['database'] = 'bnbdb';
$db['localhost']['dbdriver'] = 'mysqli';
$db['localhost']['dbprefix'] = '';
$db['localhost']['pconnect'] = TRUE;
$db['localhost']['db_debug'] = TRUE;
$db['localhost']['cache_on'] = FALSE;
$db['localhost']['cachedir'] = '';
$db['localhost']['char_set'] = 'utf8';
$db['localhost']['dbcollat'] = 'utf8_general_ci';
$db['localhost']['swap_pre'] = '';
$db['localhost']['autoinit'] = TRUE;
$db['localhost']['stricton'] = FALSE;
/* =========================================   TEST   ======================================== */
$db['test']['hostname'] = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com';
$db['test']['hostname'] = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com'; // old db endpoint
$db['test']['hostname'] = 'bnbdb.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com'; // new endpoint
$db['test']['username'] = 'bnbuser';
$db['test']['password'] = '34d04b8745abd3ef7ea88d9ac0637e64';

$db['test']['database'] = 'bnbdbTest';
$db['test']['dbdriver'] = 'mysqli';
$db['test']['dbprefix'] = '';
$db['test']['pconnect'] = TRUE;
$db['test']['db_debug'] = TRUE;
$db['test']['cache_on'] = FALSE;
$db['test']['cachedir'] = '';
$db['test']['char_set'] = 'utf8';
$db['test']['dbcollat'] = 'utf8_general_ci';
$db['test']['swap_pre'] = '';
$db['test']['autoinit'] = TRUE;
$db['test']['stricton'] = FALSE;
/* =========================================   LIVE   ======================================== */
$db['default']['hostname'] = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com';/*'myolddb.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com';*/
$db['default']['hostname'] = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com'; // old db endpoint
$db['default']['hostname'] = 'bnbdb.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com'; // new endpoint
$db['default']['username'] = 'bnbuser';
$db['default']['password'] = '34d04b8745abd3ef7ea88d9ac0637e64'; /*'1234567890';*/ /*'01120938fhewi8943yskdj';*/ /*'79875698$#!$#_$^%*&^';*/

$db['default']['database'] = 'bnbdb';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
/* =========================================================================================== */

/* End of file database.php */
/* Location: ./application/config/database.php */
