<?php
session_start();
error_reporting(0);
function rewrite_urls($change){
  $match = [
    '/index.php/',
    '/plans.php/',
    '/members.php/',
    '/sign-up.php/',
    '/index\?type=([a-z]+)&page=([0-9]+)/',
    '/index\?type=([a-z]+)/',
    '/more-questions.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)&page=([0-9]+)/',
    '/more-questions.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/questions\/categories&amp;id=([0-9]+)&title=([A-Za-z0-9-]+)&page=([0-9]+)/',
		'/questions\/categories&amp;id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/questions.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/index\?page=([0-9]+)/',
		'/members\?page=([0-9]+)/',
		'/profile\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/voters\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)&page=([0-9]+)/',
		'/voters\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/tags\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/pages\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/iframe\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/followers\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)&amp;type=er/',
		'/followers\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)&amp;type=ing/',
		'/followers\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)&type=er&page=([0-9]+)/',
		'/followers\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)&type=ing&page=([0-9]+)/',
		'/ask\.php\?id=([0-9]+)&title=([A-Za-z0-9-]+)/',
		'/ask\.php/',
		'/details\.php/',

  ];
  $replace = [
    'index',
    'plans',
    'members',
    'sign-up',
    'questions/$1/page/$2',
    'questions/$1',
    'members/questions/$1/$2/page/$3',
    'members/questions/$1/$2',
		'questions/category/$1/$2/page/$3',
		'questions/category/$1/$2',
		'questions/single/$1/$2',
		'index/page/$1',
		'members/page/$1',
		'members/profile/$1/$2',
		'questions/voters/$1/$2/page/$3',
		'questions/voters/$1/$2',
		'questions/tags/$1/$2',
		'pages/$1/$2',
		'questions/iframe/$1/$2',
		'members/followers/$1/$2',
		'members/following/$1/$2',
		'members/followers/$1/$2/page/$3',
		'members/following/$1/$2/page/$3',
		'questions/edit/$1/$2',
		'questions/new',
		'profile/details',
  ];

  $change = preg_replace($match, $replace, $change);

	return $change;
}
ob_start("rewrite_urls");


# Connecting to Database
include __DIR__.'/includes/connection.php';

# Language
$lang = [];
include __DIR__.'/includes/lang/en.php';

if(isset($_COOKIE['lang'])){
	$lng_where = "id = '".(int)($_COOKIE['lang'])."'";
} else {
	$lng_where = "lang_default = 1";
}

$sql_ln = $db->query("select * from ".prefix."lang where {$lng_where}");
if($sql_ln->num_rows){
	$rs_ln = $sql_ln->fetch_assoc();
	$lang = unserialize(base64_decode($rs_ln['content']));
}
$sql_ln->close();

# Visitor infos Class file
include __DIR__.'/includes/class.info.php';

# Defines file
include __DIR__.'/includes/defines.php';

# Countries
include __DIR__.'/includes/countries.php';

# Include functions files
include __DIR__.'/includes/func.security.php';
include __DIR__.'/includes/func.database.php';
    db_global(); // Giving the site configs
    db_login_details(); // Showing the login details


# Plans Options

define("plan_polls_month", db_get("plans", "poll_month", us_plan+1));
define("plan_votes_month", db_get("plans", "votes_month", us_plan+1));
define("plan_iframe",      db_get("plans", "iframe", us_plan+1));
define("plan_gender",      db_get("plans", "gender", us_plan+1));
define("plan_age",         db_get("plans", "age", us_plan+1));
define("plan_location",    db_get("plans", "location", us_plan+1));
define("plan_export",      db_get("plans", "export", us_plan+1));
define("plan_support",     db_get("plans", "support", us_plan+1));
define("plan_ads",         db_get("plans", "ads", us_plan+1));



# Facebook Login App
define("fbAppId",      login_fbAppId); // Facebook App ID
define("fbAppSecret",  login_fbAppSecret); // Facebook App Secret
define("fbAppVersion", login_fbAppVersion); // Facebook Graph Version

# Twitter Login App
define('twConKey',        login_twConKey); // Twitter Consumer Key
define('twConSecret',     login_twConSecret); //Twitter Consumer Secret
define('twOauthCallback', path."/login-twitter.php");

# Google Login App
define('ggClientId',      login_ggClientId); // Google Client ID
define('ggClientSecret',  login_ggClientSecret); // Google Client Secret
define('ggOauthCallback', path."/login-google.php");
define('ggAppName',       site_title); // Google Application Name

# Paypal Payement Gateway configuration
define('PAYPAL_ID', site_paypal_id);
define('PAYPAL_SANDBOX', (site_paypal_live ? true : false) ); //TRUE (For testing) or FALSE (For live)

define('PAYPAL_RETURN_URL', path.'/payment-success.php');
define('PAYPAL_CANCEL_URL', path.'/index.php');
define('PAYPAL_NOTIFY_URL', path.'/ipn.php');
define('PAYPAL_CURRENCY', site_paypal_currency);

// Change not required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");


# Include functions files
include __DIR__.'/includes/mail.php';
include __DIR__.'/includes/func.helper.php';
include __DIR__.'/includes/func.pagination.php';

# Include class upload
include __DIR__.'/includes/class.upload.php';


if(page == 'config'){
    header("HTTP/1.0 404 Not Found");
}


# Pagination
$page  = (int) (!isset($_GET["page"]) || !$_GET["page"] ? 1 : $_GET["page"]);
$limit = ( page=='index' ?  ( home_questions ? home_questions : 5 ) : 16 );
$startpoint = ($page * $limit) - $limit;

# Gets
$request = (isset($_GET['request'])) ? sc_sec($_GET['request']) : null;
$type    = (isset($_GET['type']))    ? sc_sec($_GET['type'])    : null;
$pg      = (isset($_GET['pg']))      ? sc_sec($_GET['pg'])    : null;
$token   = (isset($_GET['token']))   ? sc_sec($_GET['token'])   : null;
$title   = (isset($_GET['title']))   ? sc_sec($_GET['title'])   : null;
$t       = (isset($_GET['t']))       ? sc_sec($_GET['t'])       : null;

# Numeric Hets
$id      = (isset($_GET['id'])) ? (int)sc_sec($_GET['id']) : 0;

# Defines
define('time', time());
define('ip', function_exists('fh_ip') ? fh_ip() : '');
define('get_country', get_country_code);
define('get_city', get_city_name);




# Facebook Login
$facebookLoginUrl = '#';
if(fbAppId != 'fbAppId'){
require __DIR__.'/includes/src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
	'app_id'                => fbAppId,
	'app_secret'            => fbAppSecret,
	'default_graph_version' => fbAppVersion,
]);
$helper      = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$facebookLoginUrl    = $helper->getLoginUrl(path."/login-facebook.php", $permissions);
}

# Twitter Login
require_once(__DIR__."/includes/src/Twitter/twitteroauth.php");
$twitterLoginUrl = path."/login-twitter.php";

# Google Login
require_once(__DIR__."/includes/src/Google/Google_Client.php");
require_once(__DIR__."/includes/src/Google/contrib/Google_Oauth2Service.php");

$gClient = new Google_Client();
$gClient->setApplicationName(ggAppName);
$gClient->setClientId(ggClientId);
$gClient->setClientSecret(ggClientSecret);
$gClient->setRedirectUri(ggOauthCallback);

$google_oauthV2 = new Google_Oauth2Service($gClient);
$googleLoginUrl = $gClient->createAuthUrl();


# Sidebar
$sidebar = [
	'access'     => true,
	'ads'        => true,
	'questions'  => true,
	'categories' => true,
	'social'     => true,
	'people'     => true
];


# Banned User auto Logout
if(us_moderat == 1){
	session_destroy();
	unset($_COOKIE['login_keep']);
	setcookie('login_keep', null, -1);
}
