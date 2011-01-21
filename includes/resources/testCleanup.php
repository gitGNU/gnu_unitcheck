<?php

    /**
     * This is the test cleanup page
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

    function runCleanup() {
        global $database;

        // cleanup database
        $result = $database->dropDatabase('tests');

        if ($result != TRUE) {
            echo "Error: Cleanup failed to complete!<br />";
        }

        // cleanup files and directories
        $dir = "../tests/UnitTestingTests";
        if (is_dir($dir)) {
            rmdir($dir);
        }

    }

    function removeProjectDirectory($pName) {

        // cleanup files and directories
        $dir = "../tests/" . $pName . "Tests";
        
        if (is_dir($dir)) {
            rmdir($dir);
        }

    }

?>
