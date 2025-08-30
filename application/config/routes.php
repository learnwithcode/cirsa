<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

  $route['welcome'] = 'user/welcome';
  
  
  $route['userpanel/notification'] = 'userpanel/dashboard/notification';
$route['userpanel/notification/(.*)'] = 'userpanel/dashboard/notification/$1';


$route['captcha/(.*)'] = 'captcha/$1';
$route['userpanel/transfer-history'] = 'userpanel/ewallet/transferfund';
$route['userpanel/transfer-history/(.*)'] = 'userpanel/ewallet/transferfund/$1';
$route['userpanel/withdraw-history'] = 'userpanel/ewallet/withdraw';
$route['userpanel/withdraw-history/(.*)'] = 'userpanel/ewallet/withdraw/$1';

$route['userpanel/flushout-history'] = 'userpanel/ewallet/flushout';
$route['userpanel/flushout-history/(.*)'] = 'userpanel/ewallet/flushout/$1';

$route['userpanel/income-wallet'] = 'userpanel/ewallet/ewallet';
$route['userpanel/income-wallet/(.*)'] = 'userpanel/ewallet/ewallet/$1';


$route['userpanel/tradeview-setting'] = 'userpanel/ewallet/tradeview';

$route['userpanel/trade'] = 'userpanel/ewallet/trade';

$route['userpanel/tradeview-history'] = 'userpanel/ewallet/tradeviewhistory';

$route['userpanel/out-quotes'] = 'userpanel/ewallet/outquotes';

$route['userpanel/latest-news'] = 'userpanel/ewallet/latestnews';
$route['userpanel/zoom-meetings'] = 'userpanel/ewallet/zoom_meeting';




$route['userpanel/mining-history'] = 'userpanel/ewallet/miningwithdraw';
$route['userpanel/mining-history/(.*)'] = 'userpanel/ewallet/miningwithdraw/$1';
$route['userpanel/mining-wallet'] = 'userpanel/ewallet/miningewallet';
$route['userpanel/mining-wallet/(.*)'] = 'userpanel/ewallet/miningewallet/$1';

$route['userpanel/activation-summary'] = 'userpanel/ewallet/activation';
$route['userpanel/activation-summary/(.*)'] = 'userpanel/ewallet/activation/$1';


$route['userpanel/magic-wallet'] = 'userpanel/ewallet/magic_wallet';
$route['userpanel/magic-wallet/(.*)'] = 'userpanel/ewallet/magic_wallet/$1';

// $route['userpanel/AIG-coin'] = 'userpanel/ewallet/aig';
// $route['userpanel/AIG-coin/(.*)'] = 'userpanel/ewallet/aig/$1';
$route['userpanel/activation-wallet'] = 'userpanel/ewallet/activation_wallet';
$route['userpanel/activation-wallet/(.*)'] = 'userpanel/ewallet/activation_wallet/$1';

$route['userpanel/airdrop-wallet'] = 'userpanel/ewallet/airdrop_wallet';
$route['userpanel/airdrop-wallet/(.*)'] = 'userpanel/ewallet/airdrop_wallet/$1';

$route['userpanel/bonus-wallet'] = 'userpanel/ewallet/ewallet';
$route['userpanel/bonus-wallet/(.*)'] = 'userpanel/ewallet/ewallet/$1';

$route['userpanel/crypto'] = 'userpanel/account/addcrypto';
$route['userpanel/p2p'] = 'userpanel/account/p2p';
$route['userpanel/p2pStatus/(.*)'] = 'userpanel/account/p2pStatus/$1';
$route['userpanel/p2pSaleHistory'] = 'userpanel/account/p2psale';
 
$route['userpanel/retrieve-pocket'] = 'userpanel/network/redeem';
$route['userpanel/retrieve-pocket/(.*)'] = 'userpanel/network/redeem/$1';

$route['admin/(.*)'] = 'admin/$1';
$route['admin'] = 'admin/login';
$route['userpanel/account/bank-detail'] = 'userpanel/account/bank';

$route['userpanel/verifypayment'] = 'userpanel/account/verifypayment';
$route['userpanel/verifypayment/(.*)'] = 'userpanel/account/verifypayment/$1';



$route['userpanel/ewallet/e-wallet-transfer'] = 'userpanel/ewallet/transfer';
$route['sign-up/user/registerajax'] = 'user/registerajax';
$route['userpanel/(.*)'] = 'userpanel/$1';
$route['userpanel'] = 'userpanel/dashboard';
$route['Airdrop/(.*)'] = 'home/airdrop';
$route['Airdrop'] = 'home/airdrop';
$route['sign-up/(.*)'] = 'home/sign';
$route['sign-up'] = 'home/sign';
$route['default_controller'] = 'home/login';
$route['about-us'] = 'home/about';
 
$route['services'] = 'home/services';
 
$route['contact-us'] = 'home/contact'; 
$route['login'] = 'home/login';
/*$route['faq'] = 'home/faq';
$route['disclaimer'] = 'home/disclaimer';
$route['term-condition'] = 'home/term';
$route['privacy-policy'] = 'home/policy';*/
$route['user/(.*)'] = 'user/$1';
$route['emailyverify/(.*)'] = 'emailyverify/$1';
$route['web/(.*)'] = 'web/$1';
$route['cronsecure/(.*)'] = 'cronsecure/$1';

$route['Api/(.*)'] = 'Api/$1';
$route['json/(.*)'] = 'json/$1';
$route['(.*)'] = 'home/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
