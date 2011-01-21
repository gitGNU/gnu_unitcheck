<?php

    /**
     * This file is part of UnitCheck.
     * This file contains all the UnitCheckUser attributes and methods.
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
     * UnitCheckUser class is a template for UnitCheckUser objects.
     *
     * @package         UnitCheck
     * @author		Tom Kaczocha <freedomdeveloper@yahoo.com>
     * @copyright	2010, 2011 Tom Kaczocha
     * @license         GNU General Public License, version 3.0
     * @version 	1.0
     * @access		public
     */
    class UnitCheckUser {

        /**
         * User ID
         *
         * @access private
         * @var String
         */
        private $_userID;
        /**
         * User's First Name
         *
         * @access private
         * @var String
         */
        private $_user_first_name;
        /**
         * User's Last Name
         *
         * @access private
         * @var String
         */
        private $_user_last_name;
        /**
         * Email
         *
         * @access private
         * @var String
         */
        private $_email;
        /**
         * Password
         *
         * @access private
         * @var String
         */
        private $_password;
        /**
         * Main Project ID
         *
         * @access private
         * @var String
         */
        private $_mainProjectID;
        /**
         * User Logged in Flag
         *
         * @access private
         * @var String
         */
        private $_userIsLoggedIn;

        /**
         * UnitCheck User Object Constructor
         *
         * @param String User ID
         * @access public
         *
         */
        public function __construct($id = 0) {
            global $session;

            if (isset($id)) {
                $this->_userID = $id;
            }

            $this->checkUserLogin();
            $this->initUser($this->_userID);
//            echo "<br />USER ID: " . $this->_userID;
//            echo "<br />FIRST NAME: " . $this->_user_first_name;
//            echo "<br />LAST NAME: " . $this->_user_last_name;
//            echo "<br />EMAIL: " . $this->_email;
//            echo "<br />PASSWORD: " . $this->_password;
//            echo "<br />MAIN PROJECT: " . $this->_mainProjectID;
//            echo "<br />IS LOGGED IN: " . $this->_userIsLoggedIn."<br />";
            // check for matching session in database
            $session_status = $session->checkForSession();

            if ($session_status) {// match -> update session object
                $this->updateSession();
            }
            else { // no match -> create new session object
                $session->setNewSession();
            }

        }

        /**
         * UnitCheck User Object Destructor
         *
         * @access public
         *
         */
        public function __destruct() {
            
        }

        /**
         * Function initialises a user object
         *
         * @param String User ID
         * @access public
         *
         */
        private function initUser($uID) {
            //echo "INIT USER ID: ".$uID;
            $this->_userID = $uID;

            $data = $this->getUserDataSetByID($uID);

            if ($data != 0) {
                $this->_mainProjectID = $data['mainproject_id'];
                $this->_user_first_name = $data['user_first_name'];
                $this->_user_last_name = $data['user_last_name'];
                $this->_email = $data['email'];
                $this->_password = $data['password'];

                //echo "Init User Main Project ID: " . $this->_mainProjectID . "<br />";
                $_SESSION['email'] = $this->_email;
                //echo "<br />NOT FALSE<br />";
            }

        }

        /**
         * Function adds a new user to the database
         *
         * @param Stirng First Name
         * @param String Last Name
         * @param String Email
         * @param String Password
         * 
         * @access public
         *
         * @return String|Boolean User ID if successful,
         * else FALSE
         *
         */
        public function createNewUserAccount($fname, $lname, $email, $pass) {
            global $database;

            $query = "INSERT INTO users
                      SET user_first_name = '" . $fname . "',
                          user_last_name = '" . $lname . "',
                          email = '" . $email . "',
                          password = '" . md5($pass) . "',
                          active = 1;";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                $uID = $database->getLastID();
                $this->initUser($uID);
                return $uID;
            }
            else {
                return 0;
            }

        }

        /**
         * Function adds an admin to the database
         *
         * @param String User ID
         * @access public
         *
         * @return Boolean TRUE if successful, else FALSE
         *
         */
        public function registerAdmin($uID) {
            global $database;

            $query = "INSERT INTO admin
                      SET user_id = '" . $uID . "';";

            if ($this->_userID == "") {
                die("User ID blank");
            }
            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns Admin ResultSet
         *
         * @access public
         *
         * @return ResultSet|Boolean Admin ResultSet if successful
         * else FALSE
         *
         */
        public function getAdminResultSet() {
            global $database;

            $query = "SELECT *
                      FROM admin;";

            $result = $database->query($query);

            if ($database->numRows($result) > 0) {
                return $result;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns user DataSet by ID
         *
         * @param String User ID
         * @access public
         *
         * @return DataSet|Boolean User DataSet if successful
         * else FALSE
         *
         */
        public function getUserDataSetByID($uID) {
            global $database;

            $query = "SELECT *
                      FROM users
                      WHERE user_id = '" . $uID . "';";

            //echo "<br />DATASET QUERY: ".$query;
            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns user ResultSet
         *
         * @access public
         *
         * @return ResultSet User ResultSet
         *
         */
        public function getUserResultSet() {
            global $database;

            $query = "SELECT *
                      FROM users;";

            $result = $database->query($query);

            return $result;

        }

        /**
         * Function returns user ID
         *
         * @access public
         *
         * @return String User ID
         *
         */
        public function getUserID() {
            return $this->_userID;

        }

        /**
         * Function returns users email
         *
         * @access public
         *
         * @return String User Email
         *
         */
        public function getUserEmail() {
            return $this->_email;

        }

        /**
         * Function gets users status
         *
         * @access public
         *
         * @return Boolean TRUE if active, FALSE otherwise
         *
         */
        public function getIsUserActive() {
            return $this->_isActive;

        }

        /**
         * Function sets User ID
         *
         * @param String User ID
         * @access private
         *
         *
         */
        private function setUserID($id) {
            $this->_userID = $id;

        }

        /**
         * Function sets user password
         *
         * @param String Password
         * @access private
         *
         */
        private function setPassword($password) {
            $this->_password = $password;

        }

        /**
         * Function sets user email
         *
         * @param String Email
         * @access private
         *
         */
        private function setUserEmail($email) {
            $this->_email = $email;

        }

        /**
         * Function sets user status
         *
         * @param String Status
         * @access private
         *
         */
        private function setIsActive($status) {
            $this->_isActive = $status;

        }

        /**
         * Function checks whether user is logged in
         * Sets Flag to TRUE if logged in, FALSE if not
         *
         * @access private
         *
         */
        private function checkUserLogin() {
            if (isset($_SESSION['user_id'])) {
                $this->_userID = $_SESSION['user_id'];
                $this->_userIsLoggedIn = true;
            }
            else {
                unset($this->_userID);
                $this->_userIsLoggedIn = false;
            }

        }

        /**
         * Function checks whether user is logged in
         *
         * @access public
         *
         * @return Boolean TRUE if logged in, FALSE if not
         * 
         */
        public function isUserLoggedIn() {
            return $this->_userIsLoggedIn;

        }

        /**
         * Function authenticates user login attempt
         *
         * @param String Email
         * @param String Password
         *
         * @access public
         * @static
         * 
         * @return String|Boolean Email if login Successful, FALSE otherwise
         *
         */
        public static function authenticateUser($email = '', $password = '') {
            global $database;

            $query = "SELECT user_id, active
			 FROM users
			 WHERE email = '$email'
			 AND password = '" . md5($password) . "'
			 LIMIT 1;";

            //echo "<br />AUTH Query: " . $query . "<br />";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data['user_id'];
            }
            else {
                return 0;
            }

        }

        /**
         * Function validates that an email exists
         * in the database
         *
         * @param String Email
         * @access public
         *
         * @return Boolean TRUE if exists, else FALSE
         *
         */
        public function userEmailExists($newEmail) {
            global $database;

            $query = "SELECT *
                      FROM users
                      WHERE email = '" . $newEmail . "';";

            $result = $database->query($query);

            if ($database->numRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function logs user in
         *
         * @param String User ID
         * @access public
         *
         */
        public function loginUser($uID) {
            if ($uID) {
                $this->_userID = $_SESSION['user_id'] = $uID;
                $this->_userIsLoggedIn = TRUE;
                $this->initUser($this->_userID);
            }

        }

        /**
         * Function logs user out
         *
         * @access public
         *
         */
        public function logoutUser() {
            unset($_SESSION['user_id']);
            unset($_SESSION['email']);
            unset($this->_UserID);
            $this->_userIsLoggedIn = false;

            // re-generate session ID
            session_regenerate_id(true);

        }

        /**
         * Function validates email address input
         *
         * @param String Email
         * @access public
         *
         * @return Boolean TRUE if matches, otherwise FALSE
         *
         */
        public function emailCheck($email) {
            $pattern = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';

            preg_match($pattern, $email, $matches);

            if (!empty($matches)) {
                return 1;
            }
            else
                return 0;

        }

        /**
         * Function updates users profile
         *
         * @param String First Name
         * @param String Last Name
         * @param String Email
         * @access public
         *
         * @return Boolean TRUE if successful, otherwise FALSE
         *
         */
        public function updateProfile($fName, $lName, $email) {
            global $database;

            $query = "UPDATE users
                      SET user_first_name = '$fName',
			  user_last_name = '$lName',
                          email = '$email'
		      WHERE user_id = '" . $this->_userID . "';";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function updates user password
         *
         * @param String New Password
         * @access public
         *
         * @return Boolean TRUE if Successful, FALSE otherwise
         *
         */
        public function updateUserPassword($newpass) {
            global $database;

            $query = "UPDATE users
                      SET password = '" . md5($newpass) . "'
		      WHERE user_id = '" . $this->_userID . "';";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function updates users realname
         *
         * @param String Password
         * @access public
         *
         * @return Boolean TRUE if Successful, FALSE otherwise
         *
         */
        public function verifyPassword($password) {

            if ($password == $this->_password) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function updates user ID in session table
         *
         * @access public
         *
         * @return Boolean TRUE if session exists, otherwise FALSE
         *
         */
        public function updateSession() {
            global $database;
            global $session;

            $query = "UPDATE sessions
                      SET user_id = '" . $this->_userID . "'
                      WHERE session_id = '" . $session->getSessionID() . "';";

            //echo "Update Session Query: " . $query;
            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function validates a users password
         *
         * @param String Password 1
         * @param String Password 2
         *
         * @access public
         *
         * @return Boolean TRUE if valid, else FALSE
         *
         */
        public function validatePassword($pass1, $pass2) {
            if (($pass1 == $pass2) && (strlen($pass1) >= 6)) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function adds a user to project
         *
         * @param String Project ID
         * @access public
         *
         * @return Boolean TRUE if successful, else FALSE
         *
         */
        public function addUserToProject($pID) {
            global $database;
            global $user;            

            $status = 0;

            $query1 = "INSERT INTO userprojects (user_id, project_id)
                      VALUES ('" . $this->_userID . "', '" . $pID . "');";

            //echo "<br />QUERY 1: " . $query1 . "<br />";
            $query2 = "UPDATE users
                       SET mainproject_id = '" . $pID . "'
                       WHERE user_id = '" . $this->_userID . "';";

            //echo "<br />QUERY 2: " . $query2 . "<br /><br />";

            $result = $database->query($query1);
            //echo "Query 1 Result = " . $result . "<br />";
            if ($database->affectedRows($result) == 1) {

                $status++;
            }

            $result = $database->query($query2);
            //echo "Query 2 Result = " . $result . "<br />";
            if ($database->affectedRows($result) == 1) {
                $status++;
            }

            if ($status == 2) {
                //echo "Add User to Project TRUE<br />";
                return TRUE;
            }
            else {
                //echo "Add User to Project FALSE<br />";
                return 0;
            }

        }

        /**
         * Function returns the users projects
         *
         * @param String User ID
         * @access public
         *
         * @return DataSet|Boolean User Projects DataSet or FALSE
         *
         */
        public function getUserProjects($uID) {
            global $database;

            $query = "SELECT *
                      FROM userprojects
                      WHERE user_id = '" . $uID . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns users Full Name
         *
         * @access public
         *
         * @return String|Boolean Full Name or FALSE
         *
         */
        public function getUserFullName() {
            global $database;

            $query = "SELECT user_first_name, user_last_name,
                      CONCAT( user_first_name, ' ', user_last_name) AS 'fullname'
                      FROM users
                      WHERE email = '" . $_SESSION['email'] . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data['fullname'];
            }
            else {
                return 0;
            }

        }

        /**
         * Function checks whether the user is an administrator
         *
         * @param String User ID
         * @access public
         *
         * @return Boolean TRUE if is admin, else FALSE
         *
         */
        public function isUserAdmin($uID) {
            global $database;

            $query = "SELECT admin_id
                      FROM admin
                      WHERE user_id = '" . $uID . "';";

            $result = $database->query($query);

            if ($database->numRows($result) == 1) {
                return TRUE;
            }
            else {
                return 0;
            }

        }

        /**
         * Function returns users project ID
         *
         * @access public
         *
         * @return String Project ID
         * 
         */
        public function getUserProjectID() {
            //echo "<br />Get USER Project ID = " . $this->_mainProjectID . "<br />";
            return $this->_mainProjectID;

        }

        /**
         * Function returns users project name
         *
         * @access public
         *
         * @return String|Boolean Project name or FALSE
         *
         */
        public function getUserProjectName() {
            global $database;

            $query = "SELECT *
                      FROM projects
                      WHERE project_id = '" . $this->_mainProjectID . "';";

            $result = $database->query($query);
            $data = $database->fetchArray($result);

            if (!empty($data)) {
                return $data['project_name'];
            }
            else {
                return 0;
            }

        }

        /**
         * Function updates the users main project ID
         *
         * @param String Project ID
         * @access public
         *
         * @return Boolean TRUE if successful, otherwise FALSE
         * 
         */
        public function updateMainProject($pID) {
            global $database;

            $query = "UPDATE users
                      SET mainproject_id = '" . $pID . "'
                      WHERE user_id = '" . $this->_userID . "';";

            $result = $database->query($query);

            if ($database->affectedRows($result) == 1) {
//                echo "DB TRUE Result: " . $result . "<br />";
                return TRUE;
            }
            else {
//                echo "DB FALSE Result: " . $result . "<br />";
                return 0;
            }

        }

    }

    // When user first enters the site they are given a user_id
    // of 0... if they register, or login they get their real
    // user ID
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }
    else {
        $user_id = 0;
    }

    $user = new UnitCheckUser($user_id);

?>
