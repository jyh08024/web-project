<?php 
	function get() {
		router("GET", ...func_get_args());
	}

	function post() {
		router("POST", ...func_get_args());
	}

	function middleware($auth, $fn) {
		$fn();
	}

	function router($method, $url, $fn) {
		$uri = str_replace(["/", "$"], ["\/", "([A-z0-9]+)"], $method.$url);
		
		if (!preg_match_all("/^$uri$/", $_SERVER['REQUEST_METHOD'].$_SERVER['REQUEST_URI'], $param)) {
			return;
		}		

		foreach (debug_backtrace() as $val) {
			$val['function'] == "middleware" && $val['args'][0]();
		}

		$fn(...array_slice(array_merge(...$param), -count($param) +1));
	}
 ?>