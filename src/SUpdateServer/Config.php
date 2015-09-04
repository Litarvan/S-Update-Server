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


/**
 * A config class that load a config from the config folder
 *
 * @package \SUpdateServer
 * @version 3-(Base-2.0.0-BETA)
 */
class Config {

    /**
     * The name of the config
     */
    private $name;

    /**
     * The config array
     */
    private $config;

    /**
     * The config
     *
     * @param config
     *            The name of the config file (without the .php)
     */
    public function __construct($config) {
        $this->name = $config;

        if(file_exists("config/" . $config . ".json"))
            $this->config = (array) json_decode(file_get_contents("config/" . $config . ".json"));
    }

    /**
     * Return a value from the config
     *
     * @param key
     *            The key of the value to get
     *
     * @return The read value
     */
    public function get($key) {
        return $this->config[$key];
    }

    /**
     * Set a value then save the config
     *
     * @param key
     *            The key of the value to set
     * @param value
     *            The value to set
     */
    public function set($key, $value) {
        $this->config[$key] = $value;
        $this->save();
    }

    /**
     * Save the config
     */
    public function save() {
        file_put_contents("config/" . $this->name . ".json", json_encode($this->config, JSON_PRETTY_PRINT));
    }

    /**
     * Set the config name (will rename the file)
     *
     * @param name
     *            The new config name
     */
    public function setName($name) {
        rename("config/" . $this->name . ".json", "config/" . $name . ".json");
        $this->name = $name;
    }

    /**
     * Return the config name
     *
     * @return The config name
     */
    public function getName() {
        return $this->name;
    }

}

?>
