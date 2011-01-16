<?php

    /**
     * This is the create new account file
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
    //require_once('../includes/resources/mail.php');

    $_SESSION['title'] = 'Create a New UnitCheck Account';

    $adminTrue = 0;

    if (SENDMAIL) {
        // check for a responding link
        if ($_GET['new'] != "") {
            header("Location: emailSent.php");
            exit();
        }
        else {

        }
    }

    if ($_GET['t'] == 'a') {
        $adminTrue = "?t=a";
    }

    $result = $user->getAdminResultSet();

    if ($result == FALSE) {
        $adminTrue = "?t=a";
    }

    if ($_POST) {

        $email = $_POST['login'];

        $result = $user->userEmailExists($email);

        if ($result == FALSE) { // email not yet registered
            $result = $user->emailCheck($email);

            if ($result == TRUE) {
                $_SESSION['email'] = $email;

                if ($_GET['t'] == 'a') {
                    header("Location: token.php?t=a");
                    exit();
                }
                else {
                    header("Location: token.php?t=n");
                    exit();
                }
            }
            else {
                $_SESSION['message'] = "You entered an invalid email address. Please
                try again.";
                header("Location: createaccount.php");
                exit();
            }
        }
        else {
            $_SESSION['message'] = "The email address you entered is already registered. Please
                try another or click on 'forgot password' to recover your password for this account.";
            header("Location: createaccount.php");
            exit();
        }
    }




    // print header
    UnitCheckHeader::printHeader();

    $helper->printMessage();

?>

<p>
        To create a UnitCheck account, all you need to do is to enter a legitimate
        email address. You will receive an email at this address to confirm the
        creation of your account. <b>You will not be able to log in until you receive
            the email.</b> If it doesn't arrive within a reasonable amount of time, you
        may contact the maintainer of this UnitCheck installation at the following
        <a href="mailto:freedomdeveloper@yahoo.com?subject=UnitCheck Account"
           title="Contact for Account Queries">email</a>.
</p>

<form id="accountCreationForm" action="
<?php

    if ($adminTrue) {
        echo $_SERVER['PHP_SELF'] . $adminTrue;
    }
    else {
        echo $_SERVER['PHP_SELF'];
    }

?>"
      method="post">
    <table>
        <tr>
            <td align="right">
                <b>Email address:</b>
            </td>
            <td>
                <input id="login" name="login" size="35">
            </td>
        </tr>
    </table>
    <br />
    <input id="send" type="submit" value="Continue">
</form>


<?php

    //echo phpinfo();
    // print footer
    UnitCheckFooter::printFooter();

?>
