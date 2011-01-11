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

    }

    // test for successful creation of
    // settings table in database
    function settingsTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Settings Table Created");
        $unitCheck->addTest($test);

        @mysql_select_db('tests', $database->getConnection());

        $result = $database->createSettingsTable();
        
        $result = $database->tableExists("tests", "settings");

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

        @mysql_select_db('tests', $database->getConnection());

        $result = $database->createProjectTable();

        $result = $database->tableExists("tests", "projects");

        $test->failUnless($result,
                "Error: Project Table Creation Failed");

    }

    // test for successful creation of
    // projects table in database
    function usersTableCreatedTest() {
        global $database;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Users Table Created");
        $unitCheck->addTest($test);

        @mysql_select_db('tests', $database->getConnection());

        $result = $database->createUsersTable();

        $result = $database->tableExists("tests", "users");

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

        @mysql_select_db('tests', $database->getConnection());

        $result = $database->createTestsTable();

        $result = $database->tableExists("tests", "tests");

        $test->failUnless($result,
                "Error: Tests Table Creation Failed");

    }

    // test for successful creation of
    // database users
    function databaseUsersCreatedTest() {

    }

    // test that the correct priviledges
    // were gives to admin
    function databaseAdminPriviledgesTest() {

    }

    // test that the correct priviledges
    // were gives to user
    function databaseUserPriviledgesTest() {
        
    }

?>
