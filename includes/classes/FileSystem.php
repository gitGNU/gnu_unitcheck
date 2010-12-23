<?php

/**
 * TestDirectory class is a template for TestDirectory objects.
 *
 * Copyright 	(c) 2010 Tom Kaczocha
 *
 * This file is part of UnitCheck.
 *
 * UnitCheck is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * UnitCheck is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with UnitCheck.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @package
 * @author	Tom Kaczocha <freedomdeveloper@yahoo.com>
 * @copyright	2010 Tom Kaczocha
 * @version 	1.0
 * @access	public
 * @License     "GNU General Public License", version="3.0"
 *
 */
class FileSystem {

    /**
     * directory array
     *
     * @access private
     * @var String
     */
    private $_directory;

    /**
     * TestDirectory Constructor
     *
     * @param
     * @access public
     *
     * @return
     *
     */
    public function __construct() {
        $this->_dir_ar = array();
    }

    /**
     * TestDirectory Destructor
     *
     * @param
     * @access public
     *
     * @return
     *
     */
    public function __destruct() {

    }

    /**
     * Function gets a list of directories in a directory
     *
     * @param
     * @access public
     *
     * @return String|Boolean String array of directories, otherwise FALSE
     *
     */
    public static function getDirectories($dir) {
        $dir_array = array();

        // open directory for reading
        //echo $dir;
        $dh = opendir($dir);

        while (!is_bool($file = readdir($dh))) {

            // test files read to see if it's a directory
            // disregard directories '.' & '..'
            if ((is_dir("$dir/$file") && ($file != ".") && $file != "..")) { // file is a directory
                $dir_array[] = $file;
            }
        }
        // clear cache
        clearstatcache();

        // close directory handle
        closedir($dh);

        // if array not empty return array
        if (!empty($dir_array)) {
            return $dir_array;
        } else { // array empty
            return FALSE;
        }
    }

}
?>
