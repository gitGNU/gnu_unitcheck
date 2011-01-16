<?php

    /**
     * This is the new project file
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

    $_SESSION['title'] = 'Edit Account';

    if ($user->isUserLoggedIn()) {
        $uID = "";

        if ($_GET['uid']) {
            $uID = $_GET['uid'];
        }

        if ($_POST) {
            $fName = $database->escapeValue($_POST['firstname']);
            $lName = $database->escapeValue($_POST['lastname']);
            $email = $database->escapeValue($_POST['email']);
            $nPassword1 = $database->escapeValue($_POST['newpassword1']);
            $nPassword2 = $database->escapeValue($_POST['newpassword2']);
            $currentPass = $database->escapeValue($_POST['currpassword']);

            if ($fName != "") {
                if ($lName != "") {
                    if ($email != "") {
                        if (($nPassword1 != "") || (nPassword2 != "")) {
                            // ensure new passwords match
                            if ($user->validatePassword($nPassword1, $nPassword2)) {
                                if ($user->verifyPassword($currentPass)) {
                                    $result = $user->updateUserPassword($nPassword1);

                                    if ($result == FALSE) {
                                        $_SESSION['message'] = "Error - System error occurred. Your account was not updated.";
                                        header("Location: index.php");
                                        exit();
                                    }
                                }
                                else {
                                    $_SESSION['message'] = "Error - Your current password is invalid.";
                                    header("Location: editaccount.php?uid=" . $uID);
                                    exit();
                                }
                            }
                            else {
                                $_SESSION['message'] = "Error - New passwords do not match.";
                                header("Location: editaccount.php?uid=" . $uID);
                                exit();
                            }
                        }
                        // update profile
                        if ($user->verifyPassword($currentPass)) {
                            $result = $user->updateProfile($fName, $lName, $email);

                            if ($result == FALSE) {
                                $_SESSION['message'] = "Error - System error occurred. Your account was not updated.";
                                header("Location: index.php");
                                exit();
                            }
                        }
                        else {
                            $_SESSION['message'] = "Error - Your current password is invalid.";
                            header("Location: editaccount.php?uid=" . $uID);
                            exit();
                        }
                    }
                    else {
                        $_SESSION['message'] = "Error - Email field is blank.";
                        header("Location: editaccount.php?uid=" . $uID);
                        exit();
                    }
                }
                else {
                    $_SESSION['message'] = "Error - Last Name field is blank.";
                    header("Location: editaccount.php?uid=" . $uID);
                    exit();
                }
            }
            else {
                $_SESSION['message'] = "Error - First Name field is blank.";
                header("Location: editaccount.php?uid=" . $uID);
                exit();
            }

            $_SESSION['message'] = "Your account was successfully updated.";
            header("Location: index.php");
            exit();
        }


        // print header
        UnitCheckHeader::printHeader();

        $helper->printMessage();

        $data = $user->getUserDataSetByID($_GET['uid']);

?>

        <form id="confirm_account_form" action="<?php echo $_SERVER['PHP_SELF'] . '?uid=' . $uID; ?>" method="post">
            <table>
                <tr>
                    <td>
                        <h3>Edit Account</h3>
                    </td>
                </tr>
                <tr>
                    <th align="right">
                        <label for="firstname">First Name:</label>
                    </th>
                    <td>
                        <input id="firstname" type="text" value="<?php

        if ($_POST) {
            echo $_POST['firstname'];
        }
        else {
            echo $data['user_first_name'];
        }

?>" name="firstname" />
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="lastname">Last Name:</label>
            </th>
            <td>
                <input id="lastname" type="text" value="<?php

                       if ($_POST) {
                           echo $_POST['lastname'];
                       }
                       else {
                           echo $data['user_last_name'];
                       }

?>" name="lastname" />
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="email">Email:</label>
            </th>
            <td>
                <input id="email" type="text" value="<?php

                       if ($_POST) {
                           echo $_POST['email'];
                       }
                       else {
                           echo $data['email'];
                       }

?>" name="email" />
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="newpassword1">Type your new password:</label>
            </th>
            <td>
                <input id="newpassword1" type="password" value="" name="newpassword1" />
                (minimum 6 characters)
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="newpassword2">Confirm your new password:</label>
            </th>
            <td>
                <input id="newpassword2" type="password" value="" name="newpassword2" />
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <th align="right">
                <label for="currpassword">Type your current password:</label>
            </th>
            <td>
                <input id="currpassword" type="password" value="" name="currpassword" />
            </td>
        </tr>
        <tr>
            <th align="right">&nbsp;</th>
            <td>
                <input id="confirm" type="submit" value="Update" />
            </td>
        </tr>
    </table>
</form>

<?php

                       // print footer
                       UnitCheckFooter::printFooter();
                   }
                   else {
                       $_SESSION['message'] = "You must be logged in to edit your account.";
                       header("Location: index.php");
                       exit();
                   }

?>
