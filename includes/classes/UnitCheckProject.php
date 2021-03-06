<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckProject attributes and methods.
     *
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @package         UnitCheck
     * @copyright	(C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     */

    /** @package     UnitCheck
     * @author	    Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright   2011 Tom Kaczocha
     * @version     1.0
     * @access	    public
     * @license     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckProject {

        /**
         * Project ID
         *
         * @access private
         * @var String
         */
        private $_projectID;
        /**
         * Project Name
         *
         * @access private
         * @var String
         */
        private $_projectName;
        /**
         * Creation Date
         *
         * @access private
         * @var String
         */
        private $_creationDate;
        /**
         * Last Modified
         *
         * @access private
         * @var String
         */
        private $_lastMod;

        /**
         * UnitCheck object Constructor
         *
         * @param String Project ID
         * @access public
         *
         */
        public function __construct($pID = "") {
            if ($pID != "") {
                $this->initProject($pID);
            }

        }

        /**
         * UnitCheckProject Object Destructor
         *
         * @access public
         *
         */
        public function __destruct() {

        }

        /**
         * Function initialises a UnitCheckProject
         * object
         *
         * @param String Project ID
         * @access public
         *
         */
        private function initProject($pID) {
            $data = $this->getProjectDataSetByID($pID);

            $this->_projectID = $data['project_id'];
            $this->_projectName = $data['project_name'];
            $this->_creationDate = $data['creation_date'];
            $this->_lastMod = $data['lastmod'];

        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function getProjectID() {
            return $this->_projectID;

        }

        /**
         * Function returns Project Name
         *
         * @access public
         *
         * @return String Project Name
         *
         */
        public function getProjectName() {
            return $this->_projectName;

        }

        /**
         * Function returns Project Creation Date
         *
         * @access public
         *
         * @return String Project Creation Date
         *
         */
        public function getProjectCreationDate() {
            return $this->_creationDate;

        }

        /**
         * Function returns the project's last modified
         * date
         *
         * @access public
         *
         * @return String Last Modified Date
         *
         */
        public function getProjectModDate() {
            return $this->_lastMod;

        }

        /**
         * Function adds a new project to the
         * database
         *
         * @param Stirng Project Name
         * @access public
         *
         * @return Boolean TRUE if successful, else FALSE
         *
         */
        public function createNewProject($pName) {
            global $database;

            $query = "INSERT INTO projects
                      SET project_name = '" . $pName . "',
                          creation_date = NOW();";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                $pID = $database->getLastID();
                $this->initProject($pID);

                // create project test directory
                //$result = $this->createProjectDirectory($pName);

                if ($result == TRUE) {
                    return $pID;
                }
                else {
                    return 0;
                }
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns project DataSet by Project
         * Name
         *
         * @param String Project Name
         * @access public
         *
         * @return DataSet|Boolean Project DataSet or FALSE
         * if unsuccessful
         *
         */
        public function getProjectDataSetByName($pName) {
            global $database;

            $query = "SELECT *
                      FROM projects
                      WHERE project_name = '" . $pName . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if ($data != FALSE) {
                return $data;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns project DataSet by Project ID
         *
         * @param String Project ID
         * @access public
         *
         * @return DataSet|Boolean Project DataSet or FALSE
         * if unsuccessful
         *
         */
        public function getProjectDataSetByID($pID) {
            global $database;

            $query = "SELECT *
                      FROM projects
                      WHERE project_id = '" . $pID . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if ($data != FALSE) {
                return $data;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns a project ResultSet
         *
         * @access public
         *
         * @return ResultSet Project ResultSet
         *
         */
        public static function getProjectResultSet() {
            global $database;

            $query = "SELECT *
                      FROM projects;";

            $result = $database->query($query);

            if ($result != FALSE) {
                return $result;
            }
            else {
                return 0;
            }

        }

        /**
         * Function creates a Project Directory
         *
         * @param String Project Name
         * @access public
         *
         * @return Boolean TRUE if project exists, else FALSE
         *
         */
        public function createProjectDirectory($projectName) {

            $dir = "../tests/" . $projectName . "Tests";

            if (is_dir($dir) == FALSE) {
                mkdir($dir, 0777);
            }

            if (is_dir($dir)) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function checks whether a project exists
         *
         * @param String Project Name
         * @access public
         *
         * @return Boolean TRUE if project exists, else FALSE
         *
         */
        public function projectExists($pName) {
            global $database;

            $query = "SELECT *
                      FROM projects
                      WHERE project_name = '" . $pName . "'";

            $result = $database->query($query);

            if ($database->numRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function updates project name by ID
         *
         * @param String Project ID
         * @param String New Project Name
         * @access public
         *
         * @return Boolean TRUE if project exists, else FALSE
         *
         */
        public function updateProjectNameByID($pID, $pName) {
            global $database;

            $query = "UPDATE projects
                      SET project_name = '" . $pName . "'

                      WHERE project_id = '" . $pID . "'";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

    }

?>
