<?php

$protocol = $_SERVER['REQUEST_SCHEME'] . '://';
$host = $_SERVER['SERVER_NAME'];
date_default_timezone_set('Asia/manila');

// NMI API configuration
define('NMI_API', 'https://secure.nmi.com/api/transact.php');
define('NMI_SECURITY_KEY', '8CTN9nB9m4Wp2MgDhfMJ74wnjAmVEj34');

