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
    $con = "Aucune connection";
    $stats = " ";

    if(file_exists(".stats")) {
        $statsFile = fopen(".stats", "r");

        for ($i = 0; $i < 5 & $stats != false; $i++)
            $stats .= fgets($statsFile);

        fclose($statsFile);
    }

    if(file_exists(".connexions")) {
        $con = file_get_contents(".connexions") . " connections au total.";

        if($con == "")
          $con = "Aucune connection";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>S-Update Server</title>

        <link rel="icon" href="http://theshark34.github.io/S-Update-Server/icon.png" />

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
        <div class="fulldiv classic">
            <img src="http://theshark34.github.io/S-Update-Server/logo.png" />

            <h1><u>S-Update Server v2.0.0-SNAPSHOT</u></h1>
            <br />
            <p class="marged-paragraph">
                <div>
                    Bienvenue sur la page d'administration de votre serveur S-Update. Votre serveur fonctionne parfaitement !
                    <br />
                    Ici sont afficher les statistiques du serveur. Vous pouvez vous rendre sur la page de configuration en cliquant sur le bouton ci-dessous.
                </div>

                <br />
                <br />

                <button id="config" class="submit-button" style="width: 150px;">Configuration</button>

                <script type="text/javascript">
                    document.getElementById("config").onclick = function () {
                        location.href = "config.php";
                    };
                </script>

                <br />
                <br />

                <div>
                    <h3><u>Statistiques</u></h3>

                    <br />
                    <br />

                    <p style="font-size: 20px;">
                        <?php
                            global $con, $stats;

                            echo $con . "<br /><br /><u>Dernières connections</u> <br /><br />" . nl2br($stats);
                        ?>
                    </p>
                </div>
            </p>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
