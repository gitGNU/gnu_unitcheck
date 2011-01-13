<?php

/**
 * This is the content page.
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
 * @version 	1.0
 * @access	public
 * @License     "GNU General Public License", version="3.0"
 *
 */
$to = "freedomdeveloper@yahoo.com";
$subject = "UnitCheck Project Bug";
//$message = "Bug Report for UnitCheck Project$eol
//               ---------------------------------$eol
//               How would you reproduce the bug?$eol
//               1.$eol
//               2.$eol
//               3.$eol$eol$eol
//               Comments:$eol$eol";
// message
$message = '
<html>
<head>
  <title>Bug Report for UnitCheck Project</title>
</head>
<body>
  <p>Bug Report for UnitCheck Project</p>
  ---------------------------------
  <p>How would you reproduce the bug?</p>
  1.<br />
  2.<br />
  3.<br /><br /><br />

  Comments:<br /><br />
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Freedom Developer <freedomdeveloper@yahoo.com>' . "\r\n";
?>
