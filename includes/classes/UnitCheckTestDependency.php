<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckTestDependency attributes and
     * methods.
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

    /**
     * UnitCheckTestDependency class is a template for UnitCheckTestDependency
     * objects.
     *
     * @package         UnitCheck
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	(C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @license         GNU General Public License, version 3.0
     * @version 	1.0
     * @access		public
     */
    class UnitCheckTestDependency {

        /**
         * Dependency ID
         *
         * @access private
         * @var String
         */
        private $_dependencyID;
        /**
         * Dependency Value
         *
         * @access private
         * @var String
         */
        private $_value;
        /**
         * Test ID
         *
         * @access private
         * @var String
         */
        private $_testID;
        /**
         * Last Modified Date
         *
         * @access private
         * @var String
         */
        private $_lastMod;

        /**
         * UnitCheck Test Dependency Constructor
         *
         * @param String Test ID
         * @access public
         *
         */
        public function __construct($testID) {
            $this->initDependency($testID);

        }

        /**
         * UnitCheck Test Dependency Destructor
         *
         * @access public
         *
         */
        public function __destruct() {
            
        }

        /**
         * Function initialises the Test Dependency Object
         *
         * @param $tID String Test ID
         * @access private
         *
         */
        private function initDependency($tID) {
            $data = getDependencyDataSetByID($dID);

            $this->_dependencyID = $data['dependency_id'];
            $this->_value = $data['dependency_value'];
            $this->_testID = $data['test_id'];
            $this->_lastMod = $data['lastmod'];

        }

        /**
         * Function gets the Test Dependency DataSet
         *
         * @param $dID String Dependency ID
         * @access public
         *
         * @return DataSet|Boolean Dependency DataSet or FALSE if unsuccessful
         *
         */
        public function getDependencyDataSetByID($dID) {
            global $database;

            $query = "SELECT *
                  FROM testdepdencies
                  WHERE dependency_id = '" . $dID . "'";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function adds a new Test Dependency to database
         *
         * @param $tID String Test ID
         * @param $value String Dependency value
         * @access public
         *
         * @return Boolean TRUE if successful, FALSE if unsuccessful
         *
         */
        public function addNewDependencyByTestID($tID, $value) {
            global $database;

            $query = "INSERT INTO testdependencies (test_id, dependency_value)
                      VALUES ($tID, $value);";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function removes a test dependency from the database
         *
         * @param $tID String Test ID
         * @param $dID String Dependency ID
         * @access public
         *
         * @return Boolean TRUE if successful, FALSE if unsuccessful
         *
         */
        public function removeDependency($tID, $dID) {
            global $database;

            $query = "REMOVE FROM testdependencies
                      WHERE dependency_id = '" . $dID . "'
                      AND test_id = '" . $tID . "'
                      LIMIT 1;";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

    }

?>
