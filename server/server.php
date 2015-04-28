<?php

	/*if(isset($_POST["request"]))
		execute($_POST["request"]);
	else
		redirect();*/
		listFiles();

	function execute($request) {
		if($request == "list")
			listFiles();
		else if ($request == "filestoignore")
			filesToIgnore();
	}

	function redirect() {
		if(file_exists("protected/.redirecturl")) {
			$redirectUrlFile = fopen("protected/.redirecturl", "r");
			$redirectUrl = fgets($redirectUrlFile);
			fclose($redirectUrlFile);

			if($redirectUrl == null)
					$redirectUrl = "protected/";

			header("Location: " . $redirectUrl);
		}
	}

	function listFiles() {
		$list = glob("files/*");
		foreach($list as $file)
			echo $file . "<br />";
		writeConnection();
	}

	function filesToIgnore() {
		if(file_exists("protected/.suignore"))
			echo file_get_contents("protected/.suignore");
	}

	function writeConnection() {
		$connection = file_get_contents("protected/.connexions");
		$connection += 1;
		file_put_contents("protected/.connexions", $connection);

		$now = new DateTime();
		$line = get_ip_address() . " Le " . $now->format("d/m/Y") . " à " . $now->format("H:i") . "\n";
		file_put_contents("protected/.stats", $line . file_get_contents("protected/.stats"));
	}

	function get_ip_address() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
      if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
      	$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($iplist as $ip)
          if (validate_ip($ip))
            return $ip;
      } elseif (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
              return $_SERVER['HTTP_X_FORWARDED_FOR'];

    if(!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
      return $_SERVER['HTTP_X_FORWARDED'];

    if(!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
      return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];

    if(!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
      return $_SERVER['HTTP_FORWARDED_FOR'];

    if(!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
      return $_SERVER['HTTP_FORWARDED'];

    return $_SERVER['REMOTE_ADDR'];
	}


?>
