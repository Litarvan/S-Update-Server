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

namespace SUpdateServer\internal;

/**
 * The CheckMethod, on the server it makes the file list for
 * the client if it use the same CheckMethod
 *
 * @author TheShark34
 * @package S-Update-Server\Internal
 * @version 3-(Base-2.0.0-BETA)
 */
abstract class CheckMethod {

    /**
     * Returns the name of the CheckMethod (need to be the same
     * as the one of the client version of the CheckMethod)
     */
    public abstract function getName();

    /**
     * Create an array of the infos of a file, that will be parsed
     * with the client checkmethod FileInfos class
     */
    public abstract function createFileInfos($file);

}
