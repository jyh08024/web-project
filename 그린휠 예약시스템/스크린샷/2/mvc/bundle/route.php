<?php 
	namespace bundle;
	use \model\_base as DB;

	/**
	 * 
	 */
	class route
	{
		public static $setup = ['get' => [], 'post' => []];
		public static $template = ["header"];
		public $res = '';

		public static function __callStatic($name, $args)
		{
			self::$setup[$name][$args[0]] = $args[1];
		}

		public function __construct($url)
		{
			DB::reserve()->refresh();
			$url = explode('/', $url);
			$page = array_shift($url);
			$method = strtolower($_SERVER['REQUEST_METHOD']);

			$cb = @self::$setup[$method][$page];

			if ($cb == null) {
				$cb = function() {
					return ["비정상적인 접근입니다.", "/"];
				};
			}

			$this->res = $cb(...$url);
		}


		public function __destruct()
		{
			if (!$this->res) {
				return false;
			}

			if (is_string($this->res[1] ?? [])) {
				return move(...$this->res);
			}

			extract($this->res[1] ?? []);

			if (in_array("header", self::$template)) {
				require_once ROOT."/mvc/view/header.php";
			}

			require_once ROOT."/mvc/view/{$this->res[0]}.php";
		}
	}