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

    if(isset($_GET['request']))
      if($_GET['request'] == 'indexDates')
        index(false);
      else if($_GET['request'] == 'indexMD5')
        index(true);
      else
        home();
    else
      home();

    function index($md5) {
      $index = listFiles($md5, "../files");
      file_put_contents("../su_files.idx", $index);
      echo "success";
    }

    function listFiles($md5, $folder) {
  		$list = glob($folder . "/*");
      $index = "";

  		foreach($list as $file)
  			if(!is_dir($file))
          if($md5)
            $index .= substr($file, 9) . "|" . md5_file($file) . "\n";
          else
				    $index .= substr($file, 9) . "|" . filemtime($file) . "\n";
  			else
  				$index .= listFiles($md5, $file);

      return $index;
    }

    function home() {

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>S-Update Installer</title>

    <!-- Bootstrap -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="http://theshark34.github.io/S-Update-Server/style.css" rel="stylesheet">
  </head>

  <body>
    <div class='fulldiv'>
      <div class="center">
        <img src="http://theshark34.github.io/S-Update-Server/logo.png" />
      </div>

      <div id="buttons" class="center buttons">
        <button id="dates" class="submit-button spaced" style="width: 150px;">Dates (Rapide)</button>
        <button id="md5" class="submit-button" style="width: 150px;">MD5 (Sécurisé)</button>
      </div>

      <div id="wait" class="center wait">
        <center><b>Veuillez patienter...</b></center>
      </div>

      <script type="text/javascript">
        document.getElementById("dates").onclick = function () {
          document.getElementById("buttons").style.display = 'none';
          document.getElementById("wait").style.display = 'inline-block';

          sendRequest("indexer.php", "indexDates", finish);
        };

        document.getElementById("md5").onclick = function () {
          document.getElementById("buttons").style.display = 'none';
          document.getElementById("wait").style.display = 'inline-block';

          sendRequest("indexer.php", "indexMD5", finish);
        };
      </script>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- Offical S-Update script -->
    <script src="http://theshark34.github.io/S-Update-Server/supdate.js"></script>
  </body>
</html>

<?php

    }
?>
