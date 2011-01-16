<?php

     /**
     * This is the tests test file
     *
     * Copyright (C) 2011 Tom Kaczocha
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
    require_once('../includes/initialise.php');

    // test the successful addition of
    // new tests
    function addNewTestTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - New Test Added");
        $unitCheck->addTest($test);

                

        $test->failUnless($result,
                "Error: Addition of New Test Failed");

    }

    // test the successful retrieval
    // of test dataset
    function testDataSetRetrievedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test DataSet Retrieved");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Retrieve Test DataSet");

    }

    // test the successful retrieval
    // of test dataset
    function testResultSetRetrievedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test ResultSet Retrieved");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Retrieve Test ResultSet");

    }

    // test the successful retrieval
    // of last test date
    function lastTestDateRetrievedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Last Test Date Retrieved");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Retrieve Last Test Date");

    }

    // test the successful addition of test
    // dependencies
    function addedTestDependenciesTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Added Test Dependencies");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Add Test Dependencies");

    }

    // test the successful addition of test
    // body
    function addedTestBodyTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Added Test Body");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Add Test Body");

    }

    // test the successful addition of test
    // error message
    function addedTestErrorMessageTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Added Test Error Message");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Add Test Error Message");

    }

    // test the successful addition of test
    // name
    function addedTestNameTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Added Test Name");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Add Test Name");

    }

    // test the successful addition of test
    // project id
    function addedTestProjectIDTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Added Test Project ID");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Add Test Project ID");

    }

    // test the successful addition of test
    // author
    function addedTestAuthorTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Added Test Author");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Add Test Author");

    }

    // test the successful update of test
    // name
    function updatedTestNameTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Name Updated");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Update Test Name");

    }

    // test the successful update of test
    // dependencies
    function updatedTestDependenciesTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Dependencies Updated");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Update Test Dependencies");

    }

    // test the successful update of test
    // error message
    function updatedTestErrorMessageTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Error Message Updated");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Update Test Error Message");

    }

    // test the successful update of test
    // body
    function updatedTestBodyTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Body Updated");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Update Test Body");

    }

    // test the successful update of test
    // author
    function updatedTestAuthorTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Author Updated");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Update Test Author");

    }

    // test the successful update of test
    // project ID
    function updatedTestProjectIDTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Project ID Updated");
        $unitCheck->addTest($test);



        $test->failUnless($result,
                "Error: Failed to Update Test Project ID");

    }

    // test checks for the successful
    // extraction of function name from
    // function body
    function getFunctionNameTest() {
        global $database;
        global $unitCheck;

        $string1 = "function updatedTestProjectIDTest() {global database;}";
        $string2 = "updatedTestProjectIDTest;";
        $string3 = "updatedTestProjectIDTest(\$var1, \$var2)";

        $successString = "updatedTestProjectIDTest()";

        $test = new UnitCheckTest("TEST - Function Name Retrieved");
        $unitCheck->addTest($test);

        

        $test->failUnless($resultString == $successString,
                "Error: Failed to Retrieve Function Name");

    }

?>
