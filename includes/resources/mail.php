<?php

    /**
     * This is the create new account file
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
//    include('Mail.php');
//    include('Mail/mime.php');

    function sendHTMLMail($email) {

//        $fromEmail = "NOREPLY@unitcheck.net";
//        $fromName = "UnitCheck";
//        $toEmail = $email;
//        $toName = "";
//        $mailSubject = "Test Email";

        $to = $email;
        $nameto = "";
        $from = "freedomdeveloper@yahoo.com";
        $namefrom = "UnitCheck";
        $subject = "Hello World Again!";
        $message = "World, Hello!";
        authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);

//Authenticate Send - 21st March 2005
//This will send an email using auth smtp and output a log array
//logArray - connection,

    }

    function authSendEmail($from, $namefrom, $to, $nameto, $subject, $message) {
        //SMTP + SERVER DETAILS
        /*         * * * CONFIGURATION START * * * */
        $smtpServer = "smtp.mail.yahoo.com";
        $port = "465";
        $timeout = "30";
        $username = "freedomdeveloper";
        $password = "VisionCoach";
        $localhost = "localhost";
        $newLine = "\r\n";
        /*         * * * CONFIGURATION END * * * * */

        //Connect to the host on the specified port
        $smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
        $smtpResponse = fgets($smtpConnect, 515);

        if (!$smtpConnect) {
            echo "<pre>";
            print_r($smtpConnect);
            echo "</pre>";
            die("Couldn't connect to $smtpServer:\nError: $errno\nDesc: $errstr\n");
        }

        if (empty($smtpConnect)) {
            $output = "Failed to connect: $smtpResponse";

            return $output;
        }
        else {
            $logArray['connection'] = "Connected: $smtpResponse";
        }

        echo "<pre>";
        var_dump($smtpConnect);
        echo "</pre>";
        echo "<br />Connection here<br />";
        
        //Request Auth Login
        fputs($smtpConnect, "AUTH LOGIN" . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['authrequest'] = "$smtpResponse";

        //Send username
        fputs($smtpConnect, base64_encode($username) . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['authusername'] = "$smtpResponse";

        //Send password
        fputs($smtpConnect, base64_encode($password) . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['authpassword'] = "$smtpResponse";

        //Say Hello to SMTP
        fputs($smtpConnect, "HELO $localhost" . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['heloresponse'] = "$smtpResponse";

        //Email From
        fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['mailfromresponse'] = "$smtpResponse";

        //Email To
        fputs($smtpConnect, "RCPT TO: $to" . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['mailtoresponse'] = "$smtpResponse";

        //The Email
        fputs($smtpConnect, "DATA" . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['data1response'] = "$smtpResponse";

        //Construct Headers
        $headers = "MIME-Version: 1.0" . $newLine;
        $headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
        $headers .= "To: $nameto <$to>" . $newLine;
        $headers .= "From: $namefrom <$from>" . $newLine;

        fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['data2response'] = "$smtpResponse";

        // Say Bye to SMTP
        fputs($smtpConnect, "QUIT" . $newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['quitresponse'] = "$smtpResponse";

        //insert var_dump here
        if (!empty($logArray)) {
            //var_dump($logArray);
            echo "<pre>";
            print_r($logArray);
            echo "</pre>";

            die("<br />Ending here<br />");
        }




//        // Constructing the email
//        $sender = "UnitCheck <NOREPLY@unitcheck.net>";
//        $recipient = "Tom <freedomdeveloper@yahoo.com>";
//        $subject = "Test Email";
//        $text = 'This is a text message.';
//        $html = '<html><body><p>This is a html message</p></body></html>';
//        $crlf = "\n";
//        $headers = array(
//            'From' => $sender,
//            'Return-Path' => $sender,
//            'Subject' => $subject
//        );
//        // Creating the Mime message
//        $mime = new Mail_mime($crlf);
//        // Setting the body of the email
//        $mime->setTXTBody($text);
//        $mime->setHTMLBody($html);
//        // Set body and headers ready for base mail class
//        $body = $mime->get();
//        $headers = $mime->headers($headers);
//        // SMTP params
//        $smtp_params["host"] = "smtp.mail.yahoo.com"; // SMTP host
//        $smtp_params["port"] = "465";        // SMTP Port (usually 25)
//        $smtp_params["auth"] = true;
//        $smtp_params["username"] = "freedomdeveloper@yahoo.com";
//        $smtp_params["password"] = "VisionCoach";
//
//        // Sending the email using smtp
//        $mail = Mail::factory("smtp", $smtp_params);
//        $result = $mail->send($recipient, $headers, $body);
//        if ($result == 1) {
//            die("Your message has been sent!");
//        }
//        else {
//            die("Your message was not sent: " . $result);
//        }
//        //////////////
//        $fromEmail = "NOREPLY@unitcheck.net";
//        $fromName = "UnitCheck";
//        $toEmail = $email;
//        $toName = "";
//        $mailSubject = "Test Email";
//
//        // message
//        $message = '
//            <html>
//                <head>
//                    <title>Birthday Reminders for August</title>
//                </head>
//                <body>
//                    <p>Here are the birthdays upcoming in August!</p>
//                    <table>
//                        <tr>
//                            <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
//                        </tr>
//                        <tr>
//                            <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
//                        </tr>
//                        <tr>
//                            <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
//                        </tr>
//                    </table>
//                </body>
//            </html>';
//
//        // To send HTML mail, the Content-type header must be set
//        $headers = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//        // Additional headers
//        $headers .= 'From: UnitCheck <' . $from . '>' . "\r\n";
//
//
//        //$result = mail($to, $mailSubject, $message, $headers);
//        SendMail($toName, $toEmail, $fromName, $fromEmail, $mailSubject, $message, $headers);
//
//        return $result;

    }

    function SendMail($toName, $toEmail, $fromName, $fromEmail, $Subject, $Body, $Header) {
        $host = "smtp.mail.yahoo.com";

        $SMTP = fsockopen($host, 25, $errNo, $errMess, 60);

        if (!$SMTP) {
            die("Couldn't connect to $host:\nError: $errNo\nDesc: $errMess\n");
        }

        $InputBuffer = fgets($SMTP, 1024);

        fputs($SMTP, "HELO sitename.com\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "MAIL from: $fromEmail\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "RCPT To: $toEmail\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "DATA\n");
        $InputBuffer = fgets($SMTP, 1024);
        fputs($SMTP, "$Header");
        fputs($SMTP, "from: $fromName <$fromEmail>\n");
        fputs($SMTP, "To: $toName <$toEmail>\n");
        fputs($SMTP, "Subject: $Subject\n\n");
        fputs($SMTP, "$Body\r\n.\r\n");
        fputs($SMTP, "QUIT\n");
        $InputBuffer = fgets($SMTP, 1024);

        fclose($SMTP);

    }

?>
