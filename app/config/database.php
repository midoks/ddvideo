<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group  = 'default';
$query_builder = TRUE;

defined('DD_DB_HOST') or define('DD_DB_HOST', 'localhost');
defined('DD_DB_USER') or define('DD_DB_USER', 'root');
defined('DD_DB_PASSWORD') or define('DD_DB_PASSWORD', 'roos');
defined('DD_DB_NAME') or define('DD_DB_NAME', 'ddvideo');
defined('DD_DB_PREFIX') or define('DD_DB_PREFIX', 'dd_');

$db['default'] = array(
    'dsn'          => '',
    'hostname'     => DD_DB_HOST,
    'username'     => DD_DB_USER,
    'password'     => DD_DB_PASSWORD,
    'database'     => DD_DB_NAME,
    'dbdriver'     => 'mysqli',
    'dbprefix'     => DD_DB_PREFIX,
    'pconnect'     => FALSE,
    'db_debug'     => (ENVIRONMENT !== 'production'),
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => FALSE,
    'compress'     => FALSE,
    'stricton'     => FALSE,
    'failover'     => array(),
    'save_queries' => TRUE,
);
