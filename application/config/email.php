<?php
// In application/config/email.php

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'your_email@gmail.com'; // Your email address
$config['smtp_pass'] = 'your_password';       // Your email password
$config['mailtype']  = 'html';                // Can be 'text' or 'html'
$config['charset']   = 'iso-8859-1';
$config['wordwrap']  = TRUE;


?>