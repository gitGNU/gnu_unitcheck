<?php

    /**
     * UnitCheckDirectory class is a template for UnitCheckDirectory objects.
     *
     * Copyright 	(C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     * @author	  	Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright   2010, 2011 Tom Kaczocha
     * @version	 	1.0
     * @access	 	public
     * @License	 	"GNU General Public License", version="3.0"
     *
     */
    class UnitCheckDirectory {

        /**
         * Directory array
         * Contains complete list of clients
         *
         * @access private
         * @var String
         */
        private $_client_directory;
        /**
         * Project Directory array
         * Contains complete list of directories & files
         * in the project folder.
         *
         * @access private
         * @var String
         */
        private $_project_dir = array();

        /**
         * UnitCheckDirectory Constructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __construct() {
            // initialise variables to known values
            $this->_project_dir = "0";
            $this->_client_directory = "0";

        }

        /**
         * UnitCheckDirectory Destructor
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
        public function getDirectoriesArray($dir) {
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
            }
            else { // array empty
                return FALSE;
            }

        }

        /**
         * Function gets a list of files in a directory
         *
         * @param
         * @access public
         *
         * @return String|Boolean String array of files, otherwise FALSE
         *
         */
        public function getFilesArray($dir) {
            $file_array = array();

            // open directory for reading
            //echo $dir;
            $dh = opendir($dir);

            while (!is_bool($file = readdir($dh))) {
                // test files to see if it's a file
                if (is_file("$dir/$file")) {
                    $file_array[] = $file;
                }
            }

            // close directory handle
            closedir($dh);

            // if array not empty return array
            if (!empty($file_array)) {
                return $file_array;
            }
            else { // array empty
                return FALSE;
            }

        }

        /**
         * Function gets a complete list of all files and directories in the
         * project directory.
         *
         * @param
         * @access public
         *
         * @return String|Boolean String array of directories, otherwise FALSE
         *
         */
        public function getProjectTreeArray() {
            $init_path = "../../";
            $current_directory; // holds the current working directory

            $current_dir_dirs = 0; // local array to hold dirs
            $current_dir_files = 0; // local array to hold files
            // loop through each directory getting containing
            // dirs and files

            $current_directory = $init_path; // set initial directory
            // get first level of directories
            $current_dir_dirs = $this->getDirectoriesArray($current_directory);
            //echo "<br />Dirs<br />";
            //UnitCheckHelper::printArray($current_dir_dirs);
            $this->addFilesToTreeArray("init_path", $current_dir_dirs);

            $current_dir_files = $this->getFilesArray($current_directory);
            //echo "<br />Files<br />";
            //UnitCheckHelper::printArray($current_dir_files);
            //$this->_project_dir = array_merge($current_dir_dirs, $current_dir_files);

            $temp_array = $this->_project_dir;


            // print temp array
            UnitCheckHelper::printArray($temp_array);

        }

        private function addFilesToTreeArray($element, $files) {

//			// add files to
//			foreach ($files as $file) {
//				$this->_project_dir[$element] = array_push($this->_project_dir, $file);
//			}
//
//			UnitCheckHelper::printArray($this->_project_dir);

        }

        /**
         * Function sets client directory.
         *
         * @param
         * @access public
         *
         * @return Boolean TRUE if successful, otherwise FALSE
         *
         */
        public function setClientDirectory($dir) {
            $this->_client_directory = $dir;

            if ($this->_client_directory != "0") {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function gets client directory.
         *
         * @param
         * @access public
         *
         * @return String|Boolean Client directory if successful, otherwise FALSE
         *
         */
        public function getClientDirectory() {
            if ($this->_client_directory != "0") {
                return $this->_client_directory;
            }
            else {
                return FALSE;
            }

        }

    }

    $directory = new UnitCheckDirectory();

?>
