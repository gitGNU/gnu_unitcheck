<?php

    /**
     * This is the token file.
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

    $_SESSION['title'] = 'Create a new user account for \'' . $_SESSION['email'] . '\'';


    if ($_POST) {

        $_SESSION['message'] = "The user account ".$_SESSION['email']." has been
            created successfully.";

        header('Location: index.php');
    }

    // print header
    UnitCheckHeader::printHeader();

?>

<p> To create your account, you must enter a password in the form below.
        Your email address and Real Name (if provided) will be shown with changes
        you make.
</p>

<form id="confirm_account_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <th align="right">Email Address:</th>
                <td><?php echo $_SESSION['email']; ?></td>
            </tr>
            <tr>
                <th align="right">
                    <label for="firstname">First Name:</label>
                </th>
                <td>
                    <input id="firstname" type="text" value="" name="firstname" />
                </td>
            </tr>
            <tr>
                <th align="right">
                    <label for="lastname">Last Name:</label>
                </th>
                <td>
                    <input id="lastname" type="text" value="" name="lastname" />
                </td>
            </tr>
            <tr>
                <th align="right">
                    <label for="password1">Type your password:</label>
                </th>
                <td>
                    <input id="password1" type="password" value="" name="password1" />
                    (minimum 6 characters)
                </td>
            </tr>
            <tr>
                <th align="right">
                    <label for="password2">Confirm your password:</label>
                </th>
                <td>
                    <input id="password2" type="password" value="" name="password2" />
                </td>
            </tr>
            <tr>
                <th align="right">&nbsp;</th>
                <td>
                    <input id="confirm" type="submit" value="Send" />
                </td>
            </tr>
        </table>
</form>
<p>
        This account will not be created if this form is not completed by //date\\.
</p>
<p>
        If you do not wish to create an account with this email click the cancel
        account button button below and your details will be forgotten.
</p>
<form id="cancel_account_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input id="confirm" type="submit" value="Cancel Account" />
</form>

<?php

    // print footer
    UnitCheckFooter::printFooter();

?>

