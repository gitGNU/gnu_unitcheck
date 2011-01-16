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

    $_SESSION['title'] = 'Edit';

    if ($user->isUserLoggedIn()) {



        // print header
        UnitCheckHeader::printHeader();

        $helper->printMessage();

?>

        <form id="create" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table cellspacing="4" cellpadding="2" border="0" >
                <tr>
                    <td colspan="3">
                        <div class="intro"></div>
                        <a id="run_tests" class="uc_common_actions" href="edittest.php">
                            <span>Edit Test</span>
                        </a>
                        <a id="history" class="uc_common_actions" href="editproject.php">
                            <span>Edit Project</span>
                        </a>
                        <a id="configure" class="uc_common_actions" href="editaccount.php?uid=<?php echo $user->getUserID(); ?>">
                            <span>Edit Account</span>
                        </a>
                    </td>
                </tr>
            </table>
        </form>





<?php

        // print footer
        UnitCheckFooter::printFooter();
    }
    else {
        $_SESSION['message'] = "You must be logged in to access this feature.";
        header("Location: index.php");
        exit();
    }

?>
