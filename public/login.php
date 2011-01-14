<?php

    /**
     * This is the login script
     * 
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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

    if ($_POST) {
        // get POST data
        $email = $database->escapeValue($_POST['UnitCheck_login']);
        $password = $database->escapeValue($_POST['UnitCheck_password']);

        //echo "Email: " . $email . "<br />";
        //echo "Password: " . $password . "<br />";

        $result = UnitCheckUser::authenticateUser($email, $password);

        //echo "Result: ".$result."<br />";

        if ($result != FALSE) {
            $user->loginUser($result);

            $_SESSION['message'] = "You have successfully loged in.";
            header('Location: index.php');
            exit();
        }
        else {
            $_SESSION['message'] = "You have entered invalid credentials.";
            header('Location: index.php');
            exit();
        }
    }

?>
