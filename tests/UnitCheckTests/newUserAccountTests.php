<?php

    /**
     * This is the new user account test file
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

    // test for the successful new user
    // account creation
    function createNewUserAccountTest() {
        global $database;
        global $unitCheck;
        global $user;
        global $helper;

        $test = new UnitCheckTest("TEST - New User Account Created");
        $unitCheck->addTest($test);

        $uID = $user->createNewUserAccount("Tom", "Kaczocha",
                        "freedomdeveloper@yahoo.com", "password");

        // register admin
        $result = $user->registerAdmin($uID);
        
        //echo "<br />LAST ID: ".$uID;
        $data = $user->getUserDataSetByID($uID);

        $test->failUnless($data['email'] == "freedomdeveloper@yahoo.com",
                "Error: New User Account Creation Failed");

    }

    // test verifies Email function
    // for correct functionality
    function validateEmailTest() {
        global $database;
        global $unitCheck;
        global $user;

        $emailTest = 0;

        $test = new UnitCheckTest("TEST - Validate Email");
        $unitCheck->addTest($test);

        $email1 = "freedomdeveloper@yahoo.com";
        $email2 = "free@yahoo";
        $email3 = "@yahoo.com";

        $result = $user->emailCheck($email1);
        if ($result == TRUE) {
            $emailTest++;
        }

        $result = $user->emailCheck($email2);
        if ($result == TRUE) {
            $emailTest++;
        }

        $result = $user->emailCheck($email3);
        if ($result == TRUE) {
            $emailTest++;
        }

        $test->failUnless($emailTest == 1,
                "Error: Email Validation Failed");

    }

    // test verifies validate Password
    // function for correct functionality
    function validatePasswordTest() {
        global $database;
        global $unitCheck;
        global $user;

        $passTest = 0;

        $test = new UnitCheckTest("TEST - Validate Password");
        $unitCheck->addTest($test);

        $pass1 = "vision";
        $pass2 = "free";
        $pass3 = "freeee";
        $pass4 = "";

        $result = $user->validatePassword($pass1, $pass1); // valid
        if ($result == TRUE) {
            $passTest++;
        }

        $result = $user->validatePassword($pass1, $pass3); // invalid
        if ($result == TRUE) {
            $passTest++;
        }

        $result = $user->validatePassword($pass3, $pass4); // invalid
        if ($result == TRUE) {
            $passTest++;
        }

        $test->failUnless($passTest == 1,
                "Error: Password Validation Failed");

    }

    // test ensures no duplicate
    // email accounts are created
    function duplicateEmailTest() {
        global $database;
        global $unitCheck;
        global $user;

        $count = 0;
        $newEmail = "freedomdeveloper@yahoo.com";

        $test = new UnitCheckTest("TEST - Duplicate User Account Creation Prevented");
        $unitCheck->addTest($test);

        $result = $user->userEmailExists($newEmail);

        if ($result == FALSE) {
            $user->createNewUserAccount("Tom", "Kaczocha",
                    "freedomdeveloper@yahoo.com", "password");

            $resultSet = $user->getUserResultSet();

            while ($data = $database->fetchArray($resultSet, MYSQL_ASSOC)) {
                if ($data['email'] == $newEmail) {
                    $count++;
                }
            }
        }
        else {
            
        }

        $test->failUnless($count == 0,
                "Error: Duplicate User Account Created");

    }

    // test ensures that when the first user
    // is created after the database is created
    // that user becomes an admin
    function firstUserIsAdminTest() {
        global $database;
        global $unitCheck;
        global $user;

        $userID = 1;

        $test = new UnitCheckTest("TEST - First User Is Admin");
        $unitCheck->addTest($test);

        $result = $user->isUserAdmin($userID);
        
        $test->failUnless($result,
                "Error: No Admin Created");

    }

?>
