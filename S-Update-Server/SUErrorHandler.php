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

namespace SUpdateServer;

/**
 * The S-Update-Server Error Handle, handle the errors and display
 * an emergency error page.
 *
 * @author TheShark34
 * @package Paladin
 * @version 2.0.0-BETA
 */
class SUErrorHandler {

    /**
     * The default location of the error page
     */
    const DEFAULT_ERROR_PAGE = "S-Update-Server/ErrorPage.html";

    /**
     * The location of the error page
     */
    private static $errorPageLocation = self::DEFAULT_ERROR_PAGE;

    /**
     * Init the error handler
     */
    public static function init() {
        error_reporting(E_ALL);
        set_error_handler("\\SUpdateServer\\SUErrorHandler::handleError");

        $mask = E_ALL^E_NOTICE;

        if(!is_null($mask))
            $GLOBALS['error_fatal'] = $mask;
        elseif(!isset($GLOBALS['die_on']))
            $GLOBALS['error_fatal'] = 0;
    }

    /**
     * Handle an error (usually called by PHP if the init() method was called)
     *
     * @param errorno
     *            The error number
     * @param errostr
     *            The error string
     * @param errfile
     *            The file of the error
     * @param errline
     *            The line of the error
     */
    public static function handleError($errno, $errstr, $errfile, $errline) {
        $errno = $errno & error_reporting();

        if($errno == 0)
            return;
        if(!defined('E_STRICT'))
            define('E_STRICT', 2048);
        if(!defined('E_RECOVERABLE_ERROR'))
            define('E_RECOVERABLE_ERROR', 4096);

        switch($errno) {
            case E_ERROR:               $errorType = "Error";                  break;
            case E_WARNING:             $errorType = "Warning";                break;
            case E_PARSE:               $errorType = "Parse Error";            break;
            case E_NOTICE:              $errorType = "Notice";                 break;
            case E_CORE_ERROR:          $errorType = "Core Error";             break;
            case E_CORE_WARNING:        $errorType = "Core Warning";           break;
            case E_COMPILE_ERROR:       $errorType = "Compile Error";          break;
            case E_COMPILE_WARNING:     $errorType = "Compile Warning";        break;
            case E_USER_ERROR:          $errorType = "User Error";             break;
            case E_USER_WARNING:        $errorType = "User Warning";           break;
            case E_USER_NOTICE:         $errorType = "User Notice";            break;
            case E_STRICT:              $errorType = "Strict Notice";          break;
            case E_RECOVERABLE_ERROR:   $errorType = "Recoverable Error";      break;
            default:                    $errorType = "Unknown error ($errno)"; break;
        }

        $totalBacktrace = "";

        if(function_exists('debug_backtrace')) {
            $backtrace = debug_backtrace();
            array_shift($backtrace);

            foreach($backtrace as $i => $l) {
                $class = isset($l['class']) ? $l['class'] : "";
                $type = isset($l['type']) ? $l['type'] : "";
                $function = isset($l['function']) ? $l['function'] : "";
                $totalBacktrace .= "[$i] {$class}{$type}{$function} ";

                $totalBacktrace .= "(at ";
                if($l['file'])
                    $totalBacktrace .= "{$l['file']}";
                if($l['line'])
                    $totalBacktrace .= ":{$l['line']}";
                $totalBacktrace .= ')';


                $totalBacktrace .= "<br />\n";
            }
        }

        self::displayErrorPage($errorType, "$errstr <br />($errfile:$errline)", $totalBacktrace);

        if(isset($GLOBALS['error_fatal']))
            if($GLOBALS['error_fatal'] & $errno) die();

        die();
    }

    /**
     * Display an error page
     *
     * @param errorType
     *            The type of the error
     * @param errorDescription
     *            The description of the error
     * @param errorBacktrace
     *            The backtrace of the error
     */
    public static function displayErrorPage($errorType, $errorDescription, $errorBacktrace) {
        // Getting the error page
        $errorPage = file_get_contents(self::$errorPageLocation);

        // Replacing the variables, with the messages, the title, etc...
        $errorPage = str_replace("__ROOT_DIR__", \Paladin\Paladin::getRootFolder(), $errorPage);
        $errorPage = str_replace("__MESSAGE__", $errorDescription, $errorPage);
        $errorPage = str_replace("__TITLE__", $errorType, $errorPage);
        $errorPage = str_replace("__BG_LOCATION__", \Paladin\Paladin::getRootFolder() . \Paladin\PaladinTwigExtension::getFile("shared", "background.png", true, "resources"), $errorPage);
        if(function_exists('debug_backtrace'))
            $errorPage = str_replace("<!-- __BACKTRACE__ -->", $errorBacktrace, $errorPage);

        // Then diplaying it
        echo $errorPage;
    }

    /**
     * Set the location of the error page
     * It will need to have three things :
     *     - __MESSAGE__ that will be replaced with the error message
     *     - __TITLE__ that will be replaced with the error title
     *     - __BACKTRACE__ that will be replaced with the backtrace if possible, or No Informations if not
     *
     * @param errorPageLocation
     *            The new location of the error page
     */
    public static function setErrorPageLocation($errorPageLocation) {
        self::$errorPageLocation = $errorPageLocation;
    }

    /**
     * Return the location of the error page
     *
     * @return The error page location
     */
    public static function getErrorPageLocation() {
        return self::$errorPageLocation;
    }

}
