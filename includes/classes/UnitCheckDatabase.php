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
     * My_Sql_Database class is a template for database connection objects.
     *
     * Copyright 	(c) 2010, 2011 Tom Kaczocha
     *
     * @package		
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	2.0
     * @access		public
     */
    class My_Sql_Database {

        /**
         * Magic Quotes Active Flag
         *
         * @access private
         * @var String
         */
        private $_mMagicQuotesActive;
        /**
         * Real Escape String Exists Flag
         *
         * @access private
         * @var String
         */
        private $_mRealEscapeStringExists;
        /**
         * Connection Flag
         *
         * @access private
         * @var String
         */
        private $_mConnection;
        /**
         * Last Query
         *
         * @access public
         * @var String
         */
        public $mLastquery;

        /**
         * Database Constructor
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function __construct() {
            $this->openConnection();
            $this->_mMagicQuotesActive = get_magic_quotes_gpc();
            $this->_mRealEscapeStringExists = function_exists("mysql_real_escape_string");

        }

        /**
         * Function opens a connection to the database
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function openConnection() {
            // Make the _mConnection.
            $this->_mConnection = @mysql_connect(SERVER, UNITCHECK_ADMIN, UNITCHECK_ADMIN_PASSWORD);

            if (!$this->_mConnection) {
                die('Could not connect to MYSQL: ' . mysql_error());
            }
            else {
                // Select the database
                $db_select = @mysql_select_db(DB_NAME, $this->_mConnection);
                if (!$db_select) {
                    //die('Could not select the database: ' . mysql_error());
                }
            }

        }

        /**
         * Function performs database query
         *
         * @param String $query Query
         * @access public
         *
         * @return String Result
         *
         */
        public function query($query) {
            $this->mLastquery = $query;
            $result = mysql_query($query, $this->_mConnection);
            $this->confirmQuery($result);
            return $result;

        }

        /**
         * Function closes last database connection
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public function closeConnection() {
            if (isset($this->_mConnection)) {
                mysql_close($this->_mConnection);
                unset($this->_mConnection);
            }

        }

        /**
         * Function prepares query values for input
         *
         * @param String $value Query
         * @access public
         *
         * @return String Query
         *
         */
        public function escapeValue($value) {
            if ($_mRealEscapeStringExists) {

                if ($this->_mMagicQuotesActive) {
                    $value = stripslashes($value);
                }
                $value = mysql_real_escape_string($value);
            }
            else {
                // if magic quotes aren't already on then add slashes manually
                if (!$this->_mMagicQuotesActive) {
                    $value = addslashes($value);
                }
                // if magic quotes are active, then the slashes already exist
            }
            return trim($value);

        }

        /**
         * Function retrieves data from a query result
         *
         * @param String $result Result
         * @access public
         *
         * @return DataSet Dataset
         *
         */
        public function fetchArray($result) {
            return mysql_fetch_array($result);

        }

        /**
         * Function retrieves the number of rows from resultset
         *
         * @param String $result_set ResultSet
         * @access public
         *
         * @return String Number of Rows
         *
         */
        public function numRows($result_set) {
            return mysql_num_rows($result_set);

        }

        /**
         * Function gets the number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE query
         *
         * @param
         * @access public
         *
         * @return String Number of Rows
         *
         */
        public function affectedRows() {
            return mysql_affected_rows($this->_mConnection);

        }

        /**
         * Function confirms query
         *
         * @param $result ResultSet
         * @access private
         *
         * @return
         *
         */
        private function confirmQuery($result) {
            if (!$result) {
                $output = 'Database query failed: ' . mysql_error() . '<br /><br /';
                $output .= 'Last SQL query: ' . $this->mLastquery; // debugging message
                die($output);
            }

        }

        public function getLastID() {
            return mysql_insert_id();

        }

        public function createDatabase($name) {

            $query = "CREATE DATABASE
                      IF NOT EXISTS " . $name . ";";

            $result = $this->query($query);

            return $result;

        }

        public function dropDatabase($name) {

            $query = "DROP DATABASE
                      IF EXISTS " . $name . ";";

            $result = $this->query($query);

            return $result;

        }

        public function databaseExists($db_name = "") {

            $query = "SHOW DATABASES;";

            $result = $this->query($query);

            while ($row = $this->fetchArray($result, MYSQL_NUM)) {
                if ($row[0] == $db_name) {
                    return TRUE;
                }
            }

            return FALSE;

        }

        public function tableExists($db, $table_name) {

            $query = "SHOW TABLES FROM " . $db . ";";

            $result = $this->query($query);

            while ($row = $this->fetchArray($result, MYSQL_NUM)) {
                if ($row[0] == $table_name) {
                    return TRUE;
                }
            }

            return FALSE;

        }

        public function getConnection() {
            return $this->_mConnection;

        }

        public function createSettingsTable() {

            $query = "CREATE TABLE IF NOT EXISTS settings (
                        setting_id mediumint(10) unsigned NOT NULL auto_increment,
                        project_id mediumint(10) unsigned NOT NULL,
                        setting_name varchar(60) NOT NULL,
                        setting_value varchar(10) NOT NULL,
                        setting_active int(10) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (setting_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createUsersTable() {

            $query = "CREATE TABLE IF NOT EXISTS users (
                        user_id mediumint(10) unsigned NOT NULL auto_increment,
                        mainproject_id mediumint(10) unsigned NOT NULL,
                        user_first_name varchar(60) NOT NULL,
                        user_last_name varchar(60) NOT NULL,
                        email varchar(100) NOT NULL,
                        password varchar(10) NOT NULL,
                        active int(10) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY  (user_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createProjectTable() {

            $query = "CREATE TABLE IF NOT EXISTS projects (
                        project_id mediumint(10) unsigned NOT NULL auto_increment,
                        project_name varchar(60) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (project_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createUserProjectTable() {

            $query = "CREATE TABLE IF NOT EXISTS userprojects (
                        project_id mediumint(10) NOT NULL,
                        user_id mediumint(10) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (project_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createSessionsTable() {

            $query = "CREATE TABLE IF NOT EXISTS sessions (
                        user_id mediumint(10) NULL,
                        issuedate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        session_id varchar(30) NOT NULL,
                        session_type varchar(20) NOT NULL,
                        eventdata tinytext NOT NULL,
                        browser varchar(255) NULL,
                        ip varchar(15) NULL,
                        PRIMARY KEY (session_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1";

            $result = $this->query($query);

            return $result;

        }

        public function createTestsTable() {

            $query = "CREATE TABLE IF NOT EXISTS tests (
                        test_id mediumint(10) unsigned NOT NULL auto_increment,
                        project_id mediumint(10) unsigned NOT NULL,
                        test_name varchar(60) NOT NULL,
                        test_result varchar(10) NOT NULL,
                        test_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        test_group varchar(10) NOT NULL,
                        test_active int(10) NOT NULL,
                        PRIMARY KEY (test_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createTestDataTable() {

            $query = "CREATE TABLE IF NOT EXISTS testdata (
                        testdata_id mediumint(10) unsigned NOT NULL auto_increment,
                        testdata_name varchar(60) NOT NULL,
                        testdata_value varchar(10) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (testdata_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createAdminTable() {

            $query = "CREATE TABLE IF NOT EXISTS admin (
                        admin_id mediumint(10) unsigned NOT NULL auto_increment,
                        user_id varchar(60) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (admin_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        public function createFullDatabase($name) {

            // test database
            $this->createDatabase($name);

            $this->openConnection();

            // test each table
            $dbResults[] = $this->createSettingsTable();
            $dbResults[] = $this->createUsersTable();
            $dbResults[] = $this->createProjectTable();
            $dbResults[] = $this->createUserProjectTable();
            $dbResults[] = $this->createSessionsTable();
            $dbResults[] = $this->createTestsTable();
            $dbResults[] = $this->createTestDataTable();
            $dbResults[] = $this->createAdminTable();

            foreach ($dbResults as $t) {
                if ($t == 0) {
                    return FALSE;
                }
            }

            return TRUE;
        }

    }

    $database = new My_Sql_Database();

?>