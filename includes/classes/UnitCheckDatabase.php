<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckTestDatabase attributes and
     * methods.
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
     * My_Sql_Database class is a template for database connection objects.
     *
     * @package         UnitCheck
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
         * @access public
         *
         */
        public function __construct() {
            $this->openConnection();
            $this->_mMagicQuotesActive = get_magic_quotes_gpc();
            $this->_mRealEscapeStringExists = function_exists("mysql_real_escape_string");

            if ($this->databaseExists(DB_NAME) == FALSE) {
                $this->createFullDatabase(DB_NAME);
            }

        }

        /**
         * Function opens a connection to the database
         *
         * @access public
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
         * @param String Query
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
         * @access public
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
         * @param String Query
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
         * @param ResultSet Query ResultSet
         * @access public
         *
         * @return DataSet Query Dataset
         *
         */
        public function fetchArray($result) {
            return mysql_fetch_array($result);

        }

        /**
         * Function retrieves the number of rows from resultset
         *
         * @param ResultSet Query ResultSet
         * @access public
         *
         * @return String Number of Rows
         *
         */
        public function numRows($result_set) {
            return mysql_num_rows($result_set);

        }

        /**
         * Function gets the number of affected rows by
         * the last INSERT, UPDATE, REPLACE or DELETE query
         *
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
         * @param ResultSet Query ResultSet
         * @access private
         *
         */
        private function confirmQuery($result) {
            if (!$result) {
                $output = 'Database query failed: ' . mysql_error() . '<br /><br /';
                $output .= 'Last SQL query: ' . $this->mLastquery; // debugging message
                die($output);
            }

        }

        /**
         * Function returns last ID generated by a
         * query
         *
         * @access public
         *
         * @return String Last ID generated
         * 
         */
        public function getLastID() {
            return mysql_insert_id();

        }

        /**
         * Function builds a new database
         *
         * @param String Database Name to be built
         * @access private
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createDatabase($name) {

            $query = "CREATE DATABASE
                      IF NOT EXISTS " . $name . ";";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function drops a database
         *
         * @param String Database Name
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function dropDatabase($name) {

            $query = "DROP DATABASE
                      IF EXISTS " . $name . ";";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function checks whether a database exists
         *
         * @param String Database name
         * @access public
         *
         * @return Boolean TRUE if database exists, else FALSE
         * 
         */
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

        /**
         * Function checks whether a table exists
         * in a database
         *
         * @param String Database Name
         * @param String Table Name
         * @access public
         *
         * @return Boolean TRUE if table exists, else FALSE
         * 
         */
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

        /**
         * Function returns a database connection
         *
         * @access public
         *
         * @return Connection Database Connection ResultSet
         * 
         */
        public function getConnection() {
            return $this->_mConnection;

        }

        /**
         * Function creates a Settings table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         * 
         */
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

        /**
         * Function creates a Users table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createUsersTable() {

            $query = "CREATE TABLE IF NOT EXISTS users (
                        user_id mediumint(10) unsigned NOT NULL auto_increment,
                        mainproject_id mediumint(10) unsigned NOT NULL,
                        user_first_name varchar(60) NOT NULL,
                        user_last_name varchar(60) NOT NULL,
                        email varchar(100) NOT NULL,
                        password varchar(40) NOT NULL,
                        active int(10) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY  (user_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates a Project table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createProjectTable() {

            $query = "CREATE TABLE IF NOT EXISTS projects (
                        project_id mediumint(10) unsigned NOT NULL auto_increment,
                        project_name varchar(60) NOT NULL,
                        creation_date varchar(30) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (project_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates a UserProject table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createUserProjectTable() {

            $query = "CREATE TABLE IF NOT EXISTS userprojects (
                        project_id mediumint(10) NOT NULL,
                        user_id mediumint(10) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates a Sessions table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createSessionsTable() {

            $query = "CREATE TABLE IF NOT EXISTS sessions (
                        user_id mediumint(10) NULL,
                        issuedate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        session_id varchar(40) NOT NULL,
                        session_type varchar(20) NOT NULL,
                        eventdata tinytext NOT NULL,
                        browser varchar(255) NULL,
                        ip varchar(15) NULL,
                        PRIMARY KEY (session_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates a Tests table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createTestsTable() {

            $query = "CREATE TABLE IF NOT EXISTS tests (
                        test_id mediumint(10) unsigned NOT NULL auto_increment,
                        project_id mediumint(10) unsigned NOT NULL,
                        test_name varchar(60) NOT NULL,
                        function_name varchar(150) NOT NULL,
                        test_author varchar(50) NOT NULL,
                        test_group varchar(10) NOT NULL,
                        test_active int(5) NOT NULL,
                        PRIMARY KEY (test_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates a TestData table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
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

        /**
         * Function creates a Admin table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
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

        /**
         * Function creates a TestDependencies table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createTestDependenciesTable() {

            $query = "CREATE TABLE IF NOT EXISTS testdependencies (
                        dependency_id mediumint(10) unsigned NOT NULL auto_increment,
                        test_id varchar(60) NOT NULL,
                        dependency_value varchar(100) NOT NULL,
                        lastmod timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (dependency_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates a TestResults table in
         * the database
         *
         * @access public
         *
         * @return ResultSet Query ResultSet
         *
         */
        public function createTestResultsTable() {

            $query = "CREATE TABLE IF NOT EXISTS testresults (
                        result_id mediumint(10) unsigned NOT NULL auto_increment,
                        test_id mediumint(10) NOT NULL,
                        user_id varchar(60) NOT NULL,
                        test_date datetime NOT NULL,
                        PRIMARY KEY (result_id)
                      ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

            $result = $this->query($query);

            return $result;

        }

        /**
         * Function creates the entire database
         *
         * @param String Database Name
         * @access public
         *
         * @return Boolean TRUE if successful, else FALSE
         *
         */
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
            $dbResults[] = $this->createTestDependenciesTable();

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