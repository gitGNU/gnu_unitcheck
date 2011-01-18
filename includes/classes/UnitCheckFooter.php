<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckFooter attributes and methods.
     *
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @package         UnitCheck
     * @copyright	(C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
    
    /**
     * @package     UnitCheck
     * @author	    Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright   2010, 2011 Tom Kaczocha
     * @version     1.0
     * @access	    public
     * @license     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckFooter {

        /**
         * UnitCheckFooter Constructor
         *
         * @access public
         *
         */
        public function __construct() {
            
        }

        /**
         * UnitCheckFooter Destructor
         *
         * @access public
         *
         */
        public function __destruct() {
            
        }

        /**
         * Function prints UnitCheck footer
         *
         * @access public
         *
         */
        public static function printFooter() {

            echo '</div> <!-- END unitcheck-body -->
                  <div id="footer">
                    <div class="intro"></div>
                    <ul id="useful-links">
                        <li id="links-actions">
                            <ul class="links">
                                <li>
                                    <a href="../public/index.php">Home</a>
                                </li>
                                <li>
                                    <span class="separator">| </span>
                                    <a href="../public/new.php">Add New</a>
                                </li>
                                <li>
                                    <span class="separator">| </span>
                                    <a href="../public/edit.php">Edit</a>
                                </li>
                                <li>
                                    <span class="separator">| </span>
                                    <a href="../public/configure.php">Configure</a>
                                </li>
                                <li>
                                    <span class="separator">| </span>
                                    <a href="../public/reports.php">Reports</a>
                                </li>
                                    <span class="separator">| </span>
                                    Copyright &copy; 2010, 2011 Tom Kaczocha
                                </li>
                                <li>
                                    <span class="separator">| </span>
                                    <a href="mailto:freedomdeveloper@yahoo.com?subject=UnitCheck Project Bug" title="Bug Reporting">Report Bugs</a>
                                </li>
                                <li>
                                    <span class="separator">| </span>
                                    <a href="../docs/API/index.html" target="_blank">API</a>
                                </li>';


//                                <li id="valid">
//                                    <a href="http://validator.w3.org/check?uri=referer" target="_blank"><img src="' . IMAGE_PATH . DS . 'valid-xhtml10.png" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
//                                </li>
            echo '</ul>
                        </li>
                    </ul>
                    <div class="outro"></div>
                </div> <!-- END footer -->
            </body>
        </html>';

        }

    }

