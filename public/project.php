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

    $pID = 0;
    $main = FALSE;

    if ($_GET) {
        // get project ID
        $pID = $_GET['pid'];

        if ($_GET['op'] == 'main') {
            // make this project the main project
            $main = TRUE;
        }

        $project = new UnitCheckProject($pID);

        $_SESSION['title'] = 'Project: ' . $project->getProjectName();
    }

    if ($user->isUserLoggedIn()) {

        if ($main == TRUE) {
            $result = $user->updateMainProject($pID);
//            "<br />Update Result: " . $result;
            if ($result == TRUE) {
                $_SESSION['message'] = "This project is now the main project.";
                header("Location: project.php?pid=" . $pID);
                exit();
            }
        }

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
        <tr>
            <td>
                <a href="project.php?pid=<?php echo $pID; ?>&op=main"><input type="button" value="Main" title="Make this the Main Project"></a>
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
