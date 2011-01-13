<?php

    /**
     *
     * Copyright (C) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     * UnitCheckUser class is a template for UnitCheck User objects.
     *
     * Copyright 	(c) 2010, 2011 Tom Kaczocha
     *
     * @package
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	1.0
     * @access		public
     */
    class UnitCheckUser {

        private $_userID;
        private $_user_first_name;
        private $_user_last_name;
        private $_username;
        private $_email;
        private $_password;

        public function __construct($id = 0) {
            
        }

        public function __destruct() {
            
        }

        private function initUser($uID) {
            $this->_userID = $uID;

            $data = $this->getUserDataSetByID();

            $this->_user_first_name = $data['user_first_name'];
            $this->_user_last_name = $data['user_last_name'];
            $this->_username = $data['username'];
            $this->_email = $data['email'];
            $this->_password = $data['password'];
//            echo "<pre>";
//            print_r($data);
//            echo "</pre>";

        }

        public function createNewUserAccount($fname, $lname, $uname, $email, $pass) {
            global $database;

            $query = "INSERT INTO users
                      SET user_first_name = '" . $fname . "',
                          user_last_name = '" . $lname . "',
                          email = '" . $email . "',
                          username = '" . $uname . "',
                          password = md5(" . $pass . ");";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                $uID = $database->getLastID();
                $this->initUser($uID);
                return TRUE;
            }
            else {
                return FALSE;
            }

        }

        public function getUserDataSetByID() {
            global $database;

            $query = "SELECT *
                      FROM users
                      WHERE user_id = '" . $this->_userID . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if ($data != FALSE) {
                return $data;
            }
            else {
                return FALSE;
            }

        }

    }

    $user = new UnitCheckUser();

?>
