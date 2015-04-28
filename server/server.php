<?php

	/*
	 * Copyright 2015 TheShark34
	 *
	 * This file is part of S-Update.

	 * S-Update is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU Lesser General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 *
	 * S-Update is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU Lesser General Public License for more details.
	 *
	 * You should have received a copy of the GNU Lesser General Public License
	 * along with S-Update.  If not, see <http://www.gnu.org/licenses/>.
	 */

	if(isset($_POST["request"]))
		execute($_POST["request"]);
	else
		redirect();

	function execute($request) {
		if($request == "list") {
			listFiles("files");
			writeConnection();
		} else if ($request == "filestoignore")
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

	function listFiles($folder) {
		$list = glob($folder . "/*");
		foreach($list as $file)
			if(!is_dir($file))
				echo substr($file, 6) . "|" . filemtime($file) . "\n";
			else
				listFiles($file);
	}

	function filesToIgnore() {
		if(file_exists("protected/.suignore"))
			echo file_get_contents("protected/.suignore");
	}

	function writeConnection() {
		if(file_exists("protected/.connexions"))
			touch("protected/.connexions");

		if(file_exists("protected/.stats"))
			touch("protected/.stats");

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
