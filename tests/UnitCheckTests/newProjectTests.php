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

        $project = new UnitCheckProject();

        $project->createNewProject("UnitTesting");

        $data = $project->getProjectDataSetByName("UnitTesting");

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

        // new project object
        $project = new UnitCheckProject();

        // get project data
        $data = $project->getProjectDataSetByName("UnitTesting");
        $pID = $data['project_id'];

        // add user to project
        $result = $user->addUserToProject($pID);

        $data = $user->getUserProjects($user->getUserID());

        foreach ($data as $row) {
            if ($row['project_id'] == $pID) {
                $regProject = $row['project_id'];
            }
        }

        $data = $project->getProjectDataSetByID($regProject);

        $test->failUnless($data['project_name'] == "UnitTesting",
                "Error: Failed to add User to Project");

    }

    // test checks for the successful test
    // directory creation for new project
    function addNewTestDirectoryTest() {
        global $database;
        global $unitCheck;
        $res = 0;

        $test = new UnitCheckTest("TEST - New Project Directory Created");
        $unitCheck->addTest($test);

        $project = new UnitCheckProject();


        $result = $project->createProjectDirectory("UnitTesting");

        $dir = "../tests/UnitTestingTests";

        if (is_dir($dir)) {
            $res = TRUE;
        }
        else {
            $res = FALSE;
        }

        $test->failUnless((is_dir($dir)),
                "Error: New Project Directory Creation Failed");

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

        $project = new UnitCheckProject();

        $result = $project->projectExists($newProject);

        if ($result == FALSE) {
            $project->createNewProject("UnitTesting");

            $resultSet = $project->getProjectResultSet();

            while ($data = $database->fetchArray($resultSet, MYSQL_ASSOC)) {
                if ($data['project_name'] == "UnitTesting") {
                    $count++;
                }
            }
        }
        else {

        }

        $test->failUnless($count == 0,
                "Error: Duplicate Project Created");

    }

    // test makes sure that project data
    // is retrieved properly
    function projectDataRetrievedTest() {
        global $database;
        global $unitCheck;

        $pID = 1;

        $test = new UnitCheckTest("TEST - Project Data Retrieved");
        $unitCheck->addTest($test);

        $project = new UnitCheckProject($pID);

        $pID = $project->getProjectID();
        $pName = $project->getProjectName();
        $pCreation = $project->getProjectCreationDate();
        $pMod = $project->getProjectModDate();

        if (($pID != "") && ($pName != "") && ($pCreation != "") && ($pMod != "")) {
            $status = TRUE;
        }
        else {
            $status = FALSE;
        }


        $test->failUnless($status == TRUE,
                "Error: Project data not retrieved");
    }

?>
