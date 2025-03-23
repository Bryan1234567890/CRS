<?php

$protocol = $_SERVER['REQUEST_SCHEME'] . '://';
$host = $_SERVER['SERVER_NAME'];
date_default_timezone_set('Asia/manila');

// NMI API configuration
define('NMI_API', 'https://secure.nmi.com/api/transact.php');
define('NMI_SECURITY_KEY', '8CTN9nB9m4Wp2MgDhfMJ74wnjAmVEj34');


define('DB_TYPE', 'mysql');
define('DB_HOST', '192.96.216.94');
define('DB_USER', 'bryan_usr');
define('DB_PASS', 'J0c3hGisq6');
define('DB_NAME', 'bryan_ic4c');


define('CURRENTDATE', date('Y-m-d H:i:s'));
define('PAGE_TITLE', 'iCAN for Consumers');

/*- UAT -*/
// define('URL', 'https://uat.ican4consumers.com/');
define('URL', 'http://localhost/CRS/');
// define('URL', 'https://demo.ican4consumer.com/ctc');

/*- local -*/
// define('URL', 'http://ican4consumers.test/');

define('BASE_PATH', URL);
define('JS_PATH', URL.'public/js/');
define('CSS_PATH', URL. 'public/styles/css/');
define('STYLE_JS_PATH',  URL. 'public/styles/js/');
define('ASSETS_PATH',  URL.'public/assets/');
define('IMG_PATH',  URL.'public/img/');
define('VIDEO_PATH',  URL.'public/videos/');

// AUTHNET
define('AUTHNET_ENDPOINT', 'https://apitest.authorize.net/xml/v1/request.api');
