<?php

    require_once("unit_check_config.php");
    require_once('../includes/initialise.php');

    // function checks the successful creation of
    // Directory object
    function UnitCheck_DirectoryConstruct() {
        $fs = new UnitCheckDirectory();

        echo "Test FileSystem Construct Method";

        if (is_object($fs)) {
            echo "SUCCESS";
        }
        else {
            echo "FAIL";
        }

    }

    // Function checks for successful session
    // creation
    function UnitCheck_SessionConstruct() {
        //$session = new UnitCheckSession();

        if ($session->getSessionID() != 0) {
            echo "PASSED";
        }
        else {
            echo "FAILED";
        }

    }

    UnitCheck_DirectoryConstruct();
    UnitCheck_SessionConstruct();

    // function checks the successful creation of
    // Directory object
    function UnitCheck_DirectoryConstruct() {
        $fs = new UnitCheckDirectory();

        echo "Test FileSystem Construct Method";

        if (is_object($fs)) {
            echo "SUCCESS";
        }
        else {
            echo "FAIL";
        }

    }

    // Function checks for successful session
    // creation
    function UnitCheck_SessionConstruct() {
        $session = new UnitCheckSession();

        if ($session->getSessionID() != 0) {
            echo "PASSED";
        }
        else {
            echo "FAILED";
        }

    }

?>
