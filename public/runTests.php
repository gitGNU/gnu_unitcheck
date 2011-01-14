<?php

    /**
     * This is the reports page
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
     */
    require_once('../includes/initialise.php');

    require_once("../tests/UnitCheckTests/databaseTests.php");
    require_once("../tests/UnitCheckTests/newProjectTests.php");
    require_once("../tests/UnitCheckTests/newUserAccountTests.php");
    require_once("../tests/UnitCheckTests/sessionTests.php");
    require_once("../tests/UnitCheckTests/userLoginTests.php");
    require_once("../includes/resources/testCleanup.php");

    $_SESSION['title'] = 'Test Results';

    $testNames = array();
    $testResults = array();
    $errMessages = array();

    UnitCheckHeader::printHeader();

    $helper->printMessage();

    if ($user->isUserLoggedIn()) {
        // run PRE-cleanup
        runCleanup();

        databaseCreatedTest();
        testDataTableCreatedTest();
        adminTableCreatedTest();
        settingsTableCreatedTest();
        usersTableCreatedTest();
        projectTableCreatedTest();
        userProjectTableCreatedTest();
        testsTableCreatedTest();
        sessionsTableCreatedTest();

        isSessionCreatedTest();
        createNewUserAccountTest();
        validateEmailTest();
        validatePasswordTest();
        duplicateEmailTest();

        userSuccessfullyLoggedInTest();
        newProjectTest();
        duplicateProjectTest();
        addNewTestDirectoryTest();
        addUserToProjectTest();

        // run POST-cleanup
        runCleanup();

        fullDatabaseCreatedTest();

        runCleanup();



        // PRINT TEST RESULTS
        $unitCheck->printResults();
    }
    else {
        $_SESSION['message'] = "You must be logged in to run tests.";
        header("Location: index.php");
        exit();
    }

    UnitCheckFooter::printFooter();

    //header('Location: reports.php');

?>
