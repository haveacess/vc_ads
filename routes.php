<?php

/*
	Rules for using routes.
	1. route * (all other routes) need to locate always in end of this list
	2. Firstly static routes (ex. /ads/relevant), then -> routes with arg-s /ads/{id}
*/

return [
	['route' => '/', 'controller' => '', 'action' => 'index'],
	['route' => '/ads', 'controller' => 'Ads', 'action' => 'create'],
	['route' => '/ads/relevant', 'controller' => 'Ads', 'action' => 'relevant'],
	['route' => '/ads/{id}', 'controller' => 'Ads', 'action' => 'edit'],
	
	['route' => '*', 'controller' => '', 'action' => 'error404']
];