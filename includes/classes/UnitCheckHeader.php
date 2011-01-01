<?php

    /**
     * Header class is a template for Header objects.
     *
     * Copyright 	(c) 2010 Tom Kaczocha <freedomdeveloper@yahoo.com>
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
     * @version 	1.0
     * @access	public
     * @License     "GNU General Public License", version="3.0"
     *
     */
    class UnitCheckHeader {

        /**
         * UnitCheckHeader Constructor
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
         * UnitCheckHeader Destructor
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
         * Function prints UnitCheck header
         *
         * @param
         * @access public
         *
         * @return
         *
         */
        public static function printHeader() {

            echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
              <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ar" xml:lang="es-ar">
              <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta http-equiv="Content-Style-Type" content="text/css" />
                    <meta http-equiv="Content-Language" content="es-ar" />
                    <meta name="description" content="Generador de links con destino modificable" />
                    <link href="../includes/styles/styles.css" rel="stylesheet" type="text/css" />
                    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

                    <title>' . $title . ' - UnitCheck</title>
              </head>
              <body bgcolor="#DDFFDD">
                    <div id="header">
                        <h1>UnitCheck</h1>
                    </div> <!-- END header -->';

        }

    }

