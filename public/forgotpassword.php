<?php

    /**
     * This is the forgot password file.
     *
     * Copyright (C) 2011 Tom Kaczocha <freedomdeveloper@yahoo.com.au>
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
    require_once('../includes/initialise.php');

    $_SESSION['title'] = "Recover Forgotten Password";


    // print header
    UnitCheckHeader::printHeader();

    $helper->printMessage();

?>

<p>
    Enter your email address to recover your password. Your password will be
    sent to you via email.
</p>
<p>
    Form Coming Soon.
</p>

<form id="forgotpassword" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    
</form>




<?php

    // print footer
    UnitCheckFooter::printFooter();

?>
