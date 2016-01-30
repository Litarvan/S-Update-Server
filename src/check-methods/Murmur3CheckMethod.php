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
 * @version 3-(Base-2.1.0-BETA)
 */
class Murmur3CheckMethod extends CheckMethod
{
    public function getName()
    {
        return "murmur3";
    }

    public function createFileInfos($filePath)
    {
        $file = SUpdateServer::FILES_DIRECTORY . "/" . urldecode($filePath);

        $handle = fopen($file, "rb");
        $fsize = filesize($file);
        $contents = fread($handle, $fsize);
        $byteArray = unpack("N*", $contents);

        return array("fileRelativePath" => $filePath, "murmur3" => murmurhash3($byteArray));
    }

    /**
     * PHP Implementation of MurmurHash3
     *
     * @author Stefano Azzolini (lastguest@gmail.com)
     * @see    https://github.com/lastguest/murmurhash-php
     * @author Gary Court (gary.court@gmail.com)
     * @see    http://github.com/garycourt/murmurhash-js
     * @author Austin Appleby (aappleby@gmail.com)
     * @see    http://sites.google.com/site/murmurhash/
     *
     * @param  array(int) $key  Bytes to hash.
     * @param  int $seed Positive integer only
     *
     * @return number 32-bit (base 32 converted) positive integer hash
     */
    function murmurhash3_int($key, $seed = 0)
    {
        $key = (array) $key;
        $klen = sizeof($key);

        $h1 = $seed;
        for ($i = 0, $bytes = $klen - ($remainder = $klen & 3); $i < $bytes;)
        {
            $k1 = ((ord($key[$i]) & 0xff)) | ((ord($key[++$i]) & 0xff) << 8) | ((ord($key[++$i]) & 0xff) << 16) | ((ord($key[++$i]) & 0xff) << 24);
            ++$i;
            $k1 = (((($k1 & 0xffff) * 0xcc9e2d51) + ((((($k1 >= 0 ? $k1 >> 16 : (($k1 & 0x7fffffff) >> 16) | 0x8000)) * 0xcc9e2d51) & 0xffff) << 16))) & 0xffffffff;
            $k1 = $k1 << 15 | ($k1 >= 0 ? $k1 >> 17 : (($k1 & 0x7fffffff) >> 17) | 0x4000);
            $k1 = (((($k1 & 0xffff) * 0x1b873593) + ((((($k1 >= 0 ? $k1 >> 16 : (($k1 & 0x7fffffff) >> 16) | 0x8000)) * 0x1b873593) & 0xffff) << 16))) & 0xffffffff;
            $h1 ^= $k1;
            $h1 = $h1 << 13 | ($h1 >= 0 ? $h1 >> 19 : (($h1 & 0x7fffffff) >> 19) | 0x1000);
            $h1b = (((($h1 & 0xffff) * 5) + ((((($h1 >= 0 ? $h1 >> 16 : (($h1 & 0x7fffffff) >> 16) | 0x8000)) * 5) & 0xffff) << 16))) & 0xffffffff;
            $h1 = ((($h1b & 0xffff) + 0x6b64) + ((((($h1b >= 0 ? $h1b >> 16 : (($h1b & 0x7fffffff) >> 16) | 0x8000)) + 0xe654) & 0xffff) << 16));
        }
        $k1 = 0;
        switch ($remainder)
        {
            case 3:
                $k1 ^= (ord($key[$i + 2]) & 0xff) << 16;
            case 2:
                $k1 ^= (ord($key[$i + 1]) & 0xff) << 8;
            case 1:
                $k1 ^= (ord($key[$i]) & 0xff);
                $k1 = ((($k1 & 0xffff) * 0xcc9e2d51) + ((((($k1 >= 0 ? $k1 >> 16 : (($k1 & 0x7fffffff) >> 16) | 0x8000)) * 0xcc9e2d51) & 0xffff) << 16)) & 0xffffffff;
                $k1 = $k1 << 15 | ($k1 >= 0 ? $k1 >> 17 : (($k1 & 0x7fffffff) >> 17) | 0x4000);
                $k1 = ((($k1 & 0xffff) * 0x1b873593) + ((((($k1 >= 0 ? $k1 >> 16 : (($k1 & 0x7fffffff) >> 16) | 0x8000)) * 0x1b873593) & 0xffff) << 16)) & 0xffffffff;
                $h1 ^= $k1;
        }
        $h1 ^= $klen;
        $h1 ^= ($h1 >= 0 ? $h1 >> 16 : (($h1 & 0x7fffffff) >> 16) | 0x8000);
        $h1 = ((($h1 & 0xffff) * 0x85ebca6b) + ((((($h1 >= 0 ? $h1 >> 16 : (($h1 & 0x7fffffff) >> 16) | 0x8000)) * 0x85ebca6b) & 0xffff) << 16)) & 0xffffffff;
        $h1 ^= ($h1 >= 0 ? $h1 >> 13 : (($h1 & 0x7fffffff) >> 13) | 0x40000);
        $h1 = (((($h1 & 0xffff) * 0xc2b2ae35) + ((((($h1 >= 0 ? $h1 >> 16 : (($h1 & 0x7fffffff) >> 16) | 0x8000)) * 0xc2b2ae35) & 0xffff) << 16))) & 0xffffffff;
        $h1 ^= ($h1 >= 0 ? $h1 >> 16 : (($h1 & 0x7fffffff) >> 16) | 0x8000);

        return $h1;
    }

    function murmurhash3($key, $seed = 0)
    {
        return base_convert(self::murmurhash3_int($key, $seed), 10, 32);
    }
}
