<?php

# Showing current page name
define('page', basename($_SERVER['PHP_SELF'], '.php'));

# You need to change the url to yours
define('path', 'http://pollogo:8888');

# Showing current page name
define('userMan',     path.'/images/user-man.png');
define('userGirl',    path.'/images/user-girl.png');
define('transparent', path.'/images/transparent.png');
define('siteThumb',   path.'/images/twitter_thumb.png');

# Get Visitor Infos
define("get_ip",           UserInfo::get_ip());
define("get_os",           UserInfo::get_os());
define("get_browser",      UserInfo::get_browser());
define("get_device",       UserInfo::get_device());
define("get_country_name", ip_info("Visitor", "Country"));
define("get_country_code", ip_info("Visitor", "Country Code"));
define("get_state",        ip_info("Visitor", "State"));
define("get_city_name",    ip_info("Visitor", "City"));
