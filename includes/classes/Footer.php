<?php

/**
 * Footer class is a template for Footer objects.
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
class Footer {

    public function __construct() {

    }

    public function __destruct() {

    }

    public static function printFooter() {

        echo    '<div id="footer">
                    <hr />
                    <p>Copyright &copy; 2010 Tom Kaczocha</p>
                    <p>Please Report Bugs to <a href="mailto:freedomdeveloper@yahoo.com?subject=SiteTester Project Bug" title="Bug Reporting">Project Developer</a></p>
                </div> <!-- END footer -->
            </body>
        </html>';
    }

}
