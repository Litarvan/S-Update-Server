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
			listFiles();
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

	function listFiles() {
		require_once 'ChecksumGenerator.php';

		$checksum = new ChecksumGenerator();
		$checksum->setDir("files/");
		$checksum->setFields(['path', 'mtime']);
		$checksum->setUsedMethod($checksum::AS_ARRAY);
		$checksum->generate();

		$arrays = $checksum->get();

		foreach ($arrays as &$array)
			foreach ($array as &$value)
				echo str_replace("\\", "/", substr($value['path'], 7)) . '|' . $value['mtime'] . "\n";
	}

	function filesToIgnore() {
		if(file_exists("protected/.suignore"))
			echo file_get_contents("protected/.suignore");
	}

	function writeConnection() {
		if(!file_exists("protected/.connexions"))
			touch("protected/.connexions");

		if(!file_exists("protected/.stats"))
			touch("protected/.stats");

		$connection = file_get_contents("protected/.connexions");
		$connection += 1;
		file_put_contents("protected/.connexions", $connection);

		$now = new DateTime();
		$line = get_ip_address() . " Le " . $now->format("d/m/Y") . " à " . $now->format("H:i") . "\n";
		file_put_contents("protected/.stats", $line . file_get_contents("protected/.stats"));
	}

	function get_ip_address() {
	    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
	    foreach ($ip_keys as $key)
	        if (array_key_exists($key, $_SERVER) === true)
	            foreach (explode(',', $_SERVER[$key]) as $ip) {
	                $ip = trim($ip);
	                if (validate_ip($ip))
	                    return $ip;
	            }

	    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "Unknown";
	}

	function validate_ip($ip) {
	    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false)
	        return false;
	    return true;
	}


?>
