<?php

session_start();

session_destroy();

header ("Location: /Serandi 2/login.php");
exit;