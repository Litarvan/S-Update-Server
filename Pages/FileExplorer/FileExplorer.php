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

namespace SUpdateServer\Pages;

/**
 * The File Explorer page
 *
 * @author TheShark34
 * @package S-Update-Server\Pages
 * @version 3.0.0-BETA
 */
class FileExplorer extends \Paladin\Page {

  public function getName() {
    return "FileExplorer";
  }

  public function getMainPage() {
    return "FileExplorer.php.twig";
  }

  public function isThemable() {
    return true;
  }

  public function constructTwigArray($args) {
    $files = array();

    foreach($args["files"] as $file)
        $files[sizeof($files)] = array(
            "path" => $file,
            "name" => basename($file),
            "size" => $this->format_size(filesize($file)),
            "folder" => is_dir($file),
            "lastdate" => date('m/d/Y h:i:s a', filemtime($file))
        );

    return array(
        "path" => $args["path"],
        "files" => $files,
        "root" => $args["root"]
    );
  }

  private function format_size($size) {
      $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
      $power = $size > 0 ? floor(log($size, 1024)) : 0;
      return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
  }

}
