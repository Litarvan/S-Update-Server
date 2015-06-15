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

namespace SUpdateServer\LangLoader;

/**
 * The LangLoader main class
 *
 * @author TheShark34
 * @package S-Update-Server\LangLoader
 * @version 1.0.0-BETA
 */
class LangLoader {

    /**
     * The file where the current lang is saved
     */
    const CURRENT_LANG_FILE = "S-Update-Server/current.lang";

    /**
     * The default language
     */
    const DEFAULT_LANG = "en_US";

    /**
     * The current LangLoader instance
     */
    private static $langLoader;

    /**
     * The current language
     */
    private $currentLang;

    /**
     * The loaded language as an array
     */
    private $loadedLanguage;

    /**
     * Create and start LangLoader
     */
    public static function create() {
        // Creating a new LangLoader instance
        self::$langLoader = new LangLoader();

        // Starting it
        self::$langLoader->start();
    }

    /**
     * Start LangLoader, get the current lang and load it
     */
    public function start() {
        // Getting the current lang
        $currentLang = self::getCurrentLang();

        // Loading it
        $this->loadLang($currentLang);
    }

    /**
     * Sets the current lang
     *
     * @param lang
     *            The new language
     */
    public function setCurrentLang($lang) {
        // Loading the lang
        $this->loadLang($lang);

        // Setting the current lang, as the loaded lang
        $this->currentLang = $lang;

        // Saving the lang in the current lang file
        file_put_contents(self::CURRENT_LANG_FILE, $lang);
    }

    /**
     * Return the current language as saved in the file
     *
     * @return The current language
     */
    public function getCurrentLang() {
        // If the current lang isn't defined
        if(!$this->currentLang)
            // If the current lang file doesn't exist
            if(!file_exists(self::CURRENT_LANG_FILE))
                // Returning the default lang
                $this->currentLang = self::DEFAULT_LANG;

            // Else if the current lang file exists
            else
                // Setting the current lang as its content
                $this->currentLang = file_get_contents(self::CURRENT_LANG_FILE);

        // Returning the current lang
        return $this->currentLang;
    }

    private function loadLang($lang) {
        // Getting the path of the lang file
        $langFilePath = "S-Update-Server/lang/" . $lang . ".lang";

        // If the lang file doesn't exist
        if(!file_exists($langFilePath)) {
            // And no language was loaded
            if(!$this->loadedLanguage)
                // Setting the loaded language as an empty array
                $this->loadedLanguage = array();

            // Stopping
            return;
        }

        // Getting the lang file
        $langFile = fopen($langFilePath, "r");

        // Reading it line per line
        while (($line = fgets($langFile)) !== false) {
            // Splitting the line with the '='
            $splittedLine = explode("=", $line);

            // Saving with the key as all before the '=', and the string to all after the '='
            $this->loadedLanguage[$splittedLine[0]] = $splittedLine[1];
        }

        // Closing the file
        fclose($langFile);
    }

    /**
     * Gets a string from a current lang, by a given key
     *
     * @param key
     *            The key of the string to get
     * @return The read string, or an empty string if not found
     */
    public function getLangText($key) {
        // Gets the text by the key, or return null if not found
        $text = $this->loadedLanguage[$key];

        // Returning the load text
        return $text;
    }

    /**
     * Return the LangLoader instance
     *
     * @return The LangLoader instance
     */
    public static function getLangLoader() {
        return self::$langLoader;
    }

}

?>
