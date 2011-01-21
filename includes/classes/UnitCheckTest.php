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
         * Project ID
         *
         * @access private
         * @var String
         */
        private $_projectID;
        /**
         * Test Name
         *
         * @access private
         * @var String
         */
        private $_testName;
        /**
         * Test function invocation name
         *
         * @access private
         * @var String
         */
        private $_functionName;
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
        private $_suiteID;
        /**
         * Active status
         *
         * @access private
         * @var String
         */
        private $_active;
        /**
         * Test Error Message
         *
         * @access private
         * @var String
         */
        private $_errMessage;
        /**
         * Comments
         *
         * @access private
         * @var String
         */
        private $_comments;
        /**
         * Last Modified date
         *
         * @access private
         * @var String
         */
        private $_lastMod;

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
            $this->_functionName = $data['function_name'];
            $this->_author = $data['test_author'];
            $this->_suiteID = $data['suite_id'];
            $this->_active = $data['test_active'];
            $this->_comments = $data['comments'];
            $this->_errMessage = $data['error_message'];
            $this->_projectID = $data['project_id'];
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
                return 0;
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
                return 0;
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
                return 0;
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
        public function addNewTest($testName, $testBody, $functionName, $errorMessage, $testAuthor, $projectID, $status, $comments, $testSuite = 0) {
            global $database;

            $query = "INSERT INTO tests
                      SET test_name = '" . $testName . "',
                          test_body = '" . $testBody . "',
                          function_name = '" . $functionName . "',
                          error_message = '" . $errorMessage . "',
                          project_id = '" . $projectID . "',
                          test_author = '" . $testAuthor . "',
                          suite_id = '" . $testSuite . "',
                          status = '" . $status . "',
                          comments = '" . $comments . "';";

            //echo "<br /><b>New Test Query:</b><br />" . $query . "<br /><br />";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                $tID = $database->getLastID();
                return $tID;
            }
            else {
                return 0;
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
         * @return DataSet|Boolean Test DataSet if successful,
         * else FALSE
         *
         */
        public function getTestDataSetByID($tID) {
            global $database;

            $query = "SELECT *
                      FROM tests
                      WHERE test_id = '" . $tID . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data;
            }
            else {
                return 0;
            }

        }

        /**
         * Function validates test function body
         * to criteria
         *
         * @param String Test Function Body
         * @access public
         *
         * @return Boolean TRUE if successful,
         * else FALSE
         *
         */
        public function validateTestBody($functionBody) {

            // test for the word 'function at the start'

            $result = strpos($functionBody, "function");
            //echo "'function' word check Result: " . $result . "<br />";

            if (!is_bool($result)) { // string contains the word 'function'
                // test for opening and closing braces
                $openBrace = substr_count($functionBody, "{");
                $closeBrace = substr_count($functionBody, "}");

                //echo "'{' check Result: " . $openBrace . "<br />";
                //echo "'}' check Result: " . $closeBrace . "<br />";

                $openPer = strpos($functionBody, "(");
                $closePer = strpos($functionBody, ")");

                if ((!is_bool($openPer)) && (!is_bool($closePer))) {
                    $openPos = strpos($functionBody, "{");
                    $closePos = strpos($functionBody, "}");

                    if (($openPer < $openPos) && ($closePer < $openPos)) {

                        // test for even number of braces
                        if ($openBrace == $closeBrace) {
                            return TRUE;
                        }
                        else {
                            return 0;
                        }
                    }
                    else {
                        return 0;
                    }
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
         * Function extracts name from function
         * body and formats it to specification
         *
         * @param String Test Function Body
         * @access public
         *
         * @return String|Boolean Function name if successful,
         * else FALSE
         *
         */
        public function extractFunctionName($functionBody) {
            global $helper;
            $finalFunctionName = "";
            
            // find end-position of the 'function' keyword
            $keywordLength = strlen("function");
            //echo "End position of 'function' = ".$keywordLength."<br />";
            // find end-position of the ')'
            $endOfFunction = strpos($functionBody, ")");

            $functionNameLength = ($endOfFunction - $keywordLength);
            $functionName = trim(substr($functionBody, $keywordLength + 1, $functionNameLength));
            $finalFunctionName = $helper->removeAllSpaces($functionName);

            $nameLen = strlen($finalFunctionName);
            $openPerPos = strpos($finalFunctionName, "(");
            
            //echo "( position is = " . $openPerPos . "<br />";
            //echo ") position is = " . $nameLen . "<br />";
            $finalFunctionName .= ";";
            //echo "Function name is: '" . $finalFunctionName . "'<br /><br />";

            return $finalFunctionName;

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
