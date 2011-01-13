<?php

    /**
     * This is the email sent page
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
    

    $_SESSION['title'] = 'Request for new user account '.$_SESSION['email'].' submitted';

    // print header
    UnitCheckHeader::printHeader();

?>

<p>
        A confirmation email has been sent containing a link to continue creating
        an account. The link will expire if an account is not created within 3
        days.
</p>



<?php

    // print footer
    UnitCheckFooter::printFooter();

?>
