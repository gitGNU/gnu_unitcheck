<?php

    /**
     * This is the session test file
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

    // test to ensure that session is created when
    // user enters site
    function isSessionCreatedTest() {
        global $session;
        global $session_id;
        global $unitCheck;

        $test = new UnitCheckTest("TEST - Session Created");
        $unitCheck->addTest($test);

        $session->setNewSession();
        
        $session_id = $session->getSessionID();

        $test->failUnless($session_id != "",
                "Error: Session Not Created.");
    }

//    // test to ensure session is added to database
//    function isSessionAddedToDatabaseTest() {
//        global $session;
//        global $database;
//
//        $test = new Test();
//
//        $query = "SELECT sid FROM sessions
//                  WHERE sid = '" . $session->getSessionID() . "';";
//        //echo "SESSION ID: ".$session->getSessionID();
//        $result = $database->query($query);
//
//        $test->failUnless("TEST - Is Session Added to Database",
//                $database->numRows($result) == 1,
//                "Error: Session not added to database.");
//
//    }
//
//    // test to ensure session is updated with
//    // user ID when user logs in
//    function isSessionUpdatedOnLoginTest() {
//        global $database;
//        global $session;
//
//        $test = new Test();
//
//
//        $test->failUnless("TEST - Session Updated on Login",
//                FALSE,
//                "Error: Session Not Updated on Login");
//
//    }
//
//    // test to ensure user ID remains in session when session
//    // is destroyed
//    function userIDRemainsInSessionTest() {
//        global $database;
//        global $user;
//        global $session;
//        global $session_id;
//
//        $test = new Test();
//
//        $query = "SELECT *
//                  FROM sessions
//                  WHERE uid = '" . ($user->getUserID() - 1) . "';";
//
//        echo "Session Query: " . $query;
//        $result = $database->query($query);
//        $data = $database->fetchArray($result);
//
//        if (!empty($data)) {
//            echo '<pre>';
//            print_r($data);
//            echo '</pre>';
//        }
//        else {
//            echo "<br />No Data Retrieved<br />";
//        }
//
//        $test->failUnless("TEST - Session Data Preserved",
//                $data['sid'] == $session_id,
//                "Error: Session Data Not Preserved");
//
//    }

?>
