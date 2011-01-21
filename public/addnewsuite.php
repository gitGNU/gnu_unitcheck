<?php

    /**
     * This is the add new test file
     *
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com.au>
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

    $_SESSION['title'] = 'Add New Suite';

    if ($user->isUserLoggedIn()) {

    

    // print header
    UnitCheckHeader::printHeader();

    $helper->printMessage();

?>

<form id="create" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table cellspacing="4" cellpadding="2" border="0" >
            <tr>
                <td colspan="3">
                    <h3>Add New Test Suite</h3>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    You can use this form to add a new test suite.
                </td>
            </tr>
            <tr>
                <th align="right">
                    <label for="testsuite">Test Suite Name:</label>
                </th>
                <td>
                    <input id="testsuite" type="text" value="" name="testsuite" />
                </td>
            </tr>

            <tr>
                <th align="right">&nbsp;</th>
                <td>
                    <input id="confirm" type="submit" value="Add Suite" />
                </td>
            </tr>
        </table>
</form>





<?php

    // print footer
    UnitCheckFooter::printFooter();
    }
    else {
        $_SESSION['message'] = "You must be logged in to create a new suite.";
        header("Location: index.php");
        exit();
    }

?>
