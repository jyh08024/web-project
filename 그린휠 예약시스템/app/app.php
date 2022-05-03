<?php 
	require "helper/lib.php";
	require "helper/middleware.php";
	require "helper/router.php";
	require "model/base.php";
	require "http/web.php";

	$uri = explode("/", urldecode($_SERVER['REQUEST_URI']));
	$method = $_SERVER['REQUEST_METHOD'];

	foreach ($route[$method] as $route => $fn) {
		$route = explode("/", $route);
		$param = [];

		if (count($uri) != count($route)) {
			continue;
		}

		foreach ($route as $key => $v) {
			if ($v === "$") {
				$param[] = $uri[$key];
				continue;
			}

			if ($v != $uri[$key]) {
				continue 2;
			}
		}

		return $fn(...$param);
	}
 ?>