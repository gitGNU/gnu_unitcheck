<?php
/**
     * This is the login test file
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


    // test for the successful user
    // login
    function userSuccessfullyLoggedInTest() {
        global $database;
        global $user;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - User Login Successful");
        $unitCheck->addTest($test);

        // get user id for test
        $user_id = 1;

        $user->loginUser($user_id);

        $test->failUnless($user->isUserLoggedIn(),
                "Error: User not Logged in");
    }
?>
