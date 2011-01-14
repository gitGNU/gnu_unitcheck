<?php

    /**
     * This is the Home page.
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
    require_once('../includes/initialise.php');

    $_SESSION['title'] = "Welcome";

    $fullname = $user->getUserFullName();
    $email = $user->getUserEmail();
    

    UnitCheckHeader::printHeader();

    $helper->printMessage();

?>
<p>
        Welcome,
    <?php

        echo $fullname;
        echo " '" . $email . "'.";

    ?>
</p>
<p>    
        You are seeing this page because some of the core parameters have not been
        set up yet. The goal of this page is to inform you about the last steps
        required to set up your installation correctly.
</p>
<p>
        As an administrator, you have access to all administrative pages, accessible from the Administration link visible at the bottom of this page. This link will always be visible, on all pages. From there, you must visit at least the Parameters page, from where you can set all important parameters for this installation; among others:
</p>
<ul>
        <li>urlbase, which is the URL pointing to this installation and which will be used in emails (which is also the reason you see this page: as long as this parameter is not set, you will see this page again and again).</li>
        <li>cookiepath is important for your browser to manage your cookies correctly.</li>
        <li>maintainer, the person responsible for this installation if something is running wrongly.</li>
</ul>
<p>
        Also important are the following parameters:
</p>
<ul>
        <li>requirelogin, if turned on, will protect your installation from users having no account on this installation. In other words, users who are not explicitly authenticated with a valid account cannot see any data. This is what you want if you want to keep your data private.</li>
        <li>createemailregexp defines which users are allowed to create an account on this installation. If set to ".*" (the default), everybody is free to create his own account. If set to "@mycompany.com$", only users having an account @mycompany.com will be allowed to create an account. If left blank, users will not be able to create accounts themselves; only an administrator will be able to create one for them. If you want a private installation, you must absolutely set this parameter to something different from the default.</li>
        <li>mail_delivery_method defines the method used to send emails, such as sendmail or SMTP. You have to set it correctly to send emails.</li>
</ul>
<p>
        After having set up all this, we recommend looking at Bugzilla's other parameters as well at some time so that you understand what they do and whether you want to modify their settings for your installation.
</p>


<?php

        UnitCheckFooter::printFooter();

?>