<?php

    /**
     * This is the reports page
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

    $_SESSION['title'] = 'UnitCheck User\'s Guide';

    UnitCheckHeader::printHeader();

?>

<div id="page-index">
        <h1>UnitCheck User's Guide</h1>

        <h3>Contents</h3>
        <ul>
            <li>Configuring UnitCheck</li>
            <li>Running Tests</li>
            <li>Viewing Reports</li>
        </ul>


</div>

<?php

    UnitCheckFooter::printFooter();

?>

