<!--

 Copyright 2015 TheShark34
 
 This file is part of S-Update.
 
 S-Update is free software: you can redistribute it and/or modify
 it under the terms of the GNU Lesser General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 
 S-Update is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public License
 along with S-Update.  If not, see <http://www.gnu.org/licenses/>.

-->

<?php

	$VERSION="2.0.0-SNAPSHOT";

	if(isset($_GET['request']))
		if($_GET['request'] == 'download')
			download();
		else
			home();
	else
		home();


	function download() {
		echo "bite";
	}

	function home() {

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>S-Update - Acceuil</title>

		<!-- Bootstrap -->
    	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

	<body>

		<style>
			.fulldiv {
			    background-color: #333;
			    width: 100%;
			    height: auto;
			    bottom: 0px;
			    top: 0px;
			    left: 0;
			    position: absolute;
			    color: white;
			}

			.progress {
				background: rgba(0, 0, 0, 0);
				border: 5px solid rgba(255, 255, 255, 1);
				border-radius: 25px;
				position: absolute;
			    width: 750px;
			    height: 20px;
			    top: 50%;
			    left: 50%;
			    margin-left: -375px;
			    margin-top: 80px; 
			}

			.center {
				position: absolute;
			    width: 750px;
			    height: 200px;
			    top: 50%;
			    left: 50%;
			    margin-left: -375px;
			    margin-top: -110px; 
			}

			.progress-bar-custom {
				background: rgba(150, 150, 150, 1);
			}
		</style>

		<div class='fulldiv'>
			<div class="center">
				<img src="http://theshark34.github.io/S-Update-Server/logo.png" />
			</div>
			
	    	<div class="progress">
			    <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	</body>
</html> 

<?php

	}
?>