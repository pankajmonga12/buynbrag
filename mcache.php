<?php
// Connection constants
define('MEMCACHED_HOST', '54.251.99.100');
define('MEMCACHED_PORT', '11211');
 
// Connection creation
$memcache = new Memcache;
$cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);
echo "<p> result = ". json_encode(array("cacheAvailable" => $cacheAvailable), JSON_FORCE_OBJECT);
?>
