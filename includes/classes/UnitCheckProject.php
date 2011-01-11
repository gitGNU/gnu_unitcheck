<?php

    /**
     * UnitCheckProject class is a template for UnitCheck Project objects.
     *
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     * @author	    Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright   2011 Tom Kaczocha
     * @version     1.0
     * @access	    public
     * @License     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckProject {

        private $_projectID;
        private $_projectName;

        public function __construct() {

        }

        public function __destruct() {

        }

        private function initProject($pID) {
            $data = $this->getProjectDataSetByID($pID);

            $this->_projectID = $data['project_id'];
            $this->_projectName = $data['project_name'];

        }

        public function createNewProject($pName) {
            global $database;

            $query = "INSERT INTO projects
                      SET project_name = '" . $pName . "';";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                $pID = $database->getLastID();
                $this->initProject($pID);
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

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
                return FALSE;
            }

        }

        public function getProjectDataSetByID($pID) {
            global $database;

            $query = "SELECT *
                      FROM projects
                      WHERE project_name = '" . $pID . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if ($data != FALSE) {
                return $data;
            }
            else {
                return FALSE;
            }

        }

        public static function getProjectResultSet() {
            global $database;

            $query = "SELECT *
                      FROM projects;";

            $result = $database->query($query);

            if ($result != FALSE) {
                return $result;
            }
            else {
                return FALSE;
            }

        }

    }

?>
