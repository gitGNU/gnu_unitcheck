<?php

    /**
     * This is the project file
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

    if ($_GET) {
        $pID = $_GET['pid'];

        $project = new UnitCheckProject($pID);

        $_SESSION['title'] = 'Project - ' . $project->getProjectName();
    }

    if ($user->isUserLoggedIn()) {

        UnitCheckHeader::printHeader();

        $helper->printMessage();

?>

        <table cellspacing="4" cellpadding="2" border="0">
            <tr>
                <th>
                    Project ID:
                </th>
                <th>
                    Project Name:
                </th>
                <th>
                    Creation Date:
                </th>
                <th>
                    Last Modified:
                </th>
            </tr>
            <tr>
                <td>
            <?php echo $project->getProjectID(); ?>
            </td>
            <td>
            <?php echo $project->getProjectName(); ?>
            </td>
            <td>
                <?php echo $project->getProjectCreationDate(); ?>
            </td>
            <td>
                <?php echo $project->getProjectModDate(); ?>
            </td>
        </tr>
</table>


<?php

                UnitCheckFooter::printFooter();
            }
            else {

                $_SESSION['message'] = "You must be logged in to view project information.";
                header("Location: index.php");
                exit();
            }

?>
