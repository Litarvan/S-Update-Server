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

    $VERSION = "2.0.0-SNAPSHOT";

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['redirecturl']))
        applyConfig(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['redirecturl']));
    else
        config();

    function applyConfig($username, $password, $redirectUrl) {
        if(file_exists(".htpasswd"))
            unlink(".htpasswd");
        if(file_exists(".htaccess"))
            unlink(".htaccess");
        if(file_exists(".redirecturl"))
            unlink(".redirecturl");

        $password = crypt($password);
        $htpasswd = "$username:$password";
        $htpasswdFile = fopen('.htpasswd', 'a');
        $htpasswdPath = realpath(".htpasswd");
        $htaccess = "AuthName \"S-Update Server proteced page\"\n" .
                    "AuthType Basic\n" .
                    "AuthUserFile \"$htpasswdPath\"\n" .
                    "Require valid-user";
        $htaccessFile = fopen('.htaccess', 'a');
        $redirectUrlFile = fopen('.redirecturl', 'a');

        fputs($htpasswdFile, $htpasswd);
        fputs($htaccessFile, $htaccess);
        fputs($redirectUrlFile, $redirectUrl);

        fclose($htpasswdFile);
        fclose($htaccessFile);
        fclose($redirectUrlFile);

        if(file_exists("../config.php"))
            unlink("../config.php");

        header("Location: ../protected/");
    }

    function config() {
        $username = "";
        $redirectUrl = "";

        if(file_exists(".htpasswd")) {
            $htpasswdFile = fopen('.htpasswd', 'r');
            $infos = fgets($htpasswdFile);
            for ($i = 0; $infos[$i] != ':' || $i == strlen($infos); $i++)
                $username .= $infos[$i];
        }

        if(file_exists(".redirecturl")) {
            $redirectUrlFile = fopen('.redirecturl', 'r');
            $redirectUrl = fgets($redirectUrlFile);
        }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>S-Update Configuration</title>

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

            <h1>Configuration</h1>
            <br />
            <p class="marged-paragraph">
                Bienvenue dans la configuration de votre S-Update
                <br />
                Ici vous pouvez définir un nouveau pseudo ou mot de passe, et un nouvel URL de redirection.
                <br />
                Attention ! Cette nouvelle configuration effacera l'ancienne !

                <br /><br /><br />

                <form method="post" action="config.php">
                    <label for="username">Pseudo</label> : <input class="text-field" type="text" name="username" id="username" value=<?php echo "\"$username\""; ?> required />
                    <br />
                    <label for="password">Mot de Passe</label> : <input class="text-field" type="password" name="password" id="password" required/>
                    <br /><br />
                    <label for="redirecturl">Acceuil de votre Site</label> : <input class="text-field" type="text" name="redirecturl" id="redirecturl" value=<?php echo "\"$redirectUrl\""; ?> required/>
                    <br /><br />
                    <input class="submit-button" type="submit" value="Appliquer" />
                </form>
            </p>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>

<?php

    }

?>
