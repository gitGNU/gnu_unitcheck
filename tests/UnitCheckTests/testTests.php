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

    // test ensures that the new test name was added
    // to the database successfully
    function newTestNameAddedTest() {
        $database = new UnitCheckDatabase();
        $unitCheck = new UnitCheck();

        $test = new UnitCheckTest("TEST - New Test Name Added");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('UnitTesting');

        if ($result) {
            //$finalUnitCheck = new UnitCheck();
            //$finalTest = new UnitCheckTest("Test - New User Created");
            //$finalUnitCheck->addTest($finalTest);



            $database->dropDatabase("UnitTesting");
        }

        $test->failUnless($testResult = FALSE,
                "Error: Failed to Add New Name to Database");

    }

    // test the successful addition of
    // new tests
    function addNewTestTest() {
        $database = new UnitCheckDatabase();
        $unitCheck = new UnitCheck();
        $helper = new UnitCheckHelper();

        $testResult = 0;

        $testName = "Test - New Super Power Added";
        $temp = "function NewSuperPowerAddedTest() {\$test = new UnitCheckTest(\"TEST - Blah blah\");}";
        $testBody = $database->escapeValue($temp);
        $functionName = "NewSuperPowerAddedTest()";
        $errorMessage = "Error - New Super Power Not Added";
        $testAuthor = "Tom Kaczocha";
        $projectID = 1;
        $active = 1;
        $comments = "This is a test of a test";

        //echo ($testBody);
        $test = new UnitCheckTest("TEST - New Test Added");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            //mysql_select_db('tests', $database->getConnection());

            $project = new UnitCheckProject();

            $project->createNewProject("UnitTesting");

            $tID = $test->addNewTest(
                            $testName,
                            $testBody,
                            $functionName,
                            $errorMessage,
                            $testAuthor,
                            $projectID,
                            $active,
                            $comments);

            $data = $test->getTestDataSetByID($tID);
            //$helper->printArray($data);
            if ($data != FALSE) {
                if (($data['test_id'] == $tID) &&
                        ($data['test_name'] == $testName) &&
                        ($data['project_id'] == 1)) {
                    $testResult = 1;
                }
                else {
                    $testResult = 0;
                }
            }
            else {
                $testResult = 0;
            }

            //$database->dropDatabase('tests');
        }

        $test->failUnless($testResult,
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

    // test validates test body according to
    // criteria
    // criter to be tested for
    //    * contains the word 'function'
    //    * number of braces is greater then 0 &
    //      even number
    function validateTestBody() {
        $database = new UnitCheckDatabase();
        $unitCheck = new UnitCheck();
        $testResult = 0;

        $test = new UnitCheckTest("TEST - Test Function Body Valid");
        $unitCheck->addTest($test);

        $temp1 = "function testFunctionBody() {\$test = new UnitCheckTest(\"test name\")}";
        $temp2 = "testFunctionBody() {\$test = new UnitCheckTest(\"test name\")}";
        $temp3 = "function testFunctionBody() {\$test = new UnitCheckTest(\"test name\")";
        $temp4 = "function testFunctionBody {\$test = new UnitCheckTest(\"test name\")}";

        $functionBody1 = $database->escapeValue($temp1);
        $functionBody2 = $database->escapeValue($temp2);
        $functionBody3 = $database->escapeValue($temp3);
        $functionBody4 = $database->escapeValue($temp4);

        $result1 = $test->validateTestBody($functionBody1);
        $result2 = $test->validateTestBody($functionBody2);
        $result3 = $test->validateTestBody($functionBody3);
        $result4 = $test->validateTestBody($functionBody4);

//        echo "<br />Result 1: " . $result1 . "<br />";
//        echo "Result 2: " . $result2 . "<br />";
//        echo "Result 3: " . $result3 . "<br />";
//        echo "Result 4: " . $result4 . "<br />";

        if (($result1 == TRUE) && ($result2 == FALSE) && ($result3 == FALSE) && ($result4 == FALSE)) {
            $testResult = TRUE;
        }
        else {
            $testResult = FALSE;
        }

        $test->failUnless($testResult,
                "Error: Failed to Validate Function Test Body");

    }

    // test checks for the successful
    // extraction of function name from
    // function body
    function extractFunctionNameTest() {
        global $database;
        global $unitCheck;

        $testResult = 0;

        $test = new UnitCheckTest("TEST - Function Name Retrieved");
        $unitCheck->addTest($test);

        $temp1 = "function   testFunctionBody1() {\$test = new UnitCheckTest(\"test name\")}";
        $temp2 = "function    testFunctionBody2 () {\$test = new UnitCheckTest(\"test name\")}";
        $temp3 = "function     testFunctionBody3(       ) {\$test = new UnitCheckTest(\"test name\")}";


        $functionBody1 = $database->escapeValue($temp1);
        $functionBody2 = $database->escapeValue($temp2);
        $functionBody3 = $database->escapeValue($temp3);

        $fName1 = $test->extractFunctionName($functionBody1);
        $fName2 = $test->extractFunctionName($functionBody2);
        $fName3 = $test->extractFunctionName($functionBody3);

//        echo "Function name is: '" . $fName1 . "'<br />";
//        echo "Function name is: '" . $fName2 . "'<br />";
//        echo "Function name is: '" . $fName3 . "'<br />";

        if (($fName1 == "testFunctionBody1();") &&
                ($fName2 == "testFunctionBody2();") &&
                ($fName3 == "testFunctionBody3();")) {
            $testResult = TRUE;
        }
        else {
            $testResult = 0;
        }

        $test->failUnless($testResult,
                "Error: Failed to Retrieve Function Name");

    }

?>
