<?php

	if(isset($_POST["request"]))
		execute($_POST["request"]);
	else
		redirect();

	function execute($request) {
		if($request == "list")
			listFiles();
		else if ($request == "filestoignore")
			filesToIgnore();
	}

	function redirect() {
		if(file_exists("protected/.redirecturl")) {
			$redirectUrlFile = fopen("protected/.redirecturl");
			$redirectUrl = fgets($redirectUrlFile);

			header("Location: " . $redirectUrl);
		}
	}

?>