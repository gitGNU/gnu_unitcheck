<?php

    /**
     *
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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

    /**
     * UnitCheck class is a template for UnitCheck objects.
     *
     * Copyright 	(C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
     *
     * @package
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2011 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	1.0
     * @access		public
     */
    class UnitCheckTestDependency {

        private $_dependencyID;
        private $_value;
        private $_testID;
        private $_lastMod;

        public function __construct($testID) {
            $this->initDependency($testID);

        }

        public function __destruct() {
            
        }

        private function initDependency($tID) {
            $data = getDependencyDataSetByID($dID);

            $this->_dependencyID = $data['dependency_id'];
            $this->_value = $data['dependency_value'];
            $this->_testID = $data['test_id'];
            $this->_lastMod = $data['lastmod'];

        }

        public function getDependencyDataSetByID($dID) {
            global $database;

            $query = "SELECT *
                  FROM testdepdencies
                  WHERE dependency_id = '" . $dID . "'";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data;
            }
            else {
                return FALSE;
            }

        }

    }

?>
