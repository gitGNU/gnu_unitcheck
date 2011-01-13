<?php

    /**
     * This is the configure file.
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

    $_SESSION['title'] = 'Configure';

    $clean = 0;
    
    // print header
    UnitCheckHeader::printHeader();

    // check for previous test directories
//    $dirs = $directory->getDirectoriesArray("../projects");

//    if ($clean) {
//        $database->dropDatabase('unitcheck');
//    }
//    else {
//        $database->createDatabase('unitcheck');
//    }
?>

<h3><center>Run the Setup Wizard Now</center></h3>

<table border="0" width="100%">
        <tr>
            <td>
                <table id="menu">
                    <tr>
                        <td class="index">
                            <a title="Show all parameters" href="configure.php">Index</a>
                        </td>
                    </tr
                    <tr>
                        <td>
                            <a title="Settings that are required for proper operation of UnitCheck" href="configure.php?section=core">Required Settings</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="selected_section">
                            <span title="Miscellaneous general settings that are not required.">General</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a title="Set up project policies" href="configure.php?section=project">Project Policies</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a title="Report Policies" href="configure.php?section=reports">Reports</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a title="Database Policies" href="configure.php?section=database">Database</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a title="Email settings" href="configure.php?section=email">Email</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
</table>




<?php

    // print footer
    UnitCheckFooter::printFooter();

?>

