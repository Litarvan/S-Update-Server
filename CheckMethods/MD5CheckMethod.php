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

use SUpdateServer\Internal\CheckMethod;

/**
 * The MD5 Check Method, uses the MD5s of the files
 * to check them.
 *
 * @author TheShark34
 * @package S-Update-Server\Internal
 * @version 3-(Base-2.0.0-BETA)
 */
 class MD5CheckMethod extends CheckMethod {

    public function getName() {
        return "md5-check-method";
    }

    public function createFileInfos($file) {
        return array(
            "fileRelativePath" => $file,
            "md5" => md5_file(SUpdateServer::FILES_DIRECTORY . "/" . $file)
        );
    }

}
