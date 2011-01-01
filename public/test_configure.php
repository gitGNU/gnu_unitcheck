<?php
/**
 * This page is used to configure the tests.
 *
 * Copyright 	(c) 2010 Tom Kaczocha
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
 * @author	Tom Kaczocha <freedomdeveloper@yahoo.com>
 * @copyright	2010 Tom Kaczocha
 * @version 	1.0
 * @access	public
 * @License     "GNU General Public License", version="3.0"
 *
 */
require_once('../includes/initialise.php');

$_SESSION['title'] = 'Tests';


if (isset($_POST['site_name'])) {
    Header("Location='tests.php'");
} else {
    
}

// print header
UnitCheckHeader::printHeader();

// print navigation
require_once('navigation.php');
?>
<div id="content">
    <h3>Tests</h3>

    <div id="add_test_form">
        <form method="post" action="test_configure.php">

            <label>Test Type:</label>
            <input type="text" name="site_name" value="<?php if (isset($_POST['site_name']))
    echo $_POST['site_name']; ?>" /><br />
            <label>Other:</label>
            <input type="text" name="x" value="<?php if (isset($_POST['x']))
    echo $_POST['x']; ?>" /><br /><br />
            <input type="submit" name="new_test_client" value="New Test" />
            <input type="reset" name="reset" value="Reset" />
        </form>
    </div>
</div> <!-- END content -->

<?php
require_once('test_monitor.php');

// print footer
UnitCheckFooter::printFooter();
?>
