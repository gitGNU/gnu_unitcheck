<?php
/**
 * This is the Home page.
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
require_once('bug_report.php');

$_SESSION['title'] = "Welcome";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Language" content="es-ar" />
        <meta name="description" content="Generador de links con destino modificable" />
        <link href="../includes/styles/styles.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

        <title><?php echo $_SESSION['title']; ?> - UnitCheck</title>
    </head>
    <body>
        <div id="welcome">
            <h2>WELCOME</h2>
            <h2>to the</h2>
            <h1>UnitCheck</h1>
            <br /><br />
            <p>Ensure this application is located in the root directory<br />
                of your project then click the Configure button to start the application</p>
            <br /><br />
            <a href="configure.php"><input type="button" value="Configure" /></a>
            <br /><br /><br />

            <p>Copyright &copy; 2010 Tom Kaczocha</p>
            <p>Please Report Bugs</p>
    </body>
</html>

<?php
//mail($to, $subject, $message, $headers);
?>