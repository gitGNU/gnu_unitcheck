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
    $uID = 0;

    if ($user->isUserLoggedIn()) {
        $logedin = TRUE;
        $uID = $user->getUserID();
    }
    else {
        $logedin = FALSE;
    }

    UnitCheckHeader::printHeader();

    $helper->printMessage();

    $resultSet = UnitCheckProject::getProjectResultSet();

?>

<div id="page-index">
        <table id="page_table">
            <tr>
                <td rowspan="1">
                    <h1 id="welcome"> Welcome to UnitCheck</h1>
                    <div class="intro"></div>
                    <a id="run_tests" class="uc_common_actions" href="runTests.php?u=<?php echo $uID; ?>">
                        <span>Run Tests</span>
                    </a>
                    <a id="configure" class="uc_common_actions" href="new.php">
                        <span>Add New</span>
                    </a>
                    <a id="history" class="uc_common_actions" href="edit.php">
                        <span>Edit</span>
                    </a>
                </td>
                <td style="max-width: 100px;">
                    <h3 align="left">Current Projects</h3>
                    <table id="project_table" cellspacing="4" cellpadding="2" border="0">
                        <tr>
                            <th>Project Name:</th>
                            <!--<th>Number of Tests:</th>-->
                        </tr>


                    <?php

                        while ($data = $database->fetchArray($resultSet, MYSQL_ASSOC)) {

                            if ($data['project_id'] == $user->getUserProjectID()) {

                                echo '<tr>
                                <td align="left"><img style="border: none;" src="' . IMAGE_PATH . DS . 'right.png" alt="Main Project Symbol"><a href="project.php?pid=' . $data['project_id'] . '" title="Main Project">' . $data['project_name'] . '</a></td><td>&nbsp;</td>';
                                echo '</tr>';
                            }
                            else {
                                echo '<tr>
                                <td align="left"><a href="project.php?pid=' . $data['project_id'] . '">' . $data['project_name'] . '</a></td><td>&nbsp;</td>';
                                echo '</tr>';
                            }
                        }

                    ?>
                    </table>
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    <form id="quickSearchForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div>
                            <input id="quickSearchMain" class="quickSearchHelpText" type="text" onblur="search" onfocus="" name="quickSearch" />
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
                <td style="text-align: left;">
                    <p>
                        Thank you for using UnitCheck.
                    </p>
                    <p>
                        UnitCheck is a PHP project testing system and is used primarily to automate unit and regression testing.
                        UnitCheck is a free software designed to assist PHP developers test their web applications.
                    </p>
                    <p>
                        Please report bugs <a href="mailto:freedomdeveloper@yahoo.com?subject=UnitCheck Project Bug" title="Bug Reporting">here</a>
                        and features you'd like to see in this implementation
                        <a href="mailto:freedomdeveloper@yahoo.com?subject=UnitCheck Project Feature Request" title="Feature Requests">here</a>
                    </p>

                </td>
                <td style="width: 200px;">
                    &nbsp;
                </td>
            </tr>
        </table>
</div> <!-- END page-index -->

<?php

                        UnitCheckFooter::printFooter();

?>