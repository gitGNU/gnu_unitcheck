<?php

    /**
     * Test class is a template for Test objects.
     *
     * Copyright 	(c) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     * @copyright   2010, 2011 Tom Kaczocha
     * @version 	1.0
     * @access	    public
     * @License     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckTest {

        private $_testID;
        private $_testName;
        private $_author;
        private $_group;
        private $_errMessage;
        private $_projectID;

//        //public static $testErrors = array();
//        private static $totalTests;
//        private static $totalSuccess;
//        private static $totalFailure;

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

        public function __destruct() {

        }

        public function initTest() {
            $data = getTestDataSetByID($tID);

        }

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

        public function assertTrue($value, $error = "") {
            if ($value == TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function assertFalse($value, $error = "") {
            if ($value == FALSE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function assertEquals($value1, $value2) {
            if ($value1 == $value2) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function getTestID() {
            return $this->_testID;

        }

        public function getTestName() {
            return $this->_testName;

        }

        public function getTestAuthor() {
            return $this->_author;

        }

        public function getTestGroup() {
            return $this->_group;

        }

        public function getErrorMessage() {
            return $this->_errMessage;

        }

        public function getTestProjectID() {
            return $this->_projectID;

        }

        public function updateTestName() {

        }

        public function updateErrorMessage() {

        }

        public function updateTestAuthor() {

        }

        public function updateTestGroup() {

        }

        public function updateTestProject() {

        }

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

        public function removeTest() {
            global $database;

            $query = "UPDATE tests
                      SET active = '0'
                      WHERE test_id = '".$this->_testID."'";

            $result = $database->query($query);
            
        }

        public function getTestDataSetByID($tID) {
            global $database;

            $query = "";

        }

        public function getTestDataSetByName($testName) {
            
        }

    }

?>
