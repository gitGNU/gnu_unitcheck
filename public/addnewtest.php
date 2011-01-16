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

    $_SESSION['title'] = 'Add New Test';

    if ($user->isUserLoggedIn()) {

        if ($_POST) { // form has been submitted
            // prepare strings
            $testName = "TEST - ";
            $errorMessage = "Error - ";

            // get project name
            foreach ($_POST['projectname'] as $value) {
                $projectID = $value;
            }

            $testName .= $database->escapeValue($_POST['testname']);
            $errorMessage .= $database->escapeValue($_POST['errormessage']);
            $active = $database->escapeValue($_POST['active']);
            $dependencies = $database->escapeValue($_POST['dependencies']);
            $testBody = $database->escapeValue($_POST['testbody']);

            // get author name
            foreach ($_POST['authorname'] as $value) {
                $authorName = $value;
            }

            if ($active != "") {
                $testActive = 1;
            }
            else {
                $testActive = 0;
            }

            // get function name
            //$fName = $test->getFunctionName();


            $test = new UnitCheckTest($testName);
            $unitCheck->addTest($test); // this may not be required at this point

//            $result = $test->addNewTest($testName, $testBody, $errorMessage, $authorName, $projectID, $testActive);
//
//            if ($result > 0) {
//                // add dependencies for test ID
//                // $dependencies
//
//            }
//            else {
//                $_SESSION['message'] = "System error - unable to add test.";
//                header("Location: index.php");
//                exit();
//            }
        }


        // print header
        UnitCheckHeader::printHeader();

        $helper->printMessage();

        if ($_POST) {
            //echo "<pre>";
            echo '<table style="background-color:white; margin:30px; padding: 30px;"><tr><td>';
            echo "<br /><b>Project ID:</b><br />" . $projectID;
            echo "<br /><br /><b>Test Name:</b><br />" . $testName;
            echo "<br /><br /><b>Error Message:</b><br />" . $errorMessage;
            echo "<br /><br /><b>Active:</b><br />" . $active;
            echo "<pre>";
            echo "<br /><br /><b>Dependencies:</b><br />" . stripslashes($dependencies);
            echo "<br /><br /><b>Test:</b><br />" . stripslashes($testBody);
            echo "</pre>";
            echo "<br /><br /><b>Author Name:</b><br />" . $authorName;
            echo "</td></tr></table>";
        }

        $project = new UnitCheckProject($pID);

        $projResult = $project->getProjectResultSet();
        $userResult = $user->getUserResultSet();

?>

        <form id="create" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table cellspacing="4" cellpadding="2" border="0" >
                <tr>
                    <td colspan="3">
                        <h3>Add New Test</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p>
                            You can use this form to add a new test. This feature
                            is still under development, but you can add basic
                            functionality tests.
                        </p>
                        <p>
                            This form requires strict adherence to PHP syntax.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th align="right">
                        <label for="projectname">Project:</label>
                    </th>
                    <td>
                        <select name="projectname[]">
<?php

    $projectName = $user->getUserProjectName();
    $data = $project->getProjectDataSetByName($projectName);

        echo '<option selected="selected" value="' . $data['project_id'] . '">' . $projectName . '</option>';
        while ($data = $database->fetchArray($projResult)) {
            if ($data['project_name'] != $user->getUserProjectName()) {
                echo '<option value="' . $data['project_id'] . '">' . $data['project_name'] . '</option>';
            }
        }

?>
                </select>
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="testname">Test Name:</label>
            </th>
            <td><i>&ensp;Test - </i>
                <input class="required" id="testname" type="text" value="<?php echo $_POST['testname']; ?>" name="testname" size="40" />
                <label for="active">Active:</label>
                <input id="active" type="checkbox" name="active" checked="checked" value="Active" />
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="errormessage">Error Message:</label>
            </th>
            <td><i>Error - </i>
                <input class="required" id="errormessage" type="text" value="<?php echo $_POST['errormessage']; ?>" name="errormessage" size="40" />
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="dependencies">Dependencies:</label>
            </th>
            <td>
                <textarea class="required" name="dependencies" cols="70" rows="5"><?php echo $_POST['dependencies']; ?></textarea>
            </td>
            <td>
                <b>For example:</b><br />
                <i>
                    require_once("../resources/functions.php");<br />
                    include("../includes/mail.php");
                    <i/>

            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="testbody">Test Body:</label>
            </th>
            <td>
                <textarea class="required" name="testbody" cols="70" rows="20"><?php echo $_POST['testbody']; ?></textarea>
            </td>
            <td>
                <b>For example:</b><br />
                <i>
                    function databaseCreatedTest() {<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;global $database;<br /><br />

                    &nbsp;&nbsp;&nbsp;&nbsp;$database->createDatabase('tests');<br /><br />

                    &nbsp;&nbsp;&nbsp;&nbsp;$result = $database->databaseExists("tests");<br /><br />

                    &nbsp;&nbsp;&nbsp;&nbsp;$test->failUnless($result,<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;"Error: Database Creation Failed");<br /><br />

                    }
                    <i/>

            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="author">Author:</label>
            </th>
            <td>
                <select name="authorname[]">
<?php

                    echo '<option selected="selected" value="' . $user->getUserFullName() . '">' . $user->getUserFullName() . '</option>';
                    while ($data = $database->fetchArray($userResult)) {
                        if (($data['user_first_name'] . ' ' . $data['user_last_name']) != $user->getUserFullName()) {
                            echo '<option value="' . $data['user_first_name'] . ' ' . $data['user_last_name'] . '">' . $data['user_first_name'] . ' ' . $data['user_last_name'] . '</option>';
                        }
                    }

?>
                </select>
            </td>
        </tr>
        <tr>
            <th align="right">&nbsp;</th>
            <td>
                <a href="index.php"<input id="preview" type="button" value="Preview" /></a>&nbsp;&nbsp;&nbsp;
                <input id="confirm" type="submit" value="Add Test" />&nbsp;&nbsp;&nbsp;
                <input id="reset" type="reset" value="Reset" />
            </td>
            <td>

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
