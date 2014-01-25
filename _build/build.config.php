<?php

/* define package */
define('PKG_NAME','yTranslit');
define('PKG_NAME_LOWER',strtolower(PKG_NAME));
define('PKG_VERSION','1.1.1');
define('PKG_RELEASE','pl');
define('PKG_AUTO_INSTALL', true);


if (is_file(dirname(dirname(dirname(__FILE__))) . '/index.php' )) {
	define('MODX_BASE_PATH', dirname(dirname(dirname(__FILE__))) . '/');
}
else {
	define('MODX_BASE_PATH', dirname(dirname(dirname(dirname(__FILE__)))) . '/');
}
define('MODX_CORE_PATH', MODX_BASE_PATH . 'core/');
define('MODX_MANAGER_PATH', MODX_BASE_PATH . 'manager/');
define('MODX_CONNECTORS_PATH', MODX_BASE_PATH . 'connectors/');
define('MODX_ASSETS_PATH', MODX_BASE_PATH . 'assets/');

define('MODX_BASE_URL','/');
define('MODX_CORE_URL', MODX_BASE_URL . 'core/');
define('MODX_MANAGER_URL', MODX_BASE_URL . 'manager/');
define('MODX_CONNECTORS_URL', MODX_BASE_URL . 'connectors/');
define('MODX_ASSETS_URL', MODX_BASE_URL . 'assets/');

/* define build options */
define('BUILD_SETTING_UPDATE', false);