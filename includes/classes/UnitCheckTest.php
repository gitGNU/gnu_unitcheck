<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckTest attributes and methods.
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
     * @copyright   2010, 2011 Tom Kaczocha
     * @version     1.0
     * @access	    public
     * @license     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckTest {

        /**
         * Test ID
         *
         * @access private
         * @var String
         */
        private $_testID;
        /**
         * Test Name
         *
         * @access private
         * @var String
         */
        private $_testName;
        /**
         * Test Author
         *
         * @access private
         * @var String
         */
        private $_author;
        /**
         * Test Group
         *
         * @access private
         * @var String
         */
        private $_group;
        /**
         * Test Error Message
         *
         * @access private
         * @var String
         */
        private $_errMessage;
        /**
         * Project ID
         *
         * @access private
         * @var String
         */
        private $_projectID;

        /**
         * UnitCheckTest object Constructor
         *
         * @param String Test Name
         * @access public
         *
         */
        public function __construct($test_name) {
            $this->_testName = $test_name;

//            UnitCheckTest::$totalTests = 0;
//            UnitCheckTest::$totalSuccess = 0;
//            UnitCheckTest::$totalFailure = 0;
//
//            if (!empty(self::$errMessage)) {
//                self::$testErrors[] = "Test Error";
//            }

        }

        /**
         * UnitCheckTest object Destructor
         *
         * @access public
         *
         */
        public function __destruct() {
            
        }

        /**
         * Function returns project ID
         *
         * @param String Test ID
         * @access public
         *
         * @todo Complete initTest() method
         * 
         */
        public function initTest($tID) {
            $data = getTestDataSetByID($tID);

            $this->_testID = $data['test_id'];
            $this->_testName = $data['test_name'];
            $this->_author = $data['author'];

        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function failIf($condition, $error = "") {

            if ($condition == FALSE) {
                self::$testResult[] = "FAILED";
            }
            else {
                self::$testResult[] = "PASSED";
            }

            if ((self::$errMessage != "") && ($condition == FALSE)) {
                self::$errMessage[] = $error;
            }
            else {
                self::$errMessage[] = "";
            }

        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function failUnless($condition, $error = "") {
            global $testNames;
            global $testResults;
            global $errMessages;

            if ($condition == TRUE) {
                $testResults[] = "PASSED";
            }
            else {
                $testResults[] = "FAILED";
            }

            if (($error != "") && ($condition == FALSE)) {
                $errMessages[] = $error;
            }
            else {
                $errMessages[] = "";
            }

        }

        /**
         * Function checks whether value is true
         *
         * @param String Value
         * @access public
         *
         * @return Boolean TRUE if value is true,
         * else FALSE
         *
         */
        public function assertTrue($value) {
            if ($value == TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function checks whether value is false
         *
         * @param String Value
         * @access public
         *
         * @return Boolean TRUE if value is false,
         * else FALSE
         *
         */
        public function assertFalse($value) {
            if ($value == FALSE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function checks whether two values are
         * equal
         *
         * @param String Value 1
         * @param String Value 2
         * @access public
         *
         * @return Boolean TRUE if values are equal,
         * else FALSE
         *
         */
        public function assertEquals($value1, $value2) {
            if ($value1 == $value2) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function returns Test ID
         *
         * @access public
         *
         * @return String Test ID
         *
         */
        public function getTestID() {
            return $this->_testID;

        }

        /**
         * Function returns Test Name
         *
         * @access public
         *
         * @return String Test Name
         *
         */
        public function getTestName() {
            return $this->_testName;

        }

        /**
         * Function returns Test Author
         *
         * @access public
         *
         * @return String Test Author
         *
         */
        public function getTestAuthor() {
            return $this->_author;

        }

        /**
         * Function returns Test Group
         *
         * @access public
         *
         * @return String Test Group
         *
         */
        public function getTestGroup() {
            return $this->_group;

        }

        /**
         * Function returns Test Error message
         *
         * @access public
         *
         * @return String Error Message
         *
         */
        public function getErrorMessage() {
            return $this->_errMessage;

        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function getTestProjectID() {
            return $this->_projectID;

        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function updateTestName() {
            
        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function updateErrorMessage() {
            
        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function updateTestAuthor() {
            
        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function updateTestGroup() {
            
        }

        /**
         * Function returns project ID
         *
         * @access public
         *
         * @return String Project ID
         *
         */
        public function updateTestProject() {
            
        }

        /**
         * Function adds a new test to the database
         *
         * @param String Test Name
         * @param String Test Body
         * @param String Error Message
         * @param String Test Author
         * @param String Project ID
         * @param String Status
         * @param String Test Group
         * @access public
         *
         * @return String|Boolean Project ID if successful,
         * else FALSE
         *
         */
        public function addNewTest($testName, $testBody, $errorMessage, $testAuthor, $project_id, $active, $testGroup = 0) {
            global $database;

            $query = "INSERT INTO tests (test_name, test_body, error_message, project_id, test_author, test_group, test_active)
                      VALUES ($testName, $testBody, $errorMessage, $project_id, $testAuthor, $testGroup, $active);";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                $tID = $database->getLastID();
                return $tID;
            }
            else {
                return FALSE;
            }

        }

        /**
         * Function removes a test from the
         * database
         *
         * @access public
         *
         */
        public function removeTest() {
            global $database;

            $query = "UPDATE tests
                      SET active = '0'
                      WHERE test_id = '" . $this->_testID . "'";

            $result = $database->query($query);

        }

        /**
         * Function returns Test DataSet by ID
         *
         * @param String Test ID
         * @access public
         *
         * @return String Project ID
         *
         */
        public function getTestDataSetByID($tID) {
            global $database;

            $query = "";

            $result = $database->query($query);

        }

        /**
         * Function returns Test DataSet by
         * Name
         *
         * @param String Test Name
         * @access public
         *
         * @return DataSet Test DataSet
         *
         */
        public function getTestDataSetByName($testName) {
            
        }

    }

?>
