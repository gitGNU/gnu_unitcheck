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
        
        $test = new UnitCheckTest("TEST - New User Account Created");
        $unitCheck->addTest($test);

        $user->createNewUserAccount("Tom", "Kaczocha", "developer",
                "freedomdeveloper@yahoo.com", "password");

        $data = $user->getUserDataSetByID();
        
        $test->failUnless($data['username'] == "developer",
                "Error: New User Account Creation Failed");

    }

?>
