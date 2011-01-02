<?php
/**
 * This is the configure page.
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

$_SESSION['title'] = 'Configure';

require_once("../UnitCheck/run_tests.php");

// print header
UnitCheckHeader::printHeader();

// print navigation
require_once('navigation.php');

// check for previous test directories
$dirs = $directory->getDirectoriesArray("../projects");



if (!is_bool($dirs)) { // if not FALSE
    // display existing client sites
    foreach ($dirs as $dir) {
        //echo "Directory: ".$dir."<br />";
    }
} else { // not directories exist
    // configure for new test client
    
}



?>

<div id="content">
    <h3>Configure</h3>

    <h5>Site:</h5>

    <h5>Tester:</h5>

    <?php $directory->getProjectTreeArray(); ?>

    <div id="conf_form">
        <form method="post" action="test_configure.php">

            <label>Site Name:</label>
            <input type="text" name="site_name" value="<?php if (isset($_POST['site_name']))
    echo $_POST['site_name']; ?>" /><br />
            <label>Other:</label>
            <input type="text" name="x" value="<?php if (isset($_POST['x']))
                       echo $_POST['x']; ?>" /><br /><br />
            <input type="submit" name="new_test_client" value="Add New Site" />
            <input type="reset" name="reset" value="Reset" />
        </form>
    </div>
</div> <!-- END content -->

<?php
                   require_once('test_monitor.php');

// print footer
                   UnitCheckFooter::printFooter();
?>

