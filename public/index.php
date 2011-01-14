<?php

    /**
     * This is the Home page.
     *
     * Copyright (C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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

    $_SESSION['title'] = "Welcome";
    
    if ($user->isUserLoggedIn()) {
//        echo "User is logged in with user ID of: ".$user->getUserID();
    }else {
//        echo "User is not logged in.";
    }

    UnitCheckHeader::printHeader();

    $helper->printMessage();

?>

<div id="page-index">
        <table id="page_table">
            <tr>
                <td>
                    <h1 id="welcome"> Welcome to UnitCheck</h1>
                    <div class="intro"></div>
                    <a id="run_tests" class="uc_common_actions" href="runTests.php">
                        <span>Run Tests</span>
                    </a>
                    <a id="configure" class="uc_common_actions" href="configure.php">
                        <span>Configure</span>
                    </a>
                    <a id="history" class="uc_common_actions" href="reports.php">
                        <span>Reports</span>
                    </a>
                    <form id="quickSearchForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div>
                            <input id="quickSearchMain" class="quickSearchHelpText" type="text" onblur="" onfocus="" name="quickSearch" />
                            <input id="find" type="submit" value="Quick Search" />
                            <ul id="quickSearchLinks" class="additional_links">
                                <li>
                                    <a href="quicksearchhelp.php">Quick Search Help</a>
                                </li>
                            </ul>
                            <ul class="additional_links">
                                <li>
                                    <a href="../docs/using.php">UnitCheck User's Guide</a>
                                </li>
                                <li>
                                    |
                                    <a href="../docs/release_notes.php">Release Notes</a>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <div class="outro"></div>
                </td>    
            </tr>
        </table>
</div> <!-- END page-index -->

<?php

    UnitCheckFooter::printFooter();

?>