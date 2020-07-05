<?php
require_once "functions.php";
#require_once "../requires/db_config.php";
require_once 'Mobile-Detect-2.8.34/Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$os = ($detect->isAndroidOS() ? 'Android': ($detect->isIOS() ? 'IOS': 'other'));
$browser = ($detect->isChrome() ? 'Chrome': ($detect->isFirefox() ? 'Firefox': ($detect->isOpera() ? 'Opera':($detect->isSafari() ? 'Safari':"other"))));
$country = getCountryByIp(getIpAddress());