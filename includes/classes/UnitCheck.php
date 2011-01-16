<?php

    /**
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
     */

    /**
     * UnitCheck class is a template for UnitCheck objects.
     *
     * Copyright 	(C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
     *
     * @package
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2011 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	1.0
     * @access		public
     */
    class UnitCheck {

        private $_tests = array();
        private $_projectName;

        public function __construct() {

        }

        public function __destruct() {
            
        }

        public function addTest(UnitCheckTest $test) {
            global $testNames;
            global $testResults;
            
            if (is_object($test)) {
                $testNames[] = $test->getTestName();
                if (count($testNames) == 1) {
                    $tname = $testNames[0];
                    //die ("There's one test in array - ".$tname);
                }
            }
            else {
                die("Not an object");
            }

        }

        public function displayTestList() {

            echo "Number of Tests: " . count($this->_tests);
            $test = $this->_tests[0];


            echo "<pre>";
            print_r($test);
            echo "</pre>";

            if (!empty($test)) {
                foreach ($test as $t) {
                    echo "Test Name: " . $t;
                }
            }
            else {

                echo "<br />Unable to print Test<br />";
            }

        }

        public function removeTest(Test $test) {
            
        }

        public function getTests() {
            return $this->_tests;

        }

        public function printResults() {
            global $testNames;
            global $testResults;
            global $errMessages;

            $totalTests = 0;
            $totalSuccess = 0;
            $totalFailure = 0;
            $i = 0; // local counter variable


            echo '<table style="width:900px; border:0; margin-left:100px; font-size:12px;">
                  <tr>
                  <td colspan="2"><b><center>*****  Test Data Successfully Retrieved  *****</center></b></td>
                  </tr>

                    <tr>
                  <td colspan="2"><b><center>*****  Running Tests  *****</center></b></td>
                  </tr>';

            foreach ($testNames as $test) {

                if (($errMessages[$i] != "") && ($errMessages != NULL)) {
                    echo '<tr>
                    <td style="width:600px;color:red;">' . $test . ' - ' . $errMessages[$i] . '</td>';
                }
                else {
                    echo '<tr>
                    <td style="width:600px;">' . $test . '</td>';
                }


                if ($testResults[$i] == "PASSED") {
                    $r = 'style="color:green; font-weight:bold; font-size:12px;"';
                    $totalSuccess++;
                }
                else {
                    $r = 'style="color:red; font-weight:bold; font-size:12px;"';
                    $totalFailure++;
                }

                echo '<td ' . $r . '>' . $testResults[$i] . '</td>';
                echo '</tr>';
                $totalTests++;
                $i++;
            }

            echo '<tr>
                <td colspan="2"><b><center>*****  Tests Completed  *****</center></b></td>
              </tr>
              <tr>
                <td><b>Number of Tests Run:</td>
                <td>' . $totalTests . '</td>
              </tr>
                <td><b>Success:</b></td>
                <td>' . $totalSuccess . '</td>
              </tr>
              <tr>
                <td><b>Failed:</b></td>
                <td>' . $totalFailure . '</td>
            </tr>
           </table>';

        }

    }

    $unitCheck = new UnitCheck();

?>
