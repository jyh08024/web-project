<?php 
	session_start();
	date_default_timezone_set("Asia/Seoul");

	define("ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("USER", @$_SESSION['user']);

	function dd() {
		echo "<pre>";
		var_dump(...func_get_args());
		echo "</pre>";
	}

	function move($url, $msg = false) {
		if (is_array($msg)) {
			$msg = implode("\\n", $msg);
		}

		if ($msg) {
			echo "<script>alert('$msg')</script>";
		}

		$url = $url == "back" ? "history.back()" : "location.href = '$url'";

		if ($url) {
			echo "<script>$url</script>";
		}
		exit;
	}

	function view($loc, $data = []) {
		extract($data);

		require ROOT."/view/header.php";
		require ROOT."/view/$loc.php";
		require ROOT."/view/footer.php";
	}

	function view2($loc, $data = []) {
		extract($data);

		require ROOT."/view/header2.php";
		require ROOT."/view/$loc.php";
		require ROOT."/view/footer.php";
	}

	function err($err, $url, $msg) {
		if ($err) {
			move($url, $msg);
		}
	}

	function responseJSON($json) {
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function strVali($str) {
		$valKey = [
       str_split("1234567890"), 
       str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ"),
       str_split("abcdefghijklmnopqrstuvwxyz"),

       str_split("QWERTYUIOP"),
       str_split("qwertyuiop"),

       str_split("ASDFGHJKL"),
       str_split("asdfghjkl"),
       str_split("ZXCVBNM"),
        str_split("zxcvbnm"),
       str_split("ZXCVBNM"),
       
       ["Q","A","Z"],
       ["W","S","X"],
       ["E","D","C"],
       ["R","F","V"],
       ["T","G","B"],
       ["Y","H","N"],
       ["U","J","M"],
       ["I","K"],
       ["O","L"],
       ["P"],
       ["q","a","z"],
       ["w","s","x"],
       ["e","d","c"],
       ["r","f","v"],
       ["t","g","b"],
       ["y","h","n"],
       ["u","j","m"],
       ["i","k"],
       ["o","l"],
       ["p"]
     ];

     $str = str_split($str);
     $chains = 0;

     for ($i = 0; $i < count($str) - 1; $i++) {
          
       foreach ($valKey as $key => $valCondition) {
         $a = array_search($str[$i], $valCondition);
         $b = array_search($str[$i + 1], $valCondition);

         if ($a != -1 && $b != -1) {
           if (abs($a - $b) == 1) {
              $chains++;
           }
         }
       }
     }

     return $chains >= 2;
	}
 ?>