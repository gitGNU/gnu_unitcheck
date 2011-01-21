<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckSession attributes and methods.
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
     * @copyright 	(c) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @package         UnitCheck
     * @license         "GNU General Public License", version="3.0"
     * @author          Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @version 	1.0
     * @access          public
     *
     */
    class UnitCheckSession {

        /**
         * Session ID
         *
         * @access private
         * @var String
         */
        private $_sessionId;
        /**
         * Session Issue Date
         *
         * @access private
         * @var String
         */
        private $_issueDate;
        /**
         * Session Type
         *
         * @access private
         * @var String
         */
        private $_sessionType;
        /**
         * Event Data
         *
         * @access private
         * @var String
         */
        private $_eventData;
        /**
         * Browser
         *
         * @access private
         * @var String
         */
        private $_browser;
        /**
         * IP address
         *
         * @access private
         * @var String
         */
        private $_ip;

        /**
         * UnitCheckSession object Constructor
         *
         * @access public
         *
         */
        public function __construct() {

            session_start(); // start session
            $this->_sessionId = session_id();

        }

        /**
         * UnitCheckSession object Destructor
         *
         * @access public
         *
         */
        public function __destruct() {
            // actions to perform when session ends

        }

        /**
         * Function initialises a Session
         * object
         *
         * @access private
         *
         */
        private function initSession($sid) {
            if ($this->_sessionId != "") {
                $result = $this->checkForSession();
                if ($result == FALSE) {
                    $this->setNewSession();
                }
            }
            else {
                $this->setNewSession();
            }

        }

        /**
         * Function checks for an existing session
         * in the database
         *
         * @access public
         *
         * @return Boolean TRUE if session exists, otherwise FALSE
         *
         */
        public function checkForSession() {
            global $database; // use global database object

            $session = session_id();

            $query = "SELECT  *
                      FROM sessions
                      WHERE session_id = '" . $session . "';";

            $result = $database->query($query);

            if ($database->numRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function adds a new session to database
         *
         * @access public
         *
         * @return Boolean TRUE if session was successfully added to database
         * otherwise FALSE
         *
         */
        public function setNewSession() {
            global $database;
            global $user;

            $this->_sessionId = session_id(); // assign session id
            $this->_browser = $_SERVER['HTTP_USER_AGENT']; // assign browser
            $this->_ip = $_SERVER['REMOTE_ADDR']; // assign ip address
            // build query
            $query = "INSERT INTO sessions (session_id, user_id, browser, ip)
        			  VALUES ('" . $this->_sessionId . "',
        			  		  '" . $user->getUserId() . "',
        			  		  '" . $this->_browser . "',
        			  		  '" . $this->_ip . "');";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns Session ID
         *
         * @access public
         *
         * @return String Session ID
         *
         */
        public function getSessionID() {
            return $this->_sessionId;

        }

    }

    $session = new UnitCheckSession();

?>
