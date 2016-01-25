<?php

/*
 * Copyright 2015-2016 Adrien Navratil
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

use SUpdateServer\CheckMethod\CheckMethod;
use SUpdateServer\SUpdateServer;

/**
 * The MD5 Check Method, uses the MD5s of the files
 * to check them.
 *
 * @author  Litarvan
 * @package S-Update-Server\CheckMethod
 * @version 3-(Base-2.1.0-BETA)
 */
class MD5CheckMethod extends CheckMethod
{
    public function getName()
    {
        return "md5";
    }

    public function createFileInfos($file)
    {
        return array("fileRelativePath" => $file, "md5" => md5_file(SUpdateServer::FILES_DIRECTORY . "/" . urldecode($file)));
    }
}
