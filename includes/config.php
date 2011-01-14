<?php

    /**
     * This file is used to configure the entire project.
     *
     * @License "GNU General Public License", version="3.0"
     *
     * Copyright 	(c) 2010, 2011 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
// define site directory structure
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// SITE_ROOT contains the full path to the SITE_ROOT
// SITE_ROOT in windows
// WAMP
//defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'wamp' . DS . 'www' . DS . 'unitcheck');
// XAMPP
//defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'unitcheck');
// SITE_ROOT in linux
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'unitcheck');

    defined('VIEW') ? null : define('VIEW', SITE_ROOT . DS . 'public');

// LIB_DIR
    defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes' . DS . 'classes');

// LOCALE_PATH
    defined('LOCALE_PATH') ? null : define('LOCALE_PATH', SITE_ROOT . DS . 'includes' . DS . 'locale');

// IMAGE PATH if required
    defined('IMAGE_PATH') ? null : define('IMAGE_PATH', '..' . DS . 'includes' . DS . 'images');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////// DATABASE CONFIGURATION /////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // These settings are hard coded for administrative access
    // Users
    defined('SERVER') ? null : define('SERVER', 'localhost');
    defined('DB_NAME') ? null : define('DB_NAME', 'unitcheck');
    //defined('DB_USER') ? null : define('DB_USER', 'unitcheck_user');
    //defined('DB_PASSWORD') ? null : define('DB_PASSWORD', 'test');

    defined('UNITCHECK_ADMIN') ? null : define('UNITCHECK_ADMIN', 'unitcheck_admin');
    defined('UNITCHECK_ADMIN_PASSWORD') ? null : define('UNITCHECK_ADMIN_PASSWORD', 'vision');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    defined('SENDMAIL') ? null : define('SENDMAIL', FALSE);
    defined('VERSION') ? null : define('VERSION', '0.10.2');
?>
