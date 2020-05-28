<?php

$base_dir    = dirname(__FILE__);
$system_path = strtr(
    rtrim($base_dir, '/\\'),
    '/\\',
    DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
) . DIRECTORY_SEPARATOR;
define('ROOTPATH', $base_dir);
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

define('BASEPATH', ROOTPATH . '/core/system/');
define('APPPATH', ROOTPATH . '/app/');
define('VIEWPATH', ROOTPATH . '/app/views/');

if (file_exists(ROOTPATH . '/dd-config.php')) {
    require_once ROOTPATH . '/dd-config.php';
}

require_once BASEPATH . 'core/CodeIgniter.php';
