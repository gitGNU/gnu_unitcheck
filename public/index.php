<?php

/**
 * This is the Home page.
 *
 * Copyright 	(c) 2010 Tom Kaczocha
 *
 * This file is part of SiteTester.
 *
 * SiteTester is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SiteTester is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SiteTester.  If not, see <http://www.gnu.org/licenses/>.
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

$title = "Home";

Header::printHeader();

require_once('views/navigation.php');
require_once('views/content.php');
require_once('views/tests.php');
          

Footer::printFooter();
?>
