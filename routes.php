<?php

return [
	['route' => '/api', 'controller' => '', 'action' => 'index'],
	['route' => '/api/ads', 'controller' => 'Ads', 'action' => 'create'],
	['route' => '/api/ads/{id}', 'controller' => 'Ads', 'action' => 'edit'],
	['route' => '*', 'controller' => '', 'action' => 'error404']
];