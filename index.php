<?php

/*
 * Copyright 2015 TheShark34
 *
 * This file is part of S-Update-Server.
 *
 * S-Update-Server is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * S-Update-Server is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.
 */

// Checking
if(!is_dir(__DIR__ . '/vendor')) {
    echo "<h1>BLEH, il faut telecharger S-Update-Server depuis la page release du repo Github !</h1>";
    echo "<a href='https://github.com/TheShark34/S-Update-Server/releases'>ICI !</a>";
    die();
}

// Just loading all
require_once __DIR__ . '/vendor/autoload.php';
require_once "src/bootstrap.php";

?>
