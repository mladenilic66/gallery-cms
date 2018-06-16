<?php

require_once 'includes/header.php';

$session->logout();
redirect(ADMIN.'login');

?>