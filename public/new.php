<?php

    /**
     * This is the new project file
     *
     * Copyright (C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com.au>
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
     * @package
     * @author          Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @version 	1.0
     * @access          public
     * @License         "GNU General Public License", version="3.0"
     *
     */
    require_once('../includes/initialise.php');

    $_SESSION['title'] = 'New Project Wizard';

    if ($user->isUserLoggedIn()) {

        // check for database
        $result = $database->databaseExists("unitcheck");

        if ($result == TRUE) { // database exists -> this is a new project
            // check if admin is logged in
            $projectName = $database->escapeValue($_POST['projectname']);

            if ($projectName != "") {
                // register project
                $project = new UnitCheckProject();

                // make sure project name is unique
                $result = $project->projectExists($projectName);
                if ($result == FALSE) {

                    $result = $project->createNewProject($projectName);

                    if ($result == FALSE) { // project registration successful
                        $_SESSION['message'] = "Failed to Register project '" . $projectName . "'
                        Please try again later.";
                        header("Location: new.php");
                        exit();
                    }
                    else {
                        $_SESSION['message'] = "Project '" . $projectName . "'
                        was successfully registered.";

                        // add user to project
                        $data = $project->getProjectDataSetByName($projectName);
                        //echo "Last Project ID: ".$pID;

                        $result = $user->addUserToProject($data['project_id']);
                        //echo "Adding user to Project Result: ".$result;
                        //die("HERE");
                        if ($result == TRUE) { // project created and user added to project
                            header("Location: index.php");
                            exit();
                        }
                        else { // project created but failed to add user to project
                            $_SESSION['message'] = "Failed to add user to '" . $projectName . "'.";
                            header("Location: index.php");
                            exit();
                        }
                    }
                }
                else {
                    $_SESSION['message'] = "Project '" . $projectName . "' already exists.
                    Please use a unique project name.";
                    header("Location: new.php");
                    exit();
                }
            }
        }
        else { // database does nto exist
            // create database
            $result = $database->createFullDatabase(DB_NAME);

            if ($result) {
                // redirect the user to open a new admin account
                header("Location: createaccount.php?t=a");
                exit();
            }
            else {

            }
        }


        // print header
        UnitCheckHeader::printHeader();

        $helper->printMessage();

?>

        <form id="create" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table cellspacing="4" cellpadding="2" border="0">
                <tr>
                    <td colspan="3">
                        <h3>New Project</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p>
                            You can use this wizard to start a new project. If this is your
                            first project, UnitCheck will create all the required database
                            tables and will guide you through the general project setup.
                        </p>
                        <p>
                            If a project already exists, a new project will be added
                            to UnitCheck. The new project will be designated as the
                            'current' project.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th align="right">
                        <label for="projectname">Project Name:</label>
                    </th>
                    <td>
                        <input id="projectname" type="text" value="" name="projectname" />
                    </td>
                </tr>

                <tr>
                    <th align="right">&nbsp;</th>
                    <td>
                        <input id="confirm" type="submit" value="Next" />
                    </td>
                </tr>
            </table>
        </form>





<?php

        // print footer
        UnitCheckFooter::printFooter();
    }
    else {
        $_SESSION['message'] = "You must be logged in to create a new project.";
        header("Location: index.php");
        exit();
    }

?>

