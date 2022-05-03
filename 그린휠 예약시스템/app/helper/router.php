<?php 
	$GLOBALS['route'] = ["POST"=> [], "GET"=> []];

	function post() {
		router("POST", ...func_get_args());
	}

	function get() {
		router("GET", ...func_get_args());
	}

	function middleware($auth, $fn) {
		$fn();
	} 

	function router($method, $url, $fn) {
		$mid = array_filter(debug_backtrace(), function($v) {
			return $v['function'] === "middleware";
		});
		$GLOBALS['route'][$method][$url] = function() use($mid, $fn) {
			foreach ($mid as $key => $v) {
				$v['args'][0]();
			}
			$fn(...func_get_args());
		};
	}
 ?>	