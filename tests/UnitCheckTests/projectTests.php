<?php

    /**
     * This is the new project test file
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

    // this function tests for the successful
    // creation of a new project
    function newProjectTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - New Project Created");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());

            $project = new UnitCheckProject();

            $project->createNewProject("UnitTesting");

            $data = $project->getProjectDataSetByName("UnitTesting");

            // clean up
            $database->dropDatabase('tests');
        }

        $test->failUnless($data['project_name'] == 'UnitTesting',
                "Error: New Project Creation Failed");

    }

    // test the successful addition of
    // user to project
    function addUserToProjectTest() {
        global $database;
        global $unitCheck;
        global $user;
        global $helper;

        $regProject = 0;

        $test = new UnitCheckTest("TEST - User Added to Project");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());

            // create new user
            $uID = $user->createNewUserAccount("Tom", "Kaczocha",
                            "freedomdeveloper@yahoo.com", "password");
            if ($uID == 1) {

                // new project object
                $project = new UnitCheckProject();

                // create a new project
                $project->createNewProject("UnitTesting");

                // get project data
                $data = $project->getProjectDataSetByName("UnitTesting");
                $pID = $data['project_id'];
                //echo "<br />TEST -- addUserToProjectTest() pID: " . $pID . "<br />";
                // add user to project - FAILING
                $result = $user->addUserToProject($pID);
                //echo "<br />TEST - addUserToProjectTest() Result: " . $result . "<br /><br />";


                $data = $user->getUserProjects($user->getUserID());

                foreach ($data as $row) {
                    if ($row['project_id'] == $pID) {
                        $regProject = $row['project_id'];
                    }
                }

                $data = $project->getProjectDataSetByID($regProject);
            }
        }

        $test->failUnless($data['project_name'] == "UnitTesting",
                "Error: Failed to add User to Project");

        // clean up
        $database->dropDatabase('tests');

    }

    // test checks for the successful test
    // directory creation for new project
    function addNewProjectDirectoryTest() {
        global $database;
        global $unitCheck;
        $res = 0;

        $test = new UnitCheckTest("TEST - New Project Directory Created");
        $unitCheck->addTest($test);

        $project = new UnitCheckProject();

        $result = $project->createProjectDirectory("UnitTesting");

        $dir = "../tests/UnitTestingTests";

        $test->failUnless((is_dir($dir)),
                "Error: New Project Directory Creation Failed");

        // clean up
        removeProjectDirectory("UnitTesting");

    }

    // test makes sure that a duplicate
    // project is not created in the database
    function duplicateProjectTest() {
        global $database;
        global $unitCheck;

        $count = 0;
        $newProject = "UnitTesting";

        $test = new UnitCheckTest("TEST - Duplicate Project Creation Prevented");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());

            $project = new UnitCheckProject();

            // create new project
            $project->createNewProject("UnitTesting");

            // check to make sure project exists already
            $result = $project->projectExists($newProject);
            //echo "TEST - duplicateProjectTest - projectExists() Result: " . $result . "<br />";

            if ($result == FALSE) {
                $project->createNewProject("UnitTesting");

                // create new project
                $resultSet = $project->getProjectResultSet();

                while ($data = $database->fetchArray($resultSet, MYSQL_ASSOC)) {
                    if ($data['project_name'] == "UnitTesting") {
                        $count++;
                    }
                }
            }
            $database->dropDatabase('tests');
        }



        $test->failUnless($count == 0,
                "Error: Duplicate Project Created");

    }

    // test makes sure that project data
    // is retrieved properly
    function projectDataRetrievedTest() {
        global $database;
        global $unitCheck;
        $status = 0;

        $test = new UnitCheckTest("TEST - Project Data Retrieved");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());

            $project = new UnitCheckProject();

            // create new project
            $pID = $project->createNewProject("UnitTesting");

            $data = $project->getProjectDataSetByID($pID);

            if (($data['project_id'] == 1) && ($data['project_name'] == 'UnitTesting')) {
                $status = TRUE;
            }

            $database->dropDatabase('tests');
        }

        $test->failUnless($status,
                "Error: Project data not retrieved");

    }

    // test makes sure that project data
    // is retrieved properly
    function projectIDSetAsMainProject4UserTest() {
        global $database;
        global $unitCheck;
        global $user;

        $testResult = "";
        $uID = 1;
        $pID = 1;

        $test = new UnitCheckTest("TEST - Project ID Set As Main");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());

            // create new user
            $uID = $user->createNewUserAccount("Tom", "Kaczocha",
                            "freedomdeveloper@yahoo.com", "password");
            if ($uID == 1) {
                // add user to project
                $result = $user->addUserToProject($pID);

                $data = $user->getUserDataSetByID($uID);

                $testResult = $test->assertEquals($data['mainproject_id'], 1);
            }
            // clean up
            $database->dropDatabase('tests');
        }

        $test->failUnless($testResult,
                "Error: Failed to Set Project ID as Main");

    }

    // test makes sure that project data
    // is retrieved properly
    function updateAsMainProjectTest() {
        global $database;
        global $unitCheck;
        global $user;
        $helper = new UnitCheckHelper();

        $cMain = 2;
        $nMain = 1;
        $status = FALSE;
        $userProject = "";

        $test = new UnitCheckTest("TEST - Update as Main Project");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());

            // create a new user
            $uID = $user->createNewUserAccount("John", "Main",
                            "developer@yahoo.com", "password");

            // create a new project object
            $project = new UnitCheckProject();

            // create a new project
            $pID = $project->createNewProject("UnitTesting");

            $result = $user->addUserToProject($pID, $user);
            $userPID = $user->getUserProjectID();

            $nPID = $project->createNewProject("Check");

            $result = $user->addUserToProject($nPID, $user);
            $userPID = $user->getUserProjectID();

            $result = $user->updateMainProject($nMain);

            $data = $user->getUserDataSetByID($uID);
            $userProject = $data['mainproject_id'];
            
            // clean up
            $database->dropDatabase('tests');
        }

        $test->failUnless($userProject == $nMain,
                "Error: Failed to Update Main Project");

    }

    // test makes sure that project name
    // is updated successfully
    function updateProjectNameTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Update Project Name");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {
            mysql_select_db('tests', $database->getConnection());
            
            // create a new project object
            $project = new UnitCheckProject();

            // create a new project
            $pID = $project->createNewProject("UnitTesting");

            $pName = "TestingUnit";
            $result = $project->updateProjectNameByID($pID, $pName);

            $data = $project->getProjectDataSetByID($pID);

            if ($data['project_name'] == "TestingUnit") {
                $status = TRUE;
            }
            else {
                $status = 0;
            }
            
            // clean up
            $database->dropDatabase('tests');
        }

        $test->failUnless($status,
                "Error: Failed to Update Project Name");

    }

?>
