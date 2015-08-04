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

namespace SUpdateServer\Dashboard;

/**
 * The File Explorer Dashboard Entry, the entry for the File Explorer, in the Dashboard
 *
 * @author TheShark34
 * @package S-Update-Server\Dashboard
 * @version 3.0.0-BETA
 */
class FileExplorerDBEntry extends DashboardEntry {

    public function getName() {
        return \SUpdateServer\LangLoader\LangLoader::getLangLoader()->getLangText("file-explorer");
    }

    /**
     * The icon of the entry
     */
    public function getIcon() {
        return \Paladin\Paladin::getRootFolder() . \Paladin\PaladinTwigExtension::getFile("Dashboard", "images/fileexplorer.png", true, "resources");
    }

    /**
     * The link of the entry
     */
    public function getLink() {
        return "FileExplorer";
    }

}

?>
