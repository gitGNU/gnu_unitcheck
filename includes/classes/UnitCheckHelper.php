<?php

    /**
     * Session class is a template for Session objects.
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
     * @version 	2.0
     * @access	public
     * @License     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckHelper {

        /**
         * UnitCheckHelper Constructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __construct() {

        }

        /**
         * UnitCheckHelper Destructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __destruct() {

        }

        /**
         * Function prints formatted contents of arrays
         * 
         * @param String $array
         * @access public
         * @static
         * @return
         *
         */
        public static function printArray($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';

        }

    }

?>
