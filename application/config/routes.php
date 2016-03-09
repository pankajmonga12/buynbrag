<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['welcome'] = "homepage";
$route['store/(\d+)'] = "order/store_page/$1";
$route['product/(\d+)/(\d+)'] = "order/product_page/$1/$2";
$route['fbLogin'] = "fbLogin/index";
$route['footer/(:num)'] = 'footer/index/$1';

/* routing for invites */
$route["invite/email"] = "invite/email/index";
$route["invite/invlist"] = "invite/invlist/index";
$route["invite/accept/(:num)/(:any)"] = "invite/accept/index/$1/$2";
/* END SECTION routing for invites */

/* routing for search */
/*$route["search/(:any)"] = "search/index/$1";
$route["search/(:any)/(:num)"] = "search/index/$1/$2";
$route["search/suggest/(:any)"] = "search/suggest/$1";
/* END SECTION routing for search */

/* routing for trends */
$route["rapiv1/trends/(:any)"] = "rapiv1/trends/index/$1";
$route["rapiv1/trends/(:any)/(:num)"] = "rapiv1/trends/index/$1/$2";
$route["rapiv1/trends/(:any)/(:num)/(:num)"] = "rapiv1/trends/index/$1/$2/$3";
/* END SECTION routing for search */

//$route['store//([a-z]+)/(\d+)'] = "order/store_page/$1/$2";
/*$route['default_controller'] = "user";*/

/* NEW routes for old pages and */
$route["cart/shopping_cart"] = "cart/shopping_cart";
$route["cart/confirmRedeemCoupon"] = "cart/confirmRedeemCoupon";
$route["cart/redeemCoupon"] = "cart/redeemCoupon";
$route["cart/removeCoupon"] = "cart/removeCoupon";
$route["cart/deleteItem"] = "cart/deleteItem";
$route["cart/deleteItem/(:any)"] = "cart/deleteItem/$1";



$route["order2/checkout"] = "order2/checkout";
$route["order2/checkout_second"] = "order2/checkout_second";
$route["order2/checkout_third"] = "order2/checkout_third";
$route["order2/redirecting_to_bnb/(:any)"] = "order2/redirecting_to_bnb/$1";
$route["order2/redirecting_to_bnb/(:any)/(:any)"] = "order2/redirecting_to_bnb/$1/$2";
$route["order2/redirectingback/(:any)"] = "order2/redirectingback/$1";
$route["order2/checkout_third_cod"] = "order2/checkout_third_cod";
$route["order2/pay_status"] = "order2/pay_status";
$route["order2/payment_success"] = "order2/payment_success";
$route["order2/purchase_history"] = "order2/purchase_history";
$route["order2/calculate/(:any)/(:any)/(:any)/(:any)"] = "order2/calculate/$1/$2/$3/$4";


/* END SECTION NEW routes for old pages */

/* New Routing for Robots */

$route['policies'] = 'robots/policies/index';
$route['contact'] = 'robots/contact/index';
$route['forSellers'] = 'robots/forsellers/index';

/* END SECTION New Routing for Robots */

/* NEW ROUTING CODE FOR ANGULAR */

$ngRoutePrefix = "";

$route[$ngRoutePrefix.""]										=	"homepage";
//$route[$ngRoutePrefix."#_=_"]									=	"homepage";
$route[$ngRoutePrefix."home"]									=	"homepage";
$route[$ngRoutePrefix."trends/(:any)"]							=	"homepage";
$route[$ngRoutePrefix."allStores"]								=	"homepage";
$route[$ngRoutePrefix."allStores/(:any)/(:any)"]				=	"homepage";
$route[$ngRoutePrefix."product/(:any)/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."store/(:any)/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."store/(:any)/(:any)/(:any)/(:any)"]		=	"homepage";
$route[$ngRoutePrefix."storeDisabled/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."storeDisabled/(:any)/(:any)"]			=	"homepage";
$route[$ngRoutePrefix."categories/(:any)/(:any)"]				=	"homepage";
$route[$ngRoutePrefix."inviteFriends"]							=	"homepage";
$route[$ngRoutePrefix."inviteStatus"]							=	"homepage";
$route[$ngRoutePrefix."login"]									=	"homepage";
$route[$ngRoutePrefix."register"]								=	"homepage";
$route[$ngRoutePrefix."404"]									=	"homepage";
//$route[$ngRoutePrefix."contact"]								=	"homepage";
//$route[$ngRoutePrefix."forSellers"]								=	"homepage";
$route[$ngRoutePrefix."aboutUs"]								=	"homepage";
//$route[$ngRoutePrefix."policies"]								=	"homepage";
$route[$ngRoutePrefix."search/products/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."search/stores/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."search/people/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."profile/fancy/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."profile/fancy/(:any)/list/(:any)"]		=	"homepage";
$route[$ngRoutePrefix."profile/badges/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."profile/social/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."profile/about/(:any)"]					=	"homepage";
$route[$ngRoutePrefix."profile/settings/(:any)"]				=	"homepage";
$route[$ngRoutePrefix."profile/purchaseHistory"]				=	"homepage";
$route[$ngRoutePrefix."reset/(:any)"]							=	"homepage";
$route[$ngRoutePrefix."cart"]									=	"homepage";
$route[$ngRoutePrefix."cart/(:any)"]							=	"homepage";
$route[$ngRoutePrefix."checkout/"]								=	"homepage";
$route[$ngRoutePrefix."checkout/(:any)"]						=	"homepage";
$route[$ngRoutePrefix."users"]									=	"homepage";
$route[$ngRoutePrefix."dealofday"]								=	"homepage";
$route[$ngRoutePrefix."Furniture/(:any)"]						=	"homepage";
$route[$ngRoutePrefix."Decor-Furnishings/(:any)"]				=	"homepage";
$route[$ngRoutePrefix."Dining/(:any)"]							=	"homepage";
$route[$ngRoutePrefix."Lighting/(:any)"]						=	"homepage";
$route[$ngRoutePrefix."Fashion/(:any)"]							=	"homepage";
$route[$ngRoutePrefix."Gifts-Collectibles/(:any)"]				=	"homepage";
$route[$ngRoutePrefix."Art/(:any)"]								=	"homepage";
/* __END SECTION__ NEW ROUTING CODE FOR ANGULAR */

/* NEW ROUTING CODE FOR ANGULAR APP */

$route["application/views/app"]											=	"homepage";
//$route["application/views/app/#_=_"]									=	"homepage";
$route["application/views/app/home"]									=	"homepage";
$route["application/views/app/trends/(:any)"]							=	"homepage";
$route["application/views/app/allStores"]								=	"homepage";
$route["application/views/app/allStores/(:any)/(:any)"]					=	"homepage";
$route["application/views/app/product/(:any)/(:any)"]					=	"homepage";
$route["application/views/app/store/(:any)/(:any)"]						=	"homepage";
$route["application/views/app/store/(:any)/(:any)/(:any)/(:any)"]		=	"homepage";
$route["application/views/app/storeDisabled/(:any)"]					=	"homepage";
$route["application/views/app/storeDisabled/(:any)/(:any)"]				=	"homepage";
$route["application/views/app/categories/(:any)/(:any)"]				=	"homepage";
$route["application/views/app/inviteFriends"]							=	"homepage";
$route["application/views/app/inviteStatus"]							=	"homepage";
$route["application/views/app/login"]									=	"homepage";
$route["application/views/app/register"]								=	"homepage";
$route["application/views/app/404"]										=	"homepage";
$route["application/views/app/contact"]									=	"homepage";
$route["application/views/app/forSellers"]								=	"homepage";
$route["application/views/app/aboutUs"]									=	"homepage";
$route["application/views/app/policies"]								=	"homepage";
$route["application/views/app/search/products/(:any)"]					=	"homepage";
$route["application/views/app/search/stores/(:any)"]					=	"homepage";
$route["application/views/app/search/people/(:any)"]					=	"homepage";
$route["application/views/app/profile/fancy/(:any)"]					=	"homepage";
$route["application/views/app/profile/fancy/(:any)/list/(:any)"]		=	"homepage";
$route["application/views/app/profile/badges/(:any)"]					=	"homepage";
$route["application/views/app/profile/social/(:any)"]					=	"homepage";
$route["application/views/app/profile/about/(:any)"]					=	"homepage";
$route["application/views/app/profile/settings/(:any)"]					=	"homepage";
$route["application/views/app/profile/purchaseHistory"]					=	"homepage";
$route["application/views/app/reset/(:any)"]							=	"homepage";
$route["application/views/app/cart"]									=	"homepage";
$route["application/views/app/cart/(:any)"]								=	"homepage";
$route["application/views/app/checkout/"]								=	"homepage";
$route["application/views/app/checkout/(:any)"]							=	"homepage";
$route["application/views/app/users"]									=	"homepage";
$route["application/views/app/dealofday"]								=	"homepage";
$route["application/views/app/Furniture/(:any)"]						=	"homepage";
$route["application/views/app/Decor-Furnishings/(:any)"]				=	"homepage";
$route["application/views/app/Dining/(:any)"]							=	"homepage";
$route["application/views/app/Lighting/(:any)"]							=	"homepage";
$route["application/views/app/Fashion/(:any)"]							=	"homepage";
$route["application/views/app/Gifts-Collectibles/(:any)"]				=	"homepage";
$route["application/views/app/Art/(:any)"]								=	"homepage";

/* __END SECTION__ NEW ROUTING CODE FOR ANGULAR APP */


$route['default_controller'] = "homepage";
$route['404_override'] = 'error/notavailable';



/* End of file routes.php */
/* Location: ./application/config/routes.php */
?>
