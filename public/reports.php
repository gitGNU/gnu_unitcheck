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

    $_SESSION['title'] = 'Report';

    if ($user->isUserLoggedIn()) {

        UnitCheckHeader::printHeader();

        $helper->printMessage();

?>

        <div id="index-page">

            <h3>Reports</h3>

        </div>

<?php

//    $tests = &$unitCheck->getTests();
//
//    if (empty($tests)) {
//        echo "\$tests is empty<br />";
//    }
//    foreach ($tests as $test) {
//        print_r($test);
//    }
        //$testnames = UnitCheck::getTestNames();
        //echo "<br />Test Name: ".$testnames."<br />";

        echo "Number of Tests: " . count($testNames) . "<br />";

        foreach ($testNames as $name) {
            echo "Test Name: " . $name . "<br />";
        }


        //$unitCheck->displayTestList();
        echo "Finished Printing Tests";
        //$unitCheck->printResults();

        UnitCheckFooter::printFooter();
    }
    else {
        $_SESSION['message'] = "You must be logged in to view your reports.";
        header("Location: index.php");
        exit();
    }

?>