<?php

    /**
     * This the database test file
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

    // test for successful creation of
    // database
    function databaseCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Database Created");
        $unitCheck->addTest($test);

        $database->createDatabase('tests');

        $result = $database->databaseExists("tests");

        $test->failUnless($result,
                "Error: Database Creation Failed");

        $database->dropDatabase('tests');

    }

    // test for successful creation of
    // settings table in database
    function settingsTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Settings Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createSettingsTable();

            $result = $database->tableExists("tests", "settings");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: Settings Table Creation Failed");

    }

    // test for successful creation of
    // users table in database
    function projectTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Project Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createProjectTable();

            $result = $database->tableExists("tests", "projects");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: Project Table Creation Failed");

    }

    // test for successful creation of
    // users table in database
    function userProjectTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - UserProject Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createUserProjectTable();

            $result = $database->tableExists("tests", "userprojects");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: UserProject Table Creation Failed");

    }

    // test for successful creation of
    // projects table in database
    function usersTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Users Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createUsersTable();

            $result = $database->tableExists("tests", "users");


            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: Users Table Creation Failed");

    }

    // test for successful creation of
    // tests table in database
    function testsTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Tests Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createTestsTable();

            $result = $database->tableExists("tests", "tests");

            $test->failUnless($result,
                    "Error: Tests Table Creation Failed");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

    }

    // test for successful creation of
    // tests table in database
    function sessionsTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Sessions Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createSessionsTable();

            $result = $database->tableExists("tests", "sessions");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: Sessions Table Creation Failed");

    }

    // test for successful creation of
    // testdata table in database
    function testDataTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - TestData Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {

            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createTestDataTable();

            $result = $database->tableExists("tests", "testdata");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: TestData Table Creation Failed");

    }

    // test for successful creation of
    // admin table in database
    function adminTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Admin Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {

            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createAdminTable();

            $result = $database->tableExists("tests", "admin");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: Admin Table Creation Failed");

    }

    // test for successful creation of
    // testdependencies table in database
    function testDependenciesTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Dependencies Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createTestDependenciesTable();

            $result = $database->tableExists("tests", "testdependencies");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

        $test->failUnless($result,
                "Error: Test Dependencies Table Creation Failed");

    }

    // test for successful creation of
    // testdata table in database
    function testResultsTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Test Results Table Created");
        $unitCheck->addTest($test);

        $result = $database->createDatabase('tests');

        if ($result) {
            @mysql_select_db('tests', $database->getConnection());

            $result = $database->createTestResultsTable();

            $result = $database->tableExists("tests", "testresults");

            $test->failUnless($result,
                    "Error: Test Results Table Creation Failed");

            $database->dropDatabase('tests');
        }
        else {
            $result = 0;
        }

    }

    // test for successful creation of
    // full database
    function fullDatabaseCreatedTest() {
        global $database;
        global $unitCheck;

        $numTables = 10;
        $result = 0;
        $dbResults = array();

        $test = new UnitCheckTest("TEST - Full Database Created");
        $unitCheck->addTest($test);

        $result = $database->createFullDatabase('tests');

        if ($result) {

            
        }
        else {
            $result = 0;
        }

        $test->failUnless($result == $numTables,
                "Error: Full Database Creation Failed");

        $database->dropDatabase('tests');

    }

?>
